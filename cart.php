<?php
require_once 'session_config.php';

if(!session_start())
    session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    if (isset($_GET['quantity1']) && isset($_GET['quantity2']) && isset($_GET['quantity3'])) {

        $totalPrice = 0.0;

        $quantity1 = htmlspecialchars($_GET['quantity1']);
        $quantity2 = htmlspecialchars($_GET['quantity2']);
        $quantity3 = htmlspecialchars($_GET['quantity3']);

        // Calculate the total price for each item
        $item1Price = $quantity1 * 12.50;
        $item2Price = $quantity2 * 15.50;
        $item3Price = $quantity3 * 20.00;

        // Calculate the overall total price
        $totalPrice = $item1Price + $item2Price + $item3Price;
    }


    // Generate CSRF token and store it in the session
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    $csrfToken = $_SESSION['csrf_token'];
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

        <!-- Cart -->
        <div id="cart" class="container black xxlarge padding-64">
            <h1 class="center jumbo padding-32">YOUR CART</h1>
            <form action="checkout.php" method="GET">

                <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
                <input type="hidden" name="quantity1" value="<?php echo $quantity1 ?>">
                <input type="hidden" name="quantity2" value="<?php echo $quantity2 ?>">
                <input type="hidden" name="quantity3" value="<?php echo $quantity3 ?>">
                <input type="hidden" name="total_price" value="<?php echo $totalPrice ?>">
                <?php


                if (isset($quantity1) || isset($quantity2) || isset($quantity3)) {

                    echo '<table class="styled-table" id="tableOne">
                    <thead>
                        <tr>
                            <th>Items</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>';
                    if ($quantity1 > 0) {
                        echo '<tr>
                        <td>Deluxe Cheese</td>
                        <td>' . $quantity1 . '</td>
                        <td>RM' . (number_format($item1Price, 2)) . '</td></tr>';
                    }
                    if ($quantity2 > 0) {
                        echo '<tr>
                        <td>Four of a Kind Cheese</td>
                        <td>' . $quantity2 . '</td>
                        <td>RM' . (number_format($item2Price, 2)) . '</td></tr>';
                    }
                    if ($quantity3 > 0) {
                        echo '<tr>
                        <td>Chicken Pepperoni</td>
                        <td>' . $quantity3 . '</td>
                        <td>RM' . (number_format($item3Price, 2)) . '</td></tr>';
                    }



                    echo '<tfoot>
                            <td colspan="2">Total Price:</td>
                            <td id="totalPrice">RM' . (number_format($totalPrice, 2)) . '</td>
                        </tfoot>
                    </tbody>
                    </table>

                    <div class="checkout-form">

                        <h2 class="form-heading">Delivery Details</h2>
                        <div class="form-row">
                            <label for="location">Location:</label>
                            <input type="text" id="location" name="location" placeholder="Enter Address Line 1" required>
                        </div>
                        <div class="form-row">
                            <label for="address-line2"></label>
                            <input type="text" id="location" name="location2" placeholder="Enter Address Line 2" required>
                        </div>



                        <div class="form-row">
                            <label for="delivery-date">Delivery Date:</label>
                            <input type="date" id="delivery-date" name="delivery-date" required>
                        </div>

                        <div class="form-row">
                            <label for="delivery-time">Delivery Time:</label>
                            <input type="time" id="delivery-time" name="delivery-time" required>
                        </div>


                        <h2 class="form-heading">Credit Card Information</h2>
                        <div class="form-row">
                            <label for="card-num">Card Number:</label>
                            <input type="text" id="card-num" name="card-num" required pattern="[0-9]{16}" title="Please enter a 16-digit card number">
                        </div>

                        <div class="form-row">
                            <label for="card-expiry-date">Expiry Date:</label>
                            <input type="text" id="card-expiry-date" name="card-expiry-date" required pattern="^(0[1-9]|1[0-2])\/?([0-9]{2}|[0-9]{2})$" title="Please enter a valid expiry date (MM/YY)">
                        </div>

                        <div class="form-row">
                            <label for="card-cvv">CVV:</label>
                            <input type="text" id="card-cvv" name="card-cvv" required pattern="[0-9]{3}" title="Please enter a 3-digit CVV">
                        </div>

                        <div class="form-row">
                            <input type="submit" value="Proceed to Checkout" class="checkout-button">
                        </div>
                    </div>
                    ';
                } else {
                    echo '<div class="cart-item">
                    <h2 class="item-name">No item listed in your cart</h2>
                    </div>';
                }
                ?>



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