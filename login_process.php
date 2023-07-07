<?php
session_start();
include "database/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['csrf_token'])) {

	// Validate CSRF token
	if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
		header("Location: login.php?error=Invalid CSRF token");
		exit();
	}

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate(htmlspecialchars($_POST['uname']));
	$pass = validate(htmlspecialchars($_POST['password']));

	if (empty($uname)) {
		header("Location: login.php?error=User Name is required");
		exit();
	} else if (empty($pass)) {
		header("Location: login.php?error=Password is required");
		exit();
	} else {
		// hashing the password
		$pass = md5($pass);

		// Use prepared statement with placeholders
		$stmt = $conn->prepare("SELECT * FROM users WHERE user_name=? AND password=?");
		$stmt->bind_param("ss", $uname, $pass);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['user_name'] === $uname && $row['password'] === $pass) {
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['id'];
				header("Location: home.php");
				exit();
			} else {
				header("Location: login.php?error=Incorect User name or password");
				exit();
			}
		} else {
			header("Location: login.php?error=Incorect User name or password");
			exit();
		}
	}
} else {
	header("Location: login.php");
	exit();
}
