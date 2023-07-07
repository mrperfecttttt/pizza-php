<!DOCTYPE html>
<html>

<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<?php
	session_start();

	// Generate CSRF token and store it in the session
	if (!isset($_SESSION['csrf_token'])) {
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}
	$csrfToken = $_SESSION['csrf_token'];
	?>

	<form action="login_process.php" method="post">
		<h2>LOGIN</h2>
		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
		<?php } ?>

		<input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">

		<label>User Name</label>
		<input type="text" name="uname" placeholder="User Name"><br>

		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>

		<button type="submit">Login</button>
		<a href="recover.php" class="ca">Forgot Password</a>
		<a href="register.php" class="ca">Create an account</a>
	</form>
</body>

</html>