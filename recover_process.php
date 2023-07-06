<?php 
session_start();
include "database/db_conn.php";
if (isset($_POST['uname']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	function validatePassword($password, $user_data) {
		// Minimum eight characters, at least one uppercase letter, one lowercase letter, one number, and one special character
		$pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/";

		
		// Perform the validation
		if (preg_match($pattern, $password)) {
			return $password; // Password meets the requirements
		} else {
			// Password does not meet the requirements
			header("Location: recover.php?error=Invalid password. Password must be at least 8 characters long and include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character&$user_data");
			exit();
		}
	}

	$uname = validate($_POST['uname']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($uname)){
      header("Location: recover.php?error=User Name is required");
	  exit();
    }else if(empty($np)){
      header("Location: recover.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: recover.php?error=The confirmation password  does not match");
	  exit();
    }else {
		$np = validatePassword($np, $user_data);
    	// hashing the password
    	$np = md5($np);

        // $sql = "SELECT password FROM users WHERE user_name='$uname'";
        // Use prepared statement with placeholders
    	$stmt = $conn->prepare("SELECT * FROM users WHERE user_name=?");
    	$stmt->bind_param("s", $uname);
    	$stmt->execute();
    	$result = $stmt->get_result();


		// $result = mysqli_query($conn, $sql);
		if($result->num_rows === 1) {
        	// Use prepared statement to update password
			$updateStmt = $conn->prepare("UPDATE users SET password=? WHERE user_name=?");
			$updateStmt->bind_param("ss", $hashedPassword, $uname);
			$updateStmt->execute();
        	header("Location: recover.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: recover.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: recover.php");
	exit();
}