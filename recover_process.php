<?php
session_start();
include "database/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['np']) && isset($_POST['c_np']) && isset($_POST['csrf_token'])) {

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

	function validatePassword($password, $user_data)
	{
		// Minimum eight characters, at least one uppercase letter, one lowercase letter, one number, and one special character
		$pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/";

		// Perform the validation
		if (preg_match($pattern, $password)) {
			return $password; // Password meets the requirements
		} else {
			// Password does not meet the requirements
			header("Location: recover.php?error=Invalid password. Password must be at least 8 characters long and include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character");
			exit();
		}
	}

	$uname = validate(htmlspecialchars($_POST['uname']));
	$np = validate(htmlspecialchars($_POST['np']));
	$c_np = validate(htmlspecialchars($_POST['c_np']));

	if (empty($uname)) {
		header("Location: recover.php?error=User Name is required");
		exit();
	} else if (empty($np)) {
		header("Location: recover.php?error=New Password is required");
		exit();
	} else if ($np !== $c_np) {
		header("Location: recover.php?error=The confirmation password does not match");
		exit();
	} else {
		$np = validatePassword($np, $user_data);
		// Hashing the password
		$np = md5($np);

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
				// Use prepared statement to update the password
				$updateStmt = $conn->prepare("UPDATE users SET password=? WHERE user_name=?");
				$updateStmt->bind_param("ss", $np, $uname);
				$updateStmt->execute();

				header("Location: recover.php?success=Your password has been changed successfully");
				exit();
			} else {

				header("Location: recover.php?error=Incorrect secret question or answer");
				exit();
			}
		} else {
			header("Location: recover.php?error=Incorrect username");
			exit();
		}
	}
} else {
	header("Location: recover.php");
	exit();
}
