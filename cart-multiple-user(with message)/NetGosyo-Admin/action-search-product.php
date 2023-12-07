

<?php
include 'config.php';
 $search = isset($_GET['search-product']) ? $_GET['search-product'] : '';
 $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE `name` LIKE '%{$search}%'") or die('query failed!');
 
 $rows = mysqli_fetch_all($select_product, MYSQLI_ASSOC);
 if(mysqli_num_rows($select_product)!= null){
	include ('search-product.php');
 }else{
	include ('no-found-product.php');
 }


?>