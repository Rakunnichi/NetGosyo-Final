
<!-- Top Products -->
<section id="top-products">
  <div class="container py-5">
    <div id="message"></div>
    <h4 class="font-rubik font-size-20"><b>Top Products</b></h4>

    <hr>
    <!-- Owl-carousel -->
    <div class="owl-carousel owl-theme">
      <?php
      // $select_product = mysqli_query($conn, "SELECT * FROM `products`  ") or die('query failed!');
       $select_product = mysqli_query($conn, "SELECT products.* FROM products LEFT JOIN user_form ON products.user_id = user_form.id
       WHERE user_form.is_banned = 0 ORDER BY products.sales DESC") or die('query failed!');
      if (mysqli_num_rows($select_product) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_product)) {
         
      ?>

          <div class="item py-2">
         
          <h6 class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"> <b>Sold:</b>
          <?php 
                        $totalSales = $fetch_product['sales'] ?? 0;
                        echo ($totalSales > 1000) ? number_format($totalSales / 1000, 1) . 'k' : $totalSales;
                    ?>
        </h6>
        
            <div class="product font-rale">
              <a href="<?php printf('%s?id=%s', 'product.php',  $fetch_product['id']); ?>"><img src="Seller-uploads/<?php echo $fetch_product['image']; ?>" alt="product1" class="img-fluid"></a>
              <div class="text-center">
                <h6 id="smaller-text-for-mobile"><b><?php echo $fetch_product['name'] ?? '0'; ?></b></h6>
                
                <div class="price py-2">
                  <span><b>₱&nbsp;<?php echo $fetch_product['price'] ?? '0'; ?>.00</b></span>
                </div>
                <form method="post">
                  <input type="hidden" min="1" name="product_quantity" value="1">
                  <input type="hidden" name="product_id" value="<?php echo $fetch_product['id']; ?>">
                  <input type="hidden" name="seller_id" value="<?php echo $fetch_product['user_id']; ?>">
                  <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                  <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                  <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                  <!-- <button type="submit" class="btn color-orange-bg font-size-9 " name="add_to_cart">Add to Cart</button> -->
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
<!-- !Top Products -->

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src="sweetalert/sweetalert2.all.min.js"></script>
<script src="sweetalert/jquery-3.6.1.min.js"></script>