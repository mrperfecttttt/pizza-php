<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
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
    <form action="recover_process.php" method="post">
        <h2>Recover Password</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php } ?>

        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">

        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>

        <label>Secret Question</label>
        <select class="secret" name="secret_question">
            <option value="">Please select a secret question</option>
            <option value="What is your pet's name?">What is your pet's name?</option>
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <option value="What is your favorite movie?">What is your favorite movie?</option>
        </select><br>

        <label>Secret Answer</label>
        <input type="text" name="secret_answer" placeholder="Secret Answer"><br>

        <label>New Password</label>
        <input type="password" name="np" placeholder="New Password"><br>

        <label>Confirm New Password</label>
        <input type="password" name="c_np" placeholder="Confirm New Password"><br>

        <button type="submit">Recover Password</button>
        <a href="login.php" class="ca">&lt; Back</a>
    </form>
</body>

</html>