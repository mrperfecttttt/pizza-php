<?php
session_start();

include "database/db_conn.php";

// Check if user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $location = $_POST['location'];
        $addressLine2 = $_POST['address-line2'];
        $deliveryDate = $_POST['delivery-date'];
        $deliveryTime = $_POST['delivery-time'];
        $cardNumber = $_POST['card-num'];
        $expiryDate = $_POST['card-expiry-date'];
        $cvv = $_POST['card-cvv'];
        $pizzas = $_POST['pizza'];

        // Prepare and execute the SQL query
        $sql = "INSERT INTO cart (line_address1, line_address2, delivery_date, delivery_time, card_num, card_expired, cvv)
                VALUES ('$location', '$addressLine2', '$deliveryDate', '$deliveryTime', '$cardNumber', '$expiryDate', '$cvv')";

        if ($conn->query($sql) === TRUE) {
            // Success message or redirect to a success page
            echo "Order placed successfully!";
        } else {
            // Error message or redirect to an error page
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

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
