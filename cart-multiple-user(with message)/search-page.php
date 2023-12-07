<?php
  ob_start();
  include ('header.php');
?>


<?php
 $search = isset($_GET['search']) ? $_GET['search'] : '';
 $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE `name` LIKE '%{$search}%'") or die('query failed!');
 $rows = mysqli_fetch_all($select_product, MYSQLI_ASSOC);
 if(mysqli_num_rows($select_product)!= null){
	include ('Templates/_search-template.php');
 }else{
	include ('Templates/_search-not-found.php');
 }


?>



  

<?php
include('footer.php');
?>