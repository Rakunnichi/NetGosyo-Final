<?php
require '../config.php';
session_start();



// if(isset($_GET['id'])){
	
//     $id = $_GET['id'];
	
// 		mysqli_query($conn, "DELETE FROM products WHERE id='$id'");
// 		header("location:my_products.php");
	

// }


if(isset($_POST['delete_btn_set'])){
	$del_id = $_POST['delete_id'];

	$delete_query = "DELETE FROM products WHERE id= '$del_id'";
	$delete_query_run  = mysqli_query($conn, $delete_query);
}


if(isset($_POST['accept_btn_set'])){
	$order_id = $_POST['order_id'];
	$seller_id = $_POST['user_id'];

	
	$order_query = "UPDATE orders SET status='Accepted' WHERE order_id='$order_id'";
	$order_query_run = mysqli_query($conn, $order_query);

	$notify_query = "INSERT INTO notifications SET user_id='$seller_id', notification='The seller accepted your order. Please refer to your purchases page for more Information!'";
	$notify_query_run = mysqli_query($conn, $notify_query);

}


if(isset($_POST['reject_btn_set'])){
	$order_id = $_POST['order_id'];
	$seller_id = $_POST['user_id'];


	$order_query = "UPDATE orders SET status='Rejected' WHERE order_id='$order_id'";
	$order_query_run = mysqli_query($conn, $order_query);

	$notify_query = "INSERT INTO notifications SET user_id='$seller_id', notification='The seller rejected your order. You can contact the seller for more info. Thank you!'";
	$notify_query_run = mysqli_query($conn, $notify_query);

}