<!DOCTYPE html>
<html>

<head>
     <title>SIGN UP</title>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
     <form action="register_process.php" method="post">
          <h2>SIGN UP</h2>
          <?php if (isset($_GET['error'])) { ?>
               <p class="error"><?php echo $_GET['error']; ?></p>
          <?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>Name</label>
          <?php if (isset($_GET['name'])) { ?>
               <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']; ?>"><br>
          <?php } else { ?>
               <input type="text" name="name" placeholder="Name"><br>
          <?php } ?>

          <label>User Name</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" name="uname" placeholder="User Name" value="<?php echo $_GET['uname']; ?>"><br>
          <?php } else { ?>
               <input type="text" name="uname" placeholder="User Name"><br>
          <?php } ?>

          <label>Password</label>
          <input type="password" name="password" placeholder="Password"><br>

          <label>Confirm Password</label>
          <input type="password" name="re_password" placeholder="Confirm Password"><br>

          <label>Secret Question</label><br>
          <select class="secret" name="secret_question">
               <option value="" selected disabled>Please select your secret question</option>
               <option value="What is your pet's name?">What is your pet's name?</option>
               <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
               <option value="What is your favorite movie?">What is your favorite movie?</option>
          </select><br>


          <label>Secret Answer</label>
          <input type="text" name="secret_answer" placeholder="Secret Answer"><br>

          <button type="submit">Sign Up</button>
          <a href="login.php" class="ca">Already have an account?</a>
     </form>
</body>

</html>