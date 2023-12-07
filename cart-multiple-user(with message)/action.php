<?php
require 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '3';
// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {

	$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = '$user_id'");
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;
	echo $rows;
}


if (isset($_GET['action'])) {
	$action = $_GET['action'];
	if ($action == 'accept') {
		$id = $_GET['id'];
		$user_id = $_GET['user_id'];
		mysqli_query($conn, "UPDATE orders SET status='Accepted' WHERE order_id='$id'");
		mysqli_query($conn, "INSERT INTO notifications SET user_id='$user_id', notification='The seller accepted your order. Expected to arrive in 2-3 business days. Thank you!'");
		header("location: Seller_Page/orders.php?status=Order successfully accepted!");
	} elseif ($action == 'reject') {
		$id = $_GET['id'];
		$user_id = $_GET['user_id'];
		mysqli_query($conn, "UPDATE orders SET status='Rejected' WHERE order_id='$id'");
		mysqli_query($conn, "INSERT INTO notifications SET user_id='$user_id', notification='The seller rejected your order. You can contact the seller for more info. Thank you!'");
		header("location: Seller_Page/orders.php?status=Order successfully rejected!");
	}
}

if (isset($_GET['badge_action'])) {
	$action = $_GET['badge_action'];
	if ($action == 'accept') {
		$user_id = $_GET['user_id'];
		mysqli_query($conn, "UPDATE user_form SET has_verified_badge='1' WHERE id='$user_id'");
		mysqli_query($conn, "INSERT INTO notifications SET user_id='$user_id', notification='Your badge application has been approved.'");
		header("location: Netgosyo-Admin/pending_approval.php");
	} elseif ($action == 'reject') {
		$user_id = $_GET['user_id'];

		$stmt = mysqli_query($conn, "SELECT id_pic FROM  user_form WHERE id = '$user_id'");
      $row = mysqli_fetch_array($stmt);
      $deleteimage = $row['id_pic'];
      if(file_exists('user-profiles/' . $deleteimage) && $deleteimage){
        unlink('user-profiles/' . $deleteimage);
      }
		mysqli_query($conn, "UPDATE user_form SET has_verified_badge='0', id_pic = '' WHERE id='$user_id'");
		mysqli_query($conn, "INSERT INTO notifications SET user_id='$user_id', notification='Your badge application has been rejected. Resubmit ID.'");
		header("location: Netgosyo-Admin/pending_approval.php");
	}
}

// if(isset($_GET['id'])){
	
//     $id = $_GET['id'];
	
// 		mysqli_query($conn, "DELETE FROM products WHERE id='$id'");
// 		header("location:Seller_Page/my_products.php");
	

// }

// if(isset($_GET['user_id'])){

// 	$user_id = $_GET['user_id'];
// 	mysqli_query($conn, "DELETE FROM notifications WHERE user_id='$user_id'");
// 	header("location:notifications.php");

// }



if(isset($_POST['delete_cart_btn_set'])){
	$del_id = $_POST['delete_id'];

	$delete_query = "DELETE FROM `cart` WHERE id = '$del_id'";
	$delete_query_run  = mysqli_query($conn, $delete_query);
}
