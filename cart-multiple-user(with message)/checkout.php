<?php
include 'header.php';

$id = $_SESSION['user_id'] ?? '3';
$name = '';





$sql = "SELECT * FROM user_form WHERE id=$id";
$user = mysqli_query($conn, $sql);

if (mysqli_num_rows($user) > 0) {
  $row = mysqli_fetch_assoc($user);
  $name = $row["fullname"];
  $phone = $row["phonenumber"];
  $address = $row["address"];
  $address2 = $row["address2"];
  $landmark = $row["landmark"];
  $city = $row["city"];
  $province = $row["province"];
  $archipelago = $row["archipelago"];
  $zip = $row["zip"];
  $storedPassword = $row["checkout_pass"];
}



function acronym_with_timestamp($string) {
  $string = strtoupper($string);

  $words = explode(" ", $string);
  $acronym = "";
  foreach ($words as $word) {
    $acronym .= $word[0];
  }

  $result = $acronym . time();

  return $result;
}

// Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   // Get form data
  
//   $name = $_POST["name"];
//   $contact = $_POST["contact"];
//   $address = $_POST["address"];
//   $city = $_POST["city"];
//   $state = $_POST["state"];
//   $zip = $_POST["zip"];
//   $pmode = $_POST["pmode"];
//   $enteredPassword = md5($_POST["checkoutPass"]);

//   if($enteredPassword != $storedPassword ){
//     echo '<script type="text/javascript">'
//     . '$( document ).ready(function() {'
//     . '$("#exampleModal").modal("hide");'
//     . '});'
//     . '</script>';
//     $Message = "Invalid Credentials!";

//     $getCart = "SELECT * FROM cart WHERE user_id=$id";
//     $result = mysqli_query($conn, $getCart);

//   } else{
//        // Prepare SQL statement
//   $destinctSeller = "SELECT DISTINCT seller_id FROM cart WHERE user_id=$id";

//   $destinctSeller = mysqli_query($conn, $destinctSeller);

//   if($destinctSeller){
//     while ($row = mysqli_fetch_assoc($destinctSeller)) {
//       $seller_id = $row['seller_id'];
//       $order_number = acronym_with_timestamp($_POST["name"]) . $seller_id;
//       $addOrder = "INSERT INTO orders (user_id, order_number, name, contact, address, city, state, zip,pmode,seller_id) VALUES ('$id', '$order_number', '$name', '$contact', '$address', '$city', '$state', '$zip', '$pmode', '$seller_id')";
//       mysqli_query($conn, "INSERT INTO notifications SET user_id='$seller_id', notification='A buyer placed an order. Go to the orders page for more information.'");
      
//       if (mysqli_query($conn, $addOrder)) {
//         $order_id = mysqli_insert_id($conn);
//         $result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id=$id AND seller_id = ' $seller_id' ");


//         if (mysqli_num_rows($result) > 0) {
//           while ($row = mysqli_fetch_assoc($result)) {
//             $product_id = $row['product_id'];
//             $qty = $row['quantity'];
//             mysqli_query($conn, "UPDATE products SET quantity = quantity - $qty WHERE id = '$product_id'");
//             mysqli_query($conn, "UPDATE products SET sales = sales + $qty WHERE id = '$product_id'");
//             $addItem = "INSERT INTO items (order_id, user_id, product_id, seller_id, qty) VALUES ('$order_id', '$id', '$product_id','$seller_id', '$qty')";
//             mysqli_query($conn, $addItem);
//           }
//         }
    
//         mysqli_query($conn, "DELETE FROM cart WHERE user_id = $id");
        
//         $Message = "Order Placed Successfully!";
//       } else {
//         $Message = "An Error Occured!";
//       }


//     }

  
//   }
    
//   }
 
// } else {
//   $getCart = "SELECT * FROM cart WHERE user_id=$id";
//   $result = mysqli_query($conn, $getCart);
  
// }

// working Form
// Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get form data
//     $name = $_POST["name"];
//     $contact = $_POST["contact"];
//     $address = $_POST["address"];
//     $city = $_POST["city"];
//     $state = $_POST["state"];
//     $zip = $_POST["zip"];
//     $pmode = $_POST["pmode"];
//     $enteredPassword = md5($_POST["checkoutPass"]);

//     if ($enteredPassword != $storedPassword) {
//         echo '<script type="text/javascript">'
//         . '$( document ).ready(function() {'
//         . '$("#exampleModal").modal("hide");'
//         . '});'
//         . '</script>';
//         $Message = "Invalid Credentials!";

//         $getCart = "SELECT * FROM cart WHERE user_id=$id";
//         $result = mysqli_query($conn, $getCart);

//     } else {
//         // Fetch cart items
//         $getCart = "SELECT * FROM cart WHERE user_id=$id";
//         $cartResult = mysqli_query($conn, $getCart);

//         if ($cartResult && mysqli_num_rows($cartResult) > 0) {
//             $orders = [];

//             // Organize cart items by seller
//             while ($cartItem = mysqli_fetch_assoc($cartResult)) {
//                 $seller_id = $cartItem['seller_id'];

//                 if (!isset($orders[$seller_id])) {
//                     // Initialize order details for this seller
//                     $orders[$seller_id] = [
//                         'order_number' => acronym_with_timestamp($name) . $seller_id,
//                         'items' => [],
//                     ];
//                 }

//                 // Add item to the order
//                 $orders[$seller_id]['items'][] = [
//                     'product_id' => $cartItem['product_id'],
//                     'quantity' => $cartItem['quantity'],
//                 ];
//             }

//             // Process orders for each seller
//             foreach ($orders as $seller_id => $orderDetails) {
//                 $order_number = $orderDetails['order_number'];
//                 $addOrder = "INSERT INTO orders (user_id, order_number, name, contact, address, city, state, zip, pmode, seller_id) VALUES ('$id', '$order_number', '$name', '$contact', '$address', '$city', '$state', '$zip', '$pmode', '$seller_id')";
                
//                 if (mysqli_query($conn, $addOrder)) {
//                     $order_id = mysqli_insert_id($conn);

//                     // Process items for this seller
//                     foreach ($orderDetails['items'] as $item) {
//                         $product_id = $item['product_id'];
//                         $qty = $item['quantity'];

//                         mysqli_query($conn, "UPDATE products SET quantity = quantity - $qty WHERE id = '$product_id'");
//                         mysqli_query($conn, "UPDATE products SET sales = sales + $qty WHERE id = '$product_id'");
//                         $addItem = "INSERT INTO items (order_id, user_id, product_id, seller_id, qty) VALUES ('$order_id', '$id', '$product_id', '$seller_id', '$qty')";
//                         mysqli_query($conn, $addItem);
//                     }
//                 } else {
//                     // Handle order insertion failure
//                     // ...
//                 }
//             }

//             // Clear the cart after processing all sellers
//             mysqli_query($conn, "DELETE FROM cart WHERE user_id = $id");

//             $Message = "Order Placed Successfully!";
//         } else {
//              $Message = "An Error Occured!";
//         }
//     }
// }else {
//   $getCart = "SELECT * FROM cart WHERE user_id=$id";
//   $result = mysqli_query($conn, $getCart);
  
// }



// Final Working Checkout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $zip = $_POST["zip"];
    $pmode = $_POST["pmode"];
    $enteredPassword = md5($_POST["checkoutPass"]);

    if ($enteredPassword != $storedPassword) {
         
      echo '<script type="text/javascript">'
          . '$( document ).ready(function() {'
          . '$("#exampleModal").modal("hide");'
          . '});'
          . '</script>';
          $Message = "Invalid Credentials!";

          $getCart = "SELECT * FROM cart WHERE user_id=$id";
          $cartResult = mysqli_query($conn, $getCart);

    } else {
        // Fetch cart items
        $getCart = "SELECT * FROM cart WHERE user_id=$id";
        $cartResult = mysqli_query($conn, $getCart);

        // Check for query success
        if ($cartResult === false) {
            // Handle query error
            echo "Query error: " . mysqli_error($conn);
        } else {
            // Check if cart is not empty
            if (mysqli_num_rows($cartResult) > 0) {
                $orders = [];

                // Organize cart items by seller
                while ($cartItem = mysqli_fetch_assoc($cartResult)) {
                    $seller_id = $cartItem['seller_id'];

                    if (!isset($orders[$seller_id])) {
                        // Initialize order details for this seller
                        $orders[$seller_id] = [
                            'order_number' => acronym_with_timestamp($name) . $seller_id,
                            'items' => [],
                        ];
                    }

                    // Add item to the order
                    $orders[$seller_id]['items'][] = [
                        'product_id' => $cartItem['product_id'],
                        'quantity' => $cartItem['quantity'],
                        'size' => $cartItem['size'],
                        'weight' => $cartItem['weight'],
                    ];
                }

                // Process orders for each seller
                foreach ($orders as $seller_id => $orderDetails) {
                    $order_number = $orderDetails['order_number'];
                    $addOrder = "INSERT INTO orders (user_id, order_number, name, contact, address, city, province, zip, pmode, seller_id) VALUES ('$id', '$order_number', '$name', '$contact', '$address', '$city', '$province', '$zip', '$pmode', '$seller_id')";
                    
                    if (mysqli_query($conn, $addOrder)) {
                        $order_id = mysqli_insert_id($conn);

                        // Process items for this seller
                        foreach ($orderDetails['items'] as $item) {
                            $product_id = $item['product_id'];
                            $qty = $item['quantity'];
                            $size = $item['size'];
                            $weight = $item['weight'];

                            mysqli_query($conn, "UPDATE products SET quantity = quantity - $qty WHERE id = '$product_id'");
                            mysqli_query($conn, "INSERT INTO notifications SET user_id='$seller_id', notification='A buyer placed an order. Go to the orders page for more information.'");
                            mysqli_query($conn, "UPDATE products SET sales = sales + $qty WHERE id = '$product_id'");
                            $addItem = "INSERT INTO items (order_id, user_id, product_id, seller_id, qty, size, weight) VALUES ('$order_id', '$id', '$product_id', '$seller_id', '$qty', '$size','$weight')";
                            mysqli_query($conn, $addItem);
                        }
                    } else {
                        // Handle order insertion failure
                        echo "Order insertion error: " . mysqli_error($conn);
                    }
                }

                // Clear the cart after processing all sellers
                mysqli_query($conn, "DELETE FROM cart WHERE user_id = $id");

                $Message = "Order Placed Successfully!";
            } else {
              $Message = "An Error Occured!";
            }
        }
    }
}
else {
    $getCart = "SELECT * FROM cart WHERE user_id=$id";
    $cartResult = mysqli_query($conn, $getCart);



    
  }

// End Final Working Checkout

?>



<!-- Top Products -->
<section id="top-products">
  <div class="container py-5">
    <div id="message"></div>
    <div class="row">
      <div class="col-md-7">
                        <?php
                            if(!empty($Message)){
                                echo"
                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>$Message</strong> 
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                                
                                ";
                            }
                        ?>


        <h4 class="font-rubik font-size-20 font-weight-bold">Checkout</h4>
        
        <?php if (empty($city) || empty($province) || empty($zip)) { ?>
          <div class="alert alert-warning" role="alert">
          Please update your profile settings before you can check out!
          </div>
          <?php } ?>
        
        <hr>
        <form id="frmCheckout" method="POST" action="">
          <div class="form-group">
            <label for="name">Name <span style="color: rgb(250, 1, 46);">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required value="<?= $name ?>">
          </div>

          <div class="form-group">
            <label for="contact">Contact <span style="color: rgb(250, 1, 46);">*</span></label>
            <input type="text" class="form-control" id="contact" name="contact" required value="<?= $phone ?>">
          </div>

          <div class="form-group">
            <label for="address">Address <span style="color: rgb(250, 1, 46);">*</span></label>
            <!-- <input type="text" class="form-control" id="address" name="address" required value="<?= $address ?>"> -->
            <select name="address" class="custom-select">
            <option value="<?= $address ?>"><?= $address ?></option>
            <option value="<?= $address2 ?>"><?= $address2 ?></option>
            </select>
          </div>

          <div class="form-group">
            <label for="landmark">Specific Location (Landmark)</label>
            <input type="text" class="form-control" id="address" name="landmark" required value="<?= $landmark ?>">
          </div>

          <div class="form-group">
            <label for="city">City <span style="color: rgb(250, 1, 46);">*</span></label>
            <input type="text" class="form-control" id="city" name="city" required value="<?= $city ?>">
          </div>

          <div class="form-group">
            <label for="province">Province <span style="color: rgb(250, 1, 46);">*</span></label>
            <input type="text" class="form-control" id="province" name="province" required value="<?= $province ?>">
          </div>

          <div class="form-group">
            <label for="zip">Zip Code <span style="color: rgb(250, 1, 46);">*</span></label>
            <input type="number" class="form-control" id="zip" name="zip" required value="<?= $zip ?>">
          </div>
          
    
          <div class="form-group">
            <h6>Payment Method</h6>
            <select name="pmode" class="custom-select" id="payment-method">
           
            <option value="Cash on Delivery" selected>
            Cash on Delivery
            </option>
             
            
            </select>
          </div>
            

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Checkout Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                  
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Checkout Password</label>
                                            <input type="Password" name="checkoutPass" class="form-control"
                                                id="recipient-name" required>
                                        </div>
                                  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    
                                    <button type="submit" class="btn color-checkout-bg" form="frmCheckout">Place
                                        Order</button>
                                </div>
                            </div>
                        </div>
                    </div>


        </form>
      </div>
      <div class="col-md-5">
        <h4 class="font-rubik font-size-20 font-weight-bold">Orders</h4>
        <hr>
        <table class="table table-bordered">
          <thead>
            <tr>
            
              <th>Product</th>
              <th>Price</th>
              <th>Qty</th>
              <th>Size</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cart = FALSE;
            $shipping_fee_total = 0;
            if (mysqli_num_rows($cartResult) > 0) {
              $cart = TRUE;
              $total = 0;
              while ($row = mysqli_fetch_assoc($cartResult)) {
                $total += $row["quantity"] * $row["price"]; ?>
                <tr>
               
                  <td><?= $row["name"] ?></td>
                  <td>₱<?= number_format($row["price"], 2) ?></td>
                  <td><?= $row["quantity"] ?></td>
                  <td><?= $row["size"] ?></td>
                  <td>₱<?= number_format($row["quantity"] * $row["price"], 2) ?></td>
                </tr>
           
              <tr>
                <td></td>
                <td class="text-right font-weight-bold" colspan="3">Shipping Fee</td>

                <td> 
                <?php    
                  $product_weight = $row["weight"]; // Get the product weight

                  if(($product_weight == "501g-1kg")){
                           // 0g-500g weight range
                          if ($archipelago == "Visayas") {
                            $shipping_fee = 85 * $row["quantity"];
                           // Adjust the format as needed
                          }elseif ($user_archipelago == "Luzon") {
                            $shipping_fee = 100 * $row["quantity"]; // Change 100 to your desired fee for luzon
                         
                          }
                          echo number_format($shipping_fee, 2);
                          $shipping_fee_total += $shipping_fee; 

                  }elseif ($product_weight > 500 && $product_weight <= 1000) {

                  }
                  
                ?>
                </td>


              </tr>
              <?php } ?>
              <tr>
                <td></td>
                <td class="text-right font-weight-bold" colspan="3">Total</td>
                <td>₱<?= number_format($total + $shipping_fee_total, 2) ?></td>
              </tr>
            <?php } else {
              $cart = FALSE;
            ?>
              <tr>
                <td class="text-center" colspan="4">No order in cart</td>
              </tr>
            <?php } ?>

          </tbody>
        </table>

        <?php if ($cart) { ?>

          <?php if (empty($city) || empty($province) || empty($zip)) { ?>
            <a href="#" class="btn btn-secondary btn-block" >Place Order </a>
            <?php } else{?>
              <a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"
                    class="btn color-orange-bg btn-block" >Place Order </a>
              <?php }?>

        <?php } else { ?>
          <a href="index.php" class="btn color-orange-bg btn-block mb-2">Shop Now!</a>
        <?php } ?>
        <a href="cart-main.php" class="btn btn-light btn-block mb-2">Back to Cart</a>

      </div>
    </div>
  </div>
</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php include 'footer.php'; ?>