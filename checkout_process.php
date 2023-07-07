<?php
session_start();
include "database/db_conn.php";

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

    // Validate CSRF token
    if ($_GET['csrf_token'] !== $_SESSION['csrf_token']) {
        header("Location: order.php?status=Invalid CSRF token");
        exit();
    } else if (isset($_GET['submit'])) {
        // Payment was submitted, process the payment and complete the order
        $quantity1 = htmlspecialchars($_GET['quantity1']);
        $quantity2 = htmlspecialchars($_GET['quantity2']);
        $quantity3 = htmlspecialchars($_GET['quantity3']);
        $totalPrice = htmlspecialchars($_GET['total_price']);
        $location = htmlspecialchars($_GET['location']);
        $location2 = htmlspecialchars($_GET['location2']);
        $deliveryDate = htmlspecialchars($_GET['delivery-date']);
        $deliveryTime = htmlspecialchars($_GET['delivery-time']);
        $cardNumber = htmlspecialchars($_GET['card-num']);
        $cardExpiryDate = htmlspecialchars($_GET['card-expiry-date']);
        $cardCVV = htmlspecialchars($_GET['card-cvv']);

        // Construct the state string
        $state = "$quantity1|#|$quantity2|#|$quantity3|#|$totalPrice|#|$location|#|$location2
        |#|$deliveryDate|#|$deliveryTime|#|$cardNumber|#|$cardExpiryDate|#|$cardCVV";

        // Server key
        $serverKey = 'super_secure_key';

        // Compute the message authentication code (MAC) using the server key
        $signature_check = hash_hmac('sha256', $state, $serverKey);

        // Compare the calculated signature with the received signature
        if ($signature_check === $_GET['signature']) {
            // Signature is valid, proceed with payment processing and order completion
            // Prepare and bind the SQL statement

            // Encrypt the card details
            $encryptionKey = 'super_secure_key'; // Replace with your encryption key
            $encryptedCardNumber = openssl_encrypt($cardNumber, 'AES-128-CBC', $encryptionKey, OPENSSL_RAW_DATA, $iv);
            $encryptedCardExpiryDate = openssl_encrypt($cardExpiryDate, 'AES-128-CBC', $encryptionKey, OPENSSL_RAW_DATA, $iv);
            $encryptedCardCVV = openssl_encrypt($cardCVV, 'AES-128-CBC', $encryptionKey, OPENSSL_RAW_DATA, $iv);

            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_1, product_2, product_3, total_price, line_address1, line_address2, delivery_date, delivery_time, card_num, card_expired, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiidsssssss", $user_id, $quantity1, $quantity2, $quantity3, $totalPrice, $location, $location2, $deliveryDate, $deliveryTime, $encryptedCardNumber, $encryptedCardExpiryDate, $encryptedCardCVV);

            // Get the current user ID from the session or wherever it is stored
            $user_id = $_SESSION['id']; // Replace with your specific code to retrieve the user ID

            // Execute the prepared statement
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Insertion successful, proceed with payment processing and order completion
                header("Location: order.php?status=Order processed successfully");
                exit();
            } else {
                header("Location: order.php?status=Unable to process your order, Please try again");
                exit();
            }
        } else {
            // Signature is invalid, display warning
            echo $signature_check;
            echo " hello  ";
            echo $_GET['signature'];
            // header("Location: order.php?status=Order failed due to unauthorized tampering!");
            exit();
        }
    } elseif (isset($_GET['cancel'])) {
        // Payment was canceled
        header("Location: order.php?status=Order has been cancelled.");
        exit();
    } else {
        // Invalid form submission, handle the error accordingly
        header("Location: order.php?status=Unknown error, please try again later.");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
