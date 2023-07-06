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

        <script>
            // Calculate and update the total price
            function updateTotalPrice() {
                var quantityElements = document.getElementsByClassName('quantity');
                var priceElements = document.getElementsByClassName('item-price');
                var totalElement = document.getElementsByClassName('total-price')[0];

                var totalPrice = 0;

                for (var i = 0; i < quantityElements.length; i++) {
                    var quantity = parseInt(quantityElements[i].innerText);
                    var price = parseFloat(priceElements[i].innerText.substr(2)); // Extract the price without "RM"

                    var itemTotal = quantity * price;
                    totalPrice += itemTotal;
                }

                totalElement.innerText = 'Total Price: RM' + totalPrice.toFixed(2);
            }

            // Add event listeners to quantity buttons
            var minusButtons = document.getElementsByClassName('minus-button');
            var plusButtons = document.getElementsByClassName('plus-button');

            for (var i = 0; i < minusButtons.length; i++) {
                minusButtons[i].addEventListener('click', function () {
                    // Handle quantity decrease
                    // ...
                    updateTotalPrice();
                });

                plusButtons[i].addEventListener('click', function () {
                    // Handle quantity increase
                    // ...
                    updateTotalPrice();
                });
            }
        </script>


        <div class="checkout-form">
                <h2 class="form-heading">Delivery Details</h2>
                <form action="checkout.php" method="POST">
                    <div class="form-row">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>
                    </div>

                    <div class="form-row">
                    <label for="payment-method">Payment Method:</label>
                    <select id="payment-method" name="payment-method" required>
                        <option value="credit-card">Credit Card</option>
                        <option value="cash">Cash on Delivery</option>
                    </select>
                    </div>

                    <div class="form-row">
                    <label for="delivery-date">Delivery Date:</label>
                    <input type="date" id="delivery-date" name="delivery-date" required>
                    </div>

                    <div class="form-row">
                    <label for="delivery-time">Delivery Time:</label>
                    <input type="time" id="delivery-time" name="delivery-time" required>
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
