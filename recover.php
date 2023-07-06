<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="recover_process.php" method="post">
     	<h2>Recover Password</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

		<label>User Name</label>
     	<input type="text" name="uname" placeholder="User Name"><br>

     	<label>New Password</label>
     	<input type="password" name="np"  placeholder="New Password"><br>

     	<label>Confirm New Password</label>
     	<input type="password" name="c_np" placeholder="Confirm New Password"><br>

     	<button type="submit">Recover Password</button>
          <a href="login.php" class="ca">< Back</a>
     </form>
</body>
</html>