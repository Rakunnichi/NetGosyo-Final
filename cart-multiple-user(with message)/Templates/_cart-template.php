<?php

$sql = "SELECT * FROM user_form WHERE id=$user_id";
$user = mysqli_query($conn, $sql);

if (mysqli_num_rows($user) > 0) {
  $row = mysqli_fetch_assoc($user);
  $number_verified = $row["number_verified"];
 
}

?>
<!-- Shopping Cart  Section-->

<section id="cart" class="py-3">
  <div class="container-fluid width w-75">
    <h5 class="font-baloo font-size-20 ml-0"><b>Cart Details</b></h5>
    <?php if($number_verified == 0){ ?>

     
      <div class="alert alert-warning text-center" role="alert">
        Please go to profile settings Verify your Mobile Number before checking out!
      </div>
     

    <?php } ?>
    
    <!-- Shopping Cart Items -->
    <div class="row">
      <div class="col-sm-9">
        <?php
        $grand_total = 0;
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed!');
        if (mysqli_num_rows($cart_query) > 0) {
          while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
            $seller_id = $fetch_cart['seller_id'];
        ?>
            <!-- Cart Items1 -->
            
            <div id="cart-product" class="row border-top py-3 mt-3">
           
            <h5  id="cart-prod-name-1" class="font-baloo font-size-20 ml-0 mb-0"><?php echo $fetch_cart['name'] ?? "Unknown"; ?></h5>
          
              <div id="cart-image" class="col-sm-2">
                <img src="Seller-uploads/<?php echo $fetch_cart['image'] ?? "./assets/products/1.png"; ?>" style="height:110px;" alt="cart1" class="img-fluid">
              </div>
              <div id="cart-name" class="col-sm-8">
                <h5  id="cart-prod-name" class="font-baloo font-size-20 ml-0 mb-0"><?php echo $fetch_cart['name'] ?? "Unknown"; ?></h5>
                
                <?php
                $sql = "SELECT * FROM user_form WHERE id= $seller_id";
                $user = mysqli_query($conn, $sql);

                if (mysqli_num_rows($user) > 0) {
                  $row = mysqli_fetch_assoc($user);
                  $shopname = $row["shopname"];
                
                }
                ?>
                
                <small>Seller: <b><?php echo $shopname; ?></b></small>
                
                <?php if($fetch_cart['size'] == "none"){ ?>
                  

                <?php } else{ ?>
                  <br>
                  <small>Size: <b><?php echo $fetch_cart['size']; ?></b></small>
                <?php  } ?>

                <!-- Product Qty -->
                <div class="qty d-flex pt-2">

                  <form method="post">
                    <div class="d-flex font-rale w-30">
                      <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                      <!-- <input  id="quantity-input" type="number" class="qty_input border px-2 w-100 bg-light" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>"> -->
                     
                    
                        <div class="input-group-prepend">
                            <button type="submit" type="submit" name="update_cart" class="btn btn-outline-secondary" onclick="decrement('<?php echo $fetch_cart['id']; ?>')">-</button>
                        </div>
                        <input type="text" id="quantity_<?php echo $fetch_cart['id']; ?>" type="number" name="cart_quantity"  min="1" class="form-control text-center" value="<?php echo $fetch_cart['quantity']; ?>">
                        <div class="input-group-append">
                            <button  id="cart-update" type="submit" name="update_cart" class="btn btn-outline-secondary" onclick="increment('<?php echo $fetch_cart['id']; ?>')">+</button>
                        </div>
                  

                      <!-- <button type="submit" id="cart-update" name="update_cart" class="btn font-baloo text-danger px-3 border-right ">Update</button> -->
                    </div>
                  </form>

                        <input type="hidden" class="cart_id_value" value="<?php echo $fetch_cart['id']; ?>" >
                        <a href="javascript:" class="remove_btn_ajax btn font-baloo text-danger px-3 border-right" >Remove</a>
                  <!-- <a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" id="cart-delete" class="btn font-baloo text-danger px-3 border-right" onclick="return confirm('remove item from cart?');">Remove</a> -->


                  <a href="#" id="pricing-cart" class="btn font-baloo text-danger px-3 border-right">₱<span class="product_price" data-id=""><?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></span></a>
                </div>
                <!-- Product Qty -->
              </div>

              <div id="cart-price" class="col-sm-2 text-right">
                <div class="font-size-20 text-danger font-baloo">
                  ₱<span class="product_price" data-id=""><?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'], 2, '.', ''); ?></span>
                </div>
              </div>
            </div>
            <!-- !Cart Items1 -->
        <?php
            $grand_total += (float) $sub_total;
          };
        } else {
          echo '  <!-- Shopping Cart Items -->
          <div class="row border-top py-3 mt-3">
              <div class="col-sm-9">
                  <!-- Empty Cart -->
                      <div class="row">
                          <div class="col-sm-12 text-center py-2">
                              <img src="./assets/cart_empty.png" alt="Empty Cart" class="img-fluid" style="height:200px">
                              <p class="font-baloo font-size-16 text-black"> Your Cart is Empty! Add some Products</p>
                          </div>
                      </div>
                  <!-- !Empty Cart -->
              </div>
          </div>
          <!-- !Shopping Cart Items -->';
        }
        ?>
      </div>

      <!-- Sub Total Section -->
      <div class="col-sm-3">
        <div class="sub-total border text-center mt-2">
          <h6 class="font-size-12 font-rale text-success py-3 mb-0"><i class="fas fa-check"></i> Orders are Elgible for Free Shipping.</h6>
          <div class="border-top py-4">
            <h5 class="font-baloo font-size-20">Subtotal: &nbsp;<span class="text-danger">₱<span class="text-danger" id="deal-price"><?php echo $grand_total; ?>.00</span></span></h5>
           
            <?php if($number_verified == 0){ ?>

              <button type="submit" name="checkout-cart" class="btn color-orange-bg mt-3" disabled>Checkout Cart</button>
           

            <?php } else{ ?>

              <a href="checkout.php" type="submit" name="checkout-cart" class="btn color-orange-bg mt-3">Checkout Cart</a>

          <?php  } ?>
          
          </div>
        </div>
      </div>
      <!-- !Sub Total Section -->

    </div>
    <!-- !Shopping Cart Items -->


  </div>
</section>
<!-- !Shopping Cart Section-->