<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $quantity1 = isset($_GET['quantity1']) ? $_GET['quantity1'] : 0;
    $quantity2 = isset($_GET['quantity2']) ? $_GET['quantity2'] : 0;
    $quantity3 = isset($_GET['quantity3']) ? $_GET['quantity3'] : 0;
    $totalPrice = isset($_GET['total_price']) ? $_GET['total_price'] : 0;
    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $deliveryDate = isset($_GET['delivery-date']) ? $_GET['delivery-date'] : '';
    $deliveryTime = isset($_GET['delivery-time']) ? $_GET['delivery-time'] : '';
    $cardNumber = isset($_GET['card-num']) ? $_GET['card-num'] : '';
    $cardExpiryDate = isset($_GET['card-expiry-date']) ? $_GET['card-expiry-date'] : '';
    $cardCVV = isset($_GET['card-cvv']) ? $_GET['card-cvv'] : '';

    // Construct the state string
    $state = "$quantity1|#|$quantity2|#|$quantity3|#|$totalPrice|#|$location|#|$deliveryDate|#|$deliveryTime|#|$cardNumber|#|$cardExpiryDate|#|$cardCVV";

    // Server key 
    $serverKey = 'super_secure_key';

    // Compute the message authentication code (MAC) using the server key
    $signature = hash_hmac('sha256', $state, $serverKey);
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Pizza - Cart</title>
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

        <!-- Checkout -->
        <div id="cart" class="container black xxlarge padding-64">
            <h1 class="center jumbo padding-32">Checkout</h1>
            <form action="checkout_process.php" method="GET">
                <p>You ordered:</p>
                <?php
                if ($quantity1 > 0) {
                    echo "<p>{$quantity1} Deluxe Cheese</p>";
                }
                if ($quantity2 > 0) {
                    echo "<p>{$quantity2} Four of a kind Cheese</p>";
                }
                if ($quantity3 > 0) {
                    echo "<p>{$quantity3} Chicken Pepperoni</p>";
                }
                ?>

                <br>
                <p>The total is: RM<?php echo number_format($totalPrice, 2) ?></p> </br>
                <p><strong>Delivery Details:</strong></p>
                <p>Location: <?php echo $location ?></p>
                <p>Delivery Date: <?php echo $deliveryDate ?></p>
                <p>Delivery Time: <?php echo $deliveryTime ?></p>

                <input type="hidden" name="quantity1" value="<?php echo $quantity1 ?>">
                <input type="hidden" name="quantity2" value="<?php echo $quantity2 ?>">
                <input type="hidden" name="quantity3" value="<?php echo $quantity3 ?>">
                <input type="hidden" name="total_price" value="<?php echo $totalPrice ?>">
                <input type="hidden" name="location" value="<?php echo $location ?>">
                <input type="hidden" name="delivery-date" value="<?php echo $deliveryDate ?>">
                <input type="hidden" name="delivery-time" value="<?php echo $deliveryTime ?>">
                <input type="hidden" name="card-num" value="<?php echo $cardNumber ?>">
                <input type="hidden" name="card-expiry-date" value="<?php echo $cardExpiryDate ?>">
                <input type="hidden" name="card-cvv" value="<?php echo $cardCVV ?>">
                <input type="hidden" name="signature" value="<?php echo $signature ?>">

                <input type="submit" name="submit" value="Pay">
                <input type="submit" name="cancel" value="Cancel">

            </form>
        </div>
    </body>

    </html>

<?php
} else {
    header("Location: login.php");
    exit();
}
?>