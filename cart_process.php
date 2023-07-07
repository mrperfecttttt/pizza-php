<?php
session_start();

include "database/db_conn.php";

// Check if user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize form data
        $location = htmlspecialchars($_POST['location']);
        $addressLine2 = htmlspecialchars($_POST['address-line2']);
        $deliveryDate = htmlspecialchars($_POST['delivery-date']);
        $deliveryTime = htmlspecialchars($_POST['delivery-time']);
        $cardNumber = htmlspecialchars($_POST['card-num']);
        $expiryDate = htmlspecialchars($_POST['card-expiry-date']);
        $cvv = htmlspecialchars($_POST['card-cvv']);
        $pizzas = $_POST['pizza'];

        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO cart (line_address1, line_address2, delivery_date, delivery_time, card_num, card_expired, cvv)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $location, $addressLine2, $deliveryDate, $deliveryTime, $cardNumber, $expiryDate, $cvv);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Success message or redirect to a success page
            echo "Order placed successfully!";
        } else {
            // Error message or redirect to an error page
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        // Redirect if form is not submitted
        header("Location: cart.php");
        exit();
    }
} else {
    // Redirect if user is not logged in
    header("Location: login.php");
    exit();
}
?>
