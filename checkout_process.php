<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    // Validate CSRF token
    if (!strcmp($_POST['csrf_token'],$_SESSION['csrf_token'])) {
        header("Location: register.php?error=Invalid CSRF token");
        exit();
    }

    else if (isset($_GET['submit'])) {
        // Payment was submitted, process the payment and complete the order
        $quantity1 = htmlspecialchars($_GET['quantity1']);
        $quantity2 = htmlspecialchars($_GET['quantity2']);
        $quantity3 = htmlspecialchars($_GET['quantity3']);
        $totalPrice = htmlspecialchars($_GET['total_price']);
        $location = htmlspecialchars($_GET['location']);
        $deliveryDate = htmlspecialchars($_GET['delivery-date']);
        $deliveryTime = htmlspecialchars($_GET['delivery-time']);
        $cardNumber = htmlspecialchars($_GET['card-num']);
        $cardExpiryDate = htmlspecialchars($_GET['card-expiry-date']);
        $cardCVV = htmlspecialchars($_GET['card-cvv']);

        // Construct the state string
        $state = "$quantity1|#|$quantity2|#|$quantity3|#|$totalPrice|#|$location
        |#|$deliveryDate|#|$deliveryTime|#|$cardNumber|#|$cardExpiryDate|#|$cardCVV";

        // Server key
        $serverKey = 'super_secure_key';

        // Compute the message authentication code (MAC) using the server key
        $signature_check = hash_hmac('sha256', $state, $serverKey);

        // Compare the calculated signature with the received signature
        if ($signature_check === $_GET['signature']) {
            // Signature is valid, proceed with payment processing and order completion
            header("Location: order.php?status=Order processed successfully");
	        exit();
        } else {
            // Signature is invalid, display warning
            header("Location: order.php?status=Order failed due to unauthorized tampering!");
            exit();
        }

    } elseif (isset($_GET['cancel'])) {
        // Payment was canceled
        header("Location: order.php?status=Order has been cancelled.");
        exit();
    } else {
        // Invalid form submission, handle the error accordingly
        header("Location: home.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
