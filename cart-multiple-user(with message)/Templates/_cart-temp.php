
<section class="pt-5 pb-5">
        <div class="container">
          <div class="row w-100">
              <div class="col-lg-12 col-md-12 col-12">
                  <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                  <p class="mb-5 text-center">
                      <i class="text-info font-weight-bold">3</i> items in your cart</p>
                  <table id="shoppingCart" class="table table-condensed table-responsive">
                      <thead>
                          <tr>
                              <th style="width:60%">Product</th>
                              <th style="width:12%">Price</th>
                              <th style="width:10%">Quantity</th>
                              <th style="width:16%"></th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
        $grand_total = 0;
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed!');
        if (mysqli_num_rows($cart_query) > 0) {
          while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
        ?>
                          <tr>
                              <td data-th="Product">
                                  <div class="row">
                                      <div class="col-md-3 text-left">
                                          <img src="Seller-uploads/<?php echo $fetch_cart['image'] ?? "./assets/products/1.png"; ?>" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                      </div>
                                      <div class="col-md-9 text-left mt-sm-2">
                                          <h4><?php echo $fetch_cart['name'] ?? "Unknown"; ?></h4>
                                          <p class="font-weight-light">Brand &amp; Name</p>
                                      </div>
                                  </div>
                              </td>
                              <td data-th="Price"> ₱ <?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                              <form method="post">
                              <td data-th="Quantity">
                                  <input type="number" class="form-control form-control-lg text-center" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                                  
                              </td>
                              <td class="actions" data-th="">
                                  <div class="text-right">
                                      <button class="btn btn-white border-secondary bg-white btn-md mb-2">
                                          <i class="fas fa-sync"></i>
                                      </button>
                                      <button class="btn btn-white border-secondary bg-white btn-md mb-2">
                                          <i class="fas fa-trash"></i>
                                      </button>
                                  </div>
                              </td>
                              </form>
                          </tr>
                        
                      </tbody>
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
                  
                </table>
                  <div class="float-right text-right">
                      <h4>Subtotal:</h4>
                      <h1>$99.00</h1>
                  </div>
              </div>
          </div>
          
          <div class="row mt-4 d-flex align-items-center">
              <div class="col-sm-6 order-md-2 text-right">
                  <a href="catalog.html" class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</a>
              </div>
              <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                  <a href="catalog.html">
                      <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
              </div>
          </div>
      </div>
      </section>
