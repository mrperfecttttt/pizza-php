<!DOCTYPE html>
<html>

<head>
	<title>LOGIN</title>
	<style media="screen">
		*,
		*:before,
		*:after {
			padding: 0;
			margin: 0;
			box-sizing: border-box;
		}

		body {
			background-color: #080710;
		}

		.error {
			background: #F2DEDE;
			color: #A94442;
			padding: 10px;
			width: 95%;
			border-radius: 5px;
			margin: 20px auto;
		}

		.success {
			background: #D4EDDA;
			color: #40754C;
			padding: 10px;
			width: 95%;
			border-radius: 5px;
			margin: 20px auto;
		}

		.background {
			height: 600px;
			width: 450px;
			position: absolute;
			transform: translate(-50%, -50%);
			left: 50%;
			top: 50%;
		}

		.background .shape {
			height: 200px;
			width: 200px;
			position: absolute;
			border-radius: 50%;
		}

		.shape:first-child {
			background: linear-gradient(#1845ad,
					#23a2f6);
			left: -80px;
			top: -80px;
		}

		.shape:last-child {
			background: linear-gradient(to right,
					#ff512f,
					#f09819);
			right: -30px;
			bottom: -80px;
		}

		form {
			height: 600px;
			width: 450px;
			background-color: rgba(255, 255, 255, 0.13);
			position: absolute;
			transform: translate(-50%, -50%);
			top: 50%;
			left: 50%;
			border-radius: 10px;
			backdrop-filter: blur(10px);
			border: 2px solid rgba(255, 255, 255, 0.1);
			box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
			padding: 50px 35px;
		}

		form * {
			font-family: 'Poppins', sans-serif;
			color: #ffffff;
			letter-spacing: 0.5px;
			outline: none;
			border: none;
		}

		form h3 {
			font-size: 32px;
			font-weight: 500;
			line-height: 42px;
			text-align: center;
		}

		label {
			display: block;
			margin-top: 30px;
			font-size: 16px;
			font-weight: 500;
		}

		input {
			/* display: block; */
			height: 50px;
			width: 100%;
			background-color: rgba(255, 255, 255, 0.07);
			border-radius: 3px;
			padding: 0 10px;
			margin-top: 8px;
			font-size: 14px;
			font-weight: 300;
		}

		::placeholder {
			color: #e5e5e5;
		}

		button {
			margin-top: 50px;
			width: 100%;
			background-color: #ffffff;
			color: #080710;
			padding: 15px 0;
			font-size: 18px;
			font-weight: 600;
			border-radius: 5px;
			cursor: pointer;
		}

		.action {
			margin-top: 30px;
			display: flex;
		}

		.action a {
			background: red;
			width: 200px;
			height: 40px;
			border-radius: 3px;
			padding: 10px 10px 10px 5px;
			background-color: rgba(255, 255, 255, 0.27);
			color: #eaf0fb;
			text-align: center;
		}

		.action a:hover {
			background-color: rgba(255, 255, 255, 0.47);
		}

		.action .ca2 {
			margin-left: 25px;
		}

		.action a {
			margin-right: 4px;
			text-decoration: none;
			text-align: center;
		}
	</style>
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
	
	<div class="background">
		<div class="shape"></div>
		<div class="shape"></div>
	</div>

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
		<div class="action">
			<a href="recover.php" class="ca"> Forgot Password</a>
			<a href="register.php" class="ca2"> Create an account</a>
		</div>
	</form>
</body>

</html>