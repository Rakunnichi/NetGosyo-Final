<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('location:index.php');
}

if (isset($_POST['submit']) || isset($_POST['submit2'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? $_POST['email2']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password'] ?? $_POST['password2']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass' ") or die('query failed');
    $ifseller = '';
   
if (mysqli_num_rows($select) > 0) {
  $row = mysqli_fetch_assoc($select);
  $_SESSION = $row;
  $verified = $row['verified'];

  if ($row['is_banned'] == 0) {
      if ($row['verified'] == 1) {
          $ifseller = $row['shopname'];

          if (isset($_POST['submit'])) {
            $_SESSION['role'] = ($ifseller == 'user') ? 'user' : 'seller';
            // $_SESSION['user_id'] = $row['id'];
            // header('Location:index.php');    
               // Seller login
               if ($ifseller == 'user') {
                // Continue with seller login
                $_SESSION['role'] = 'user';
                $_SESSION['user_id'] = $row['id'];
                header('Location:index.php');   
               
            } else {
              $message[] = 'The Account you are trying to login is not a User Account!';
            }

          } elseif (isset($_POST['submit2'])) {
              // Seller login
              if ($ifseller == 'user') {
                  // Prevent login for users with shopname 'user'
                  $message[] = 'The Account you are trying to login is not a Seller Account!';
              } else {
                  // Continue with seller login
                  $_SESSION['role'] = 'seller';
                  $_SESSION['user_id'] = $row['id'];
                  header('location:Seller_Page/index.php');
              }
          }
      } else {
          $message[] = 'Your account is not yet verified. Please check your email for the verification link.';
      }
  } else {
      $message[] = 'Your account is banned.';
  }
} else {
  $message[] = 'Incorrect Credentials!';
}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/login-style.css" />
  <title>Login Account</title>
  <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

   <!-- Include SweetAlert library -->
   <script src="js/sweetalert.min.js"></script>

</head>

<body>

  <?php
  if (isset($message)) {
    foreach ($message as $message) {
      ?>
        <script>
          swal({
            text: "<?php echo $message;?>",
            button: "Okay",
          });
        </script>
      <?php
     
    }
  }
  ?>

  <div class="container">

    <div class="forms-container">
     
      <div class="signin-signup">
        <form action="" class="sign-in-form" method="post" id="frmUser">
          <h2 class="title">User Login</h2>

          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" required placeholder="Email Address"  class="form-control" name="email" autocomplete="on">
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" class="form-control" name="password" autocomplete="on">
          </div>

          <input type="submit" value="Login" class="btn solid" name="submit" form="frmUser">

          <p class="social-text">Don't have an account? <a href="user-register.php">Register Here!</a></p>
          <p class="social-text">Forgot Password? <a href="forgot-password.php">Click Here!</a></p>
    
        </form>

        <form action="" class="sign-up-form" method="post" id="frmSeller">
          <h2 class="title">Seller Login</h2>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="Email Address" name="email2" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" class="form-control" name="password2" autocomplete="off" required>
          </div>

          <input type="submit" class="btn" value="Login" name="submit2" form="frmSeller">

          <p class="social-text">Don`t have an account? <a href="seller-register.php">Register Here!</a></p>
          <p class="social-text">Forgot Password? <a href="forgot-password.php">Click Here!</a></p>
     
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Switch to Seller Login</h3>
          <p>
            Got something to sell? It's time to share and earn!
            Login now to setup your shop.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Switch
          </button>
          <img src="assets/user-login.png" class="image" alt="" />
        </div>
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>Switch to User Login</h3>
          <p>
            Looking for something without any hassle? Shop your favorite Leyte products
            online! Click the button now.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Switch
          </button>
          <img src="assets/seller-login.png" class="image" alt="" />
        </div>
      </div>
    </div>
  </div>

  <script src="js/app.js"></script>
 
</body>

</html>