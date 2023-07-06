<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
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

            <div class="cart-item">
                <h2 class="item-name">Deluxe Cheese</h2>
                <div class="item-details">
                    <div class="quantity-container">
                        <button class="minus-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="plus-btn">+</button>
                    </div>
                    <span class="item-price dark-grey round">RM12.50</span>
                </div>
            </div>

            <div class="cart-item">
                <h2 class="item-name">Four of a Kind Cheese</h2>
                <div class="item-details">
                    <div class="quantity-container">
                        <button class="minus-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="plus-btn">+</button>
                    </div>
                    <span class="item-price dark-grey round">RM15.50</span>
                </div>
            </div>

            <div class="cart-item">
                <h2 class="item-name">Chicken Pepperoni <span class="tag red round">Hot!</span></h2>
                <div class="item-details">
                    <div class="quantity-container">
                        <button class="minus-btn">-</button>
                        <span class="quantity">0</span>
                        <button class="plus-btn">+</button>
                    </div>
                    <span class="item-price dark-grey round">RM20.00</span>
                </div>
            </div>

            <div class="total-container right tag">
                <h2 class="total-price">Total Price: RM0</h2>
            </div>

            <div class="checkout-form">
                <form action="cart_process.php" method="POST">
                    <h2 class="form-heading">Delivery Details</h2>
                    <div class="form-row">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" placeholder="Enter Address Line 1" required>
                    </div>
                    <div class="form-row">
                        <label for="address-line2"></label>
                        <input type="text" id="location" name="location" placeholder="Enter Address Line 2" required>
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

                </form>

            </div>
        </div>

        <!-- <script src="script.js"></script> -->
    </body>

    </html>

<?php
} else {
    header("Location: login.php");
    exit();
}
?>