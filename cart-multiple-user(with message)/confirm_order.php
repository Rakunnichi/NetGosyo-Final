<?php
include('config.php');

if (isset($_POST['confirm_button'])) {
    $order_id = $_POST['order_id'];

    // Update the order status to 'Received'
    $update_query = "UPDATE orders SET status = 'Received' WHERE order_id = '$order_id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: Profile_purchases.php?status=Order confirmed successfully");
        exit;
    } else {
        header("Location: Profile_purchases.php?error=Failed to confirm order");
        exit;
    }
} else {
    // Handle cases where the form is not submitted properly
    header("Location: Profile_purchases.php?error=Invalid request");
  
}

if (isset($_POST['cancel_button'])) {
    $order_id = $_POST['order_id'];

    // Update the order status to 'Cancelled'
    $update_query = "UPDATE orders SET status = 'Cancelled' WHERE order_id = '$order_id'";
    if (mysqli_query($conn, $update_query)) {
        header("Location: Profile_purchases.php?status=Order cancelled successfully");
        exit;
    } else {
        header("Location: Profile_purchases.php?error=Failed to cancel order");
        exit;
    }
} else {
    // Handle cases where the form is not submitted properly
    header("Location: Profile_purchases.php?error=Invalid request");
    exit;
}
?>
