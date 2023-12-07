<?php
include 'config.php';
 $search = isset($_GET['search']) ? $_GET['search'] : '';
 $select_product = mysqli_query($conn, "SELECT * FROM `user_form` WHERE `fullname` LIKE '%{$search}%'") or die('query failed!');
 
 $rows = mysqli_fetch_all($select_product, MYSQLI_ASSOC);
 if(mysqli_num_rows($select_product)!= null){
	include ('search.php');
 }else{
	include ('no-found.php');
 }


?>