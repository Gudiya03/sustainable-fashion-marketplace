<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $card_number = $_POST["card_number"];
    $expiry = $_POST["expiry"];
    $cvv = $_POST["cvv"];

    // ⚠️ In a real-world app, integrate with Stripe, PayPal, or Razorpay here
    $isPaymentSuccessful = true; // Simulate successful payment

    if ($isPaymentSuccessful) {
        echo "<script>
            alert('Payment Successful! Your order is confirmed.');
            window.location.href = 'success.html';
        </script>";
    } else {
        echo "<script>
            alert('Payment Failed! Try again.');
            window.location.href = 'payment.html';
        </script>";
    }
} else {
    echo "Invalid request!";
}
?>
