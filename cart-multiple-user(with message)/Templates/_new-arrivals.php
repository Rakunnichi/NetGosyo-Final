 <!-- New Arrivals -->
 <section id="new-arrivals">
            <div class="container">
                <h4 class="font-rubik font-size-20"><b>New Arrivals</b></h4>
                <hr>

                  <!-- Owl-carousel -->
                  <div class="owl-carousel owl-theme">
                  <?php
  			       $select_product = mysqli_query($conn, "SELECT products.* FROM products LEFT JOIN user_form ON products.user_id = user_form.id
                     WHERE user_form.is_banned = 0 ") or die('query failed!');
                     if(mysqli_num_rows($select_product) > 0){
                         while($fetch_product = mysqli_fetch_assoc($select_product)){    
                    ?>

                    <div class="item py-2 ">
                        <div class="product font-rale">
                            <a href="<?php printf('%s?id=%s', 'product.php',  $fetch_product['id']); ?>"><img src="Seller-uploads/<?php echo $fetch_product['image']; ?>" alt="product1" class="img-fluid"></a>
                            <div class="text-center">
                                <h6 id="smaller-text-for-mobile"><b><?php echo $fetch_product['name'] ?? '0';?></b></h6>
                                <!-- <div class="rating text-orange font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div> -->
                                <div class="price py-2">
                                    <span><b>₱&nbsp;<?php echo $fetch_product['price'] ?? '0';?>.00</b></span>
                                </div>
                        <form method="post">
                            <input type="hidden" min="1" name="product_quantity" value="1">
                            <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                            <input type="hidden" name="seller_id" value="<?php echo $fetch_product['user_id']; ?>"> 
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                          
                            <button type="submit" class="btn color-orange-bg font-size-9 " name="add_to_cart">Add to Cart</button>
                        </form>
                            </div>
                        </div>
                    </div>
                    <?php
                 };
           }; 
        ?>
                 </div>
                 <!-- !Owl-carousel -->

            </div>
        </section>
        <!-- !New Arrivals -->
