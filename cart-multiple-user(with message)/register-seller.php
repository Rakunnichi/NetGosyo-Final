<?php

include 'config.php';

require 'vendor/autoload.php';

include 'controller/register-seller_coms.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="css/login-style.css" />
  <link rel="stylesheet" href="css/style.css">
  
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</head>

<body>

  <?php
  if (isset($message)) {
      foreach ($message as $message) {
          echo '
      <div class="wrapper role="alert" onclick="this.remove();"> 
      <div class="toast success ">
      <div class="container-1">
          <i class="fas fa-bell"></i>
      </div>
      <div class="container-2">
          <p>'.$message.'</p>
          <p></p>
      </div>
     
      </div>
      </div>';
      }
  }
?>

  <div class="form-container">

    <form action="" method="post" style="margin-top: 64px;">
      <h2 class="title">Sign Up</h2>
      <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" required placeholder="Username" class="form-control" name="username" autocomplete="on">
      </div>
      <div class="input-field">
        <i class="fas fa-user"></i>
        <input type="text" required placeholder="Fullname" class="form-control" name="name" autocomplete="on">
      </div>
      <div class="input-field">
        <i class="fas fa-store"></i>
        <input type="text" required placeholder="Shop Name" class="form-control" name="shopname" autocomplete="on">
      </div>
      <div class="input-field">
        <i class="fas fa-envelope"></i>
        <input type="email" required placeholder="Email Address" class="form-control" name="email" autocomplete="on">
      </div>
      <div class="input-field">
        <i class="fas fa-asterisk"></i>
        <input type="password" required placeholder="Password" class="form-control" name="password" autocomplete="on">
      </div>
      <div class="input-field">
        <i class="fas fa-asterisk"></i>
        <input type="password" required placeholder="Confirm Password" class="form-control" name="cpassword" autocomplete="on">
      </div>
      <input type="submit" name="submit" class="btn" value="register now">
      <p>Already have an account? <a href="login.php">Login Now!</a> </p>
    </form>
  </div>

</body>

</html>