<?php
require 'config.php';
session_start();

if(isset($_GET['user_id'])){

	$user_id = $_GET['user_id'];
	mysqli_query($conn, "DELETE FROM notifications WHERE user_id='$user_id'");
	header("location:notifications.php");

}