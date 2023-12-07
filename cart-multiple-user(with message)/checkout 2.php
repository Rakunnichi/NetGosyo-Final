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
 
  $storedPassword  = mysqli_real_escape_string($conn, md5($row['checkout_pass']));
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// $sql = "SELECT * FROM user_form WHERE id=$id";
// $user = mysqli_query($conn, $sql);

// if (mysqli_num_rows($user) > 0) {
//   $checkout_pass = md5($row["checkout_pass"]);
// }

  // Get form data
  $order_number = acronym_with_timestamp($_POST["name"]);
  $name = $_POST["name"];
  $contact = $_POST["contact"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];
  $pmode = $_POST["pmode"];
//   $checkoutPass = md5($_POST["checkoutPass"]);
    $enteredPassword = mysqli_real_escape_string($conn, md5($_POST['checkoutPass']));

  if($enteredPassword != $storedPassword ){
    echo '<script type="text/javascript">'
    . '$( document ).ready(function() {'
    . '$("#exampleModal").modal("hide");'
    . '});'
    . '</script>';
    echo "<div class='alert alert-success text-center' role='alert' style='margin: 16px auto 0;width:600px;'>Invalid Credentials!!</div>";

    $getCart = "SELECT * FROM cart WHERE user_id=$id";
    $result = mysqli_query($conn, $getCart);

  } else {
    // Prepare SQL statement
  $addOrder = "INSERT INTO orders (user_id, order_number, name, contact, address, city, state, zip,pmode) VALUES ('$id', '$order_number', '$name', '$contact', '$address', '$city', '$state', '$zip', '$pmode')";

  if (mysqli_query($conn, $addOrder)) {
    $order_id = mysqli_insert_id($conn);
    $result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id=$id");
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $seller_id = $row['seller_id'];
        $qty = $row['quantity'];
        $addItem = "INSERT INTO items (order_id, user_id, product_id, seller_id, qty) VALUES ('$order_id', '$id', '$product_id','$seller_id', '$qty')";
        mysqli_query($conn, $addItem);
      }
    }

    mysqli_query($conn, "DELETE FROM cart WHERE user_id = $id");
    mysqli_query($conn, "UPDATE products SET quantity = quantity - 1 WHERE id='$product_id'");
    mysqli_query($conn, "INSERT INTO notifications SET user_id='1', notification='A buyer placed an order. Go to the orders page for more information.'");
    echo "<div class='alert alert-success text-center' role='alert' style='margin: 16px auto 0;width:600px;'>Order placed successfully!</div>";
  } else {
    echo "<div class='alert alert-danger text-center' role='alert' style='margin: 16px auto 0;width:600px;'>An error occured!</div>";
  }
  }
  
} else {
  $getCart = "SELECT * FROM cart WHERE user_id=$id";
  $result = mysqli_query($conn, $getCart);
  
}
?>



<!-- Top Products -->
<section id="top-products">
    <div class="container py-5">
        <div id="message"></div>
        <div class="row">
            <div class="col-md-7">
                <h4 class="font-rubik font-size-20 font-weight-bold">Checkout</h4>
                <hr>
                <form id="frmCheckout" method="POST" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?= $name ?>">
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required
                            value="<?= $phone ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Street Address</label>
                       
                        <input type="text" class="form-control" id="address" name="address" required
                            value="<?= $address ?>">
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>

                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                    </div>

                    <div class="form-group">
                        <label for="zip">Zip Code</label>
                        <input type="number" class="form-control" id="zip" name="zip" required>
                    </div>

                    <div class="form-group">
                        <h6>Choose A Payment Method</h6>
                        <select name="pmode" class="custom-select" id="payment-method">
                            <option selected>Choose...</option>
                            <?php
              $select_method = mysqli_query($conn, "SELECT * FROM `pmethod` ") or die('query failed!');
              if (mysqli_num_rows($select_method) > 0) {
              while ($fetch_method = mysqli_fetch_assoc($select_method)) {
            ?>
                            <option value="<?php echo $fetch_method['name']; ?>">
                                <?php echo $fetch_method['name']; ?>
                            </option>

                            <?php
              }
              }; 
            ?>
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
                            <th>Id</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            $cart = FALSE;
            if (mysqli_num_rows($result) > 0) {
              $cart = TRUE;
              $total = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                $total += $row["quantity"] * $row["price"]; ?>
                        <tr>
                            <td><?= $row["product_id"]?></td>
                            <td><?= $row["name"] ?></td>
                            <td>₱<?= number_format($row["price"], 2) ?></td>
                            <td><?= $row["quantity"] ?></td>
                            <td>₱<?= number_format($row["quantity"] * $row["price"], 2) ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td class="text-right font-weight-bold" colspan="3">Shipping Fee</td>
                            <td>₱0.00</td>
                        </tr>
                        <tr>
                            <td class="text-right font-weight-bold" colspan="3">Total</td>
                            <td>₱<?= number_format($total, 2) ?></td>
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
                <!-- <input type="submit" value="Place Order" class="btn color-orange-bg btn-block" form="frmCheckout"> -->
                <a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"
                    class="btn color-orange-bg btn-block">Place Order </a>
                <?php } else { ?>
                <a href="index.php" class="btn color-orange-bg btn-block mb-2">Shop Now!</a>
                <?php } ?>
                <a href="cart-main.php" class="btn btn-light btn-block mb-2">Back to Cart</a>

                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Order Policy:</p>
                        <ul>
                            <li>Orders will be processed and shipped within 2-3 business days.</li>
                            <li>We offer free shipping for orders over ₱100.</li>
                            <li>All orders come with a 30-day money-back guarantee.</li>
                            <li>If you have any questions or concerns, please contact us at support@netgosyo.com.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



</section>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src="sweetalert/sweetalert2.all.min.js"></script>
<script src="sweetalert/jquery-3.6.1.min.js"></script>

<?php include 'footer.php'; ?>