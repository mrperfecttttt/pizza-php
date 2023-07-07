<?php
if (!session_start())
    session_start();

include "database/db_conn.php";

if (isset($_POST['secret_question']) && isset($_POST['secret_answer']) && isset($_POST['csrf_token'])) {

	// Validate CSRF token
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        header("Location: register.php?error=Invalid CSRF token");
        exit();
    }

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate(htmlspecialchars($_SESSION['user_name']));
	$secret_question = validate(htmlspecialchars($_POST['secret_question']));
	$secret_answer = validate(htmlspecialchars($_POST['secret_answer']));

	if (empty($uname)) {
		header("Location: mfa.php?error=User Name is required");
		exit();
	} else if (empty($secret_question)) {
		header("Location: mfa.php?error=Select secret question");
		exit();
	}  else if (empty($secret_answer)) {
		header("Location: mfa.php?error=Select secret answer");
		exit();
	} else {
		// Use prepared statement to retrieve user data including secret question and answer
		$stmt = $conn->prepare("SELECT * FROM users WHERE user_name=?");
		$stmt->bind_param("s", $uname);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows === 1) {
			$row = $result->fetch_assoc();
			$secretQuestion = $row['secret_question'];
			$encryptedSecretAnswer = $row['secret_answer'];
			$encryptionKey = $row['encryption_key'];
			$ciphering_value = 'AES-256-CBC';

			// Decrypt the secret answer using AES-256 decryption
			$secretAnswer = openssl_decrypt($encryptedSecretAnswer, $ciphering_value, $encryptionKey);

			if ($_POST['secret_question'] === $secretQuestion && $_POST['secret_answer'] === $secretAnswer) {
				header("Location: home.php");
				exit();
			} else {
				header("Location: mfa.php?error=Incorrect secret question or answer");
				exit();
			}
		} else {
			header("Location: mfa.php?error=Incorrect username");
			exit();
		}
	}
} else {
	header("Location: mfa.php");
	exit();
}
