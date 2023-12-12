<!-- Product -->
<?php
include('config.php');
$id = $_GET['id'] ?? 1;
$user_id = $_SESSION['user_id']?? '3';

$sqlArchipelago = "SELECT * FROM user_form WHERE id=$user_id";
$archi = mysqli_query($conn, $sqlArchipelago);

if (mysqli_num_rows($archi) > 0) {
  $row = mysqli_fetch_assoc($archi);
 
  $archipelago = $row["archipelago"];

  
}


if (isset($_POST['review_submit'])) {
    // Get the submitted data
    $productId = mysqli_real_escape_string($conn, $_POST["productId"]);
    $user_rater = mysqli_real_escape_string($conn, $_POST["user_rater"]);
    $rating = mysqli_real_escape_string($conn, $_POST["rating"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
  
    // Insert the review into the database
    mysqli_query($conn, "INSERT INTO `review_table` (product_id,user_name, user_rating, user_review) VALUES('$productId','$user_rater', '$rating', '$comment')") or die('query failed');
    $message[] = 'Review Added';
   

   
}


$sql = "SELECT * FROM user_form WHERE id=$user_id";
$user = mysqli_query($conn, $sql);

if (mysqli_num_rows($user) > 0) {
  $row = mysqli_fetch_assoc($user);
  $name = $row["fullname"];
}

$sql3 = "SELECT * FROM products WHERE id=$id";
$product1 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($product1) > 0) {
    $row = mysqli_fetch_assoc($product1);
    $sellerProd_id = $row["user_id"];
  }


$sql2 = "SELECT * FROM user_form WHERE id=$sellerProd_id";
$product = mysqli_query($conn, $sql2);

if (mysqli_num_rows($product) > 0) {
    $row = mysqli_fetch_assoc($product);
    $seller_shop = $row["shopname"];
  }



$stmt = $conn->prepare('SELECT * FROM products');
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) :
  if ($row['id'] == $id) :
?>

<section id="product" class="py-3">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-6">
                <img src="Seller-uploads/<?php echo $row['image'] ?? "1.png"; ?>" alt="product" class="img-fluid" style="display: block; margin: auto;">
                <div class="form-row pt-4 font-size-16 font-baloo">

                    <?php if($user_id == 3){
                  ?>
                    <div class="col">
                        <a href="cart-main.php"><button type="submit" class="btn btn-danger form-control"
                                disabled>View Cart</button></a>
                    </div>
                    <?php
                    }else{
                        ?>
                    <div class="col">
                        <a href="cart-main.php"><button type="submit"
                                class="btn btn-danger form-control">View Cart</button></a>
                    </div>
                    <?php
                    }
                    ?>

                    <div class="col">
                        <form action="" class="form-submit" method="POST">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="seller_id" value="<?= $row['user_id'] ?>">
                            <input type="hidden" name="product_name" value="<?= $row['name'] ?>">
                            <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
                            <input type="hidden" name="product_image" value="<?= $row['image'] ?>">
                            <input type="hidden" name="product_weight" value="<?= $row['weight'] ?>">
                            <input type="hidden" name="product_archipelago" value="<?= $archipelago; ?>">
                            <input type="hidden" name="product_quantity" value="1">
                           
                            <button type="submit" name="add_to_cart" class="btn color-orange-bg form-control">Add
                                to Cart</button>
               
                    </div>
                </div>
            </div>
            <div class="col-sm-6 py-5">
                <h5 class="font-baloo font-size-20 ml-0 mb-0"><?php echo $row['name'] ?? "Unknown"; ?></h5>
                <small><b>Category:</b> <?php echo $row['item_brand'] ?? "Brand"; ?></small>
                <div class="d-flex mb-3">
                    
                </div>
                <hr class="m-0">

                <!-- Product price-->
                <table class="my-3">
                    <tr class="font-rale font-size-14">
                        <td>Price: </td>
                        <td>Stock Available: </td>
                    </tr>
                    <tr>
                        <td class="font-size-20 text-danger">
                            ₱<span><?php echo $row['price'] ?? 0; ?></span>
                        </td>
                        <td class="font-size-20 text-black  ">
                            <span><?php echo $row['quantity'] ?? 0; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td><small class="text-dark font-size-12">Including Shipping Fee</small></td>
                    </tr>
                </table>
                <!-- !Product price-->

                <!-- #Policy-->
                <div id="policy">
                    <div class="d-flex">
                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span class="fas fa-retweet border p-3 rounded-pill" style="color:#E6873C"></span>
                            </div>
                            <p href="javascript:" class="font-rale font-size-12">30 Days <br> Return Policy</p>
                        </div>
                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span class="fas fa-truck  border p-3 rounded-pill" style="color:#E6873C"></span>
                            </div>
                            <p href="javascript:" class="font-rale font-size-12">2-3 Days<br>Delivered</p>
                        </div>
                        <div class="return text-center mr-5">
                            <div class="font-size-20 my-2 color-second">
                                <span class="fas fa-check-double border p-3 rounded-pill" style="color:#E6873C"></span>
                            </div>
                            <p href="javascript:" class="font-rale font-size-12">1 Week Warranty<br>(Non-Perishable)</p>
                        </div>
                    </div>
                </div>
                <!-- !#Policy-->
                <hr>

                <!-- Order Details -->
                <div id="order-details" class="font-rale d-flex flex-column text-dark">
                    <small><i class="fas fa-calendar color-primary mr-1" style="width:16px"></i> Delivery by : 2 -
                        3 Days</small>
                    <small><i class="fas fa-check color-primary mr-1" style="width:16px; text-decoration:"></i> Sold by 
                           <b><?= $seller_shop ?></b></small>
                    <small><i class="fas fa-map-marker-alt color-primary mr-1" style="width:16px"></i> Deliver to
                        Customer - <b><?= $name ?> </b></small>
                </div>
                <!-- !Order Details -->
                    
                <?php if($row['item_brand'] == 'Men-Apparel') { ?>

                   <!-- size -->
                   <div class="size my-3">
                        <h6 class="font-baloo">Size :</h6>
                        <div class="d-flex justify-content-between w-50">
                            <select class="form-control" name="product_size">
                                <option value="SMALL">SMALL</option>
                                <option value="MEDIUM">MEDIUM</option>
                                <option value="LARGE">LARGE</option>
                            </select>
                        </div>
                    </div>
                    <!-- !size -->
                    

                <?php } else if($row['item_brand'] == 'Women-Apparel') { ?>

                    <!-- size -->
                    <div class="size my-3">
                        <h6 class="font-baloo">Size :</h6>
                        <div class="d-flex justify-content-between w-50">
                            <select class="form-control" name="product_size">
                                <option value="SMALL">SMALL</option>
                                <option value="MEDIUM">MEDIUM</option>
                                <option value="LARGE">LARGE</option>
                            </select>
                        </div>
                    </div>
                    <!-- !size -->

                <?php } ?>
                 

            
            </form>
                        
            </div>
            <div class="col-12 pt-4">
                <h6 class="font-rubik">Product Description</h6>
                <hr>
                <p class="font-rale font-size-16 text-justify"><?php echo $row['description'];?></p>
            </div>
        </div>
    </div>
</section>
<!-- !Product -->
<?php
  endif;
endwhile;
?>
    <section id="top-products" class="py-3 pt-3 pb-3">
        <div class="container">

        <?php

        $rating = $conn->query('SELECT * FROM products');

        if ($rating->num_rows > 0) {
            $reviewsResult = $conn->query("SELECT * FROM review_table WHERE product_id = $id ORDER BY user_rating DESC" );
        
        


            // Calculate total reviews and average rating
            $totalReviews = $reviewsResult->num_rows;
            $averageRating = 0;

            // Sum up the ratings
            while ($review = $reviewsResult->fetch_assoc()) {
                $averageRating += $review['user_rating'];
            }

            // Calculate the average rating if there are reviews
            if ($totalReviews > 0) {
                $averageRating /= $totalReviews;
            }

                // Display summary of reviews
                echo "<div class='reviews'>";
                echo "<h3><center>Reviews Summary:</center></h3>";
                echo "<p><b>Total Reviews:</b> $totalReviews</p>";

                // Display star rating for the average rating
                echo "<p><b>Average Rating:</b> ";
                for ($i = 1; $i <= 5; $i++) {
                if ($i <= $averageRating) {
                // Full star for rated value
                echo "<i class='fas fa-star text-orange'></i>";
                } else {
                // Empty star for unrated value
                    echo "<i class='far fa-star text-orange'></i>";
                }
                }

                echo " (" . number_format($averageRating, 1) . " stars)</p>";

                echo "</div>";

                
                
                        // Display reviews using Bootstrap and Font Awesome for star ratings
                        echo "<div class='reviews'>";
                        if ($totalReviews > 0) {
                            echo "<h3>Comments:</h3>";
                            $reviewsResult->data_seek(0);  // Reset the result pointer

                            
                            while ($review = $reviewsResult->fetch_assoc()) {
                                $user = $review['user_name'];
                                $rating = $review['user_rating'];
                                $comment = $review['user_review'];

                                // Display star rating based on the 'rating' value
                                echo "<div class='card'>";
                                echo "<div class='card-body'>";
                                echo "<p class='card-text'><strong>User:</strong> $user</p>";
                                echo "<p class='card-text'><strong>Rating:</strong> ";

                                // Display star icons based on the rating
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $rating) {
                                        // Full star for rated value
                                        echo "<i class='fas fa-star text-orange'></i>";
                                    } else {
                                        // Empty star for unrated value
                                        echo "<i class='far fa-star text-orange'></i>";
                                    }
                                }

                                echo "</p>";
                                echo "<p class='card-text'><strong>Comment:</strong> $comment</p>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div class='alert color-orange-bg' role='alert'><b><center>No Reviews Yet!</center></b></div>";
                        }
                        echo "</div>";
                            
                        
                                // Display form for rating and reviewing the product using Bootstrap classes
                            echo "<form method='post'>";

                            echo "<input type='hidden' name='productId' value='$id'>";
                            echo "<input type='hidden' name='user_rater' value='$name'>";
                            echo "<div class='form-group'>";
                            echo "<br>";
                            echo "<h3>Leave a Review:</h3>";
                            echo "<label for='rating'><b>Rating:</b></label>";
                            echo "<select class='form-control' name='rating' style='width:auto;'>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='4'>4</option>";
                            echo "<option value='5'>5</option>";
                            echo "</select>";
                            echo "</div>";
            
                            
                            echo "<div class='form-group'>";
                            echo "<label for='comment'><b>Comment:</b></label>";
                            echo "<textarea class='form-control' name='comment' ></textarea>";
                            echo "</div>";
                            

                           
                            if($user_id == 3){
                                echo "<button type='submit' name='review_submit' class='btn color-orange-bg' disabled>Submit Review</button>";
                            }else{
                                echo "<button type='submit' name='review_submit' class='btn color-orange-bg'>Submit Review</button>";
                            }
                            
                            echo "</form>";

                            

                    echo "</div>";
        

        }

        ?>

        </div>
    </section>



<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>