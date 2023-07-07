<?php
require_once 'session_config.php';

if (!session_start())
    session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Check if the status parameter is set in the query string
    if (isset($_GET['status'])) {
        $status = htmlspecialchars($_GET['status']);
    } else {
        // Status parameter not set, handle the error accordingly
        header("Location: home.php");
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
</head>

<body>
    <div class="navbar">
        <a href="home.php #home" class="bar-item" href="home.php">HOME</a>
        <a href="home.php #menu" class="bar-item">MENU</a>
        <a href="cart.php" class="bar-item right active"><i class="fa fa-shopping-cart"></i> CART</a>
        <a href="home.php #about" class="bar-item">ABOUT</a>
        <a href="logout.php" class="bar-item">LOGOUT</a>
    </div>

    <div id="cart" class="container black xxlarge padding-64">
        <h1 class="center jumbo padding-32">Order</h1>
        <div id="order" style="background-color: #f1f1f1; padding: 20px; margin-top: 20px; border-radius: 15px">
    <p>Status: <?php echo $status; ?></p>
</div>

        
    </div>
</body>

</html>
