<?php 
session_start(); 
include "database/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])
    && isset($_POST['name']) && isset($_POST['re_password'])
    && isset($_POST['secret_question']) && isset($_POST['secret_answer'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
      
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['re_password']);
    $name = validate($_POST['name']);
    $secretQuestion = validate($_POST['secret_question']);
    $secretAnswer = validate($_POST['secret_answer']);

    $user_data = 'uname='. $uname. '&name='. $name;

    function validatePassword($password, $user_data) {
        // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number, and one special character
        $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z\d\s]).{8,}$/";

        // Perform the validation
        if (preg_match($pattern, $password)) {
            return $password; // Password meets the requirements
        } else {
            // Password does not meet the requirements
            header("Location: register.php?error=Invalid password. Password must be at least 8 characters long and include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character&$user_data");
            exit();
        }
    }

	function encryptAES($data, $key) {
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
		return base64_encode($iv . $encrypted);
	}

    if (empty($uname)) {
        header("Location: register.php?error=User Name is required&$user_data");
        exit();
    } else if(empty($pass)){
        header("Location: register.php?error=Password is required&$user_data");
        exit();
    } else if(empty($re_pass)){
        header("Location: register.php?error=Confirmation Password is required&$user_data");
        exit();
    } else if(empty($name)){
        header("Location: register.php?error=Name is required&$user_data");
        exit();
    } else if($pass !== $re_pass){
        header("Location: register.php?error=The confirmation password does not match&$user_data");
        exit();
    } else {
        $pass = validatePassword($pass, $user_data);
        // Hashing the password
        $pass = md5($pass);

        // Generate AES-256 encryption key
        $encryptionKey = openssl_random_pseudo_bytes(32);
		$ciphering_value = 'AES-128-CTR';
        
        // Encrypt the secret answer using AES-256 encryption
        $encryptedSecretAnswer = openssl_encrypt($secretAnswer, $ciphering_value, $uname);

        $sql = "SELECT * FROM users WHERE user_name='$uname' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: register.php?error=The username is taken try another&$user_data");
            exit();
        } else {
            $sql2 = "INSERT INTO users(user_name, password, name, secret_question, secret_answer, encryption_key) VALUES('$uname', '$pass', '$name', '$secretQuestion', '$encryptedSecretAnswer', '$uname')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: register.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: register.php?error=unknown error occurred&$user_data");
                exit();
            }
        }
    }
    
} else {
    header("Location: register.php");
    exit();
}