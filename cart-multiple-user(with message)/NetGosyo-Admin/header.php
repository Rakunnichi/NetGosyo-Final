<?php
include 'config.php';
session_start();
$user_name = $_SESSION['username'];
$user_id = '3';
if (!isset($user_name)) {
  header('location:../Netgosyo-Admin/login.php');
}
$products_count = mysqli_query($conn, "SELECT * FROM products");
$message_count = mysqli_query($conn, "SELECT * FROM convo WHERE recipient = '$user_id' ");
$notifications = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id ='$user_id'");
$user_count = mysqli_query($conn, "SELECT * FROM user_form WHERE shopname='user'");
$seller_count = mysqli_query($conn, "SELECT * FROM user_form WHERE shopname!='user'");


if (isset($_POST['send'])) {
  $convo_id = $_GET['convo_id'];
  $body = $_POST['message'];
  $attachment = $_FILES['attachment'];

  // Validate file type
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime'];
  $attachmentType = $attachment['type'];

  $convo_query = "SELECT * FROM convo 
								JOIN user_form ON user_form.id = convo.recipient
								WHERE convo_id='$convo_id'";
  $convo_query = mysqli_query($conn, $convo_query);
  $convo = mysqli_fetch_assoc($convo_query);

  $recipient = $convo['recipient'] == $user_id ? $convo['user_id'] : $convo['recipient'];

  if (!empty($attachment['tmp_name'])) {
    if (!in_array($attachmentType, $allowedTypes)) {
      $message[] = 'Invalid file type. Only JPEG, PNG, GIF, MP4, MPEG, and QuickTime files are allowed.';
    } else {
      $attachmentPath = '';
      if ($attachment['error'] === UPLOAD_ERR_OK) {
        $attachmentName = $attachment['name'];
        $attachmentTmpName = $attachment['tmp_name'];
        $attachmentPath = 'attachments/' . $attachmentName; // Specify the directory to save attachments

        // Move the uploaded attachment to the desired location
        move_uploaded_file($attachmentTmpName, $attachmentPath);
        $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id, attachment) VALUES ('$convo_id', '$body', '$user_id', '$recipient', '$attachmentPath')";
        $message[] = 'Message successfully sent!';
        mysqli_query($conn, $addMessage);
      } else {
        $message[] = 'An error occured, please try again.';
      }
    }
  } else {
    $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id) VALUES ('$convo_id', '$body', '$user_id', '$recipient')";
    $message[] = 'Message successfully sent!';
    mysqli_query($conn, $addMessage);
  }
}

if (isset($_POST['compose'])) {
  $recipient = $_POST['recipient'];
  $subject = $_POST['subject'];
  $body = $_POST['message'];
  $attachment = $_FILES['attachment'];

  // Validate file type
  $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg', 'video/quicktime'];
  $attachmentType = $attachment['type'];

  if (!empty($attachment['tmp_name'])) {
    if (!in_array($attachmentType, $allowedTypes)) {
      $message[] = 'Invalid file type. Only JPEG, PNG, GIF, MP4, MPEG, and QuickTime files are allowed.';
    } else {
      $attachmentPath = '';
      if ($attachment['error'] === UPLOAD_ERR_OK) {
        $attachmentName = $attachment['name'];
        $attachmentTmpName = $attachment['tmp_name'];
        $attachmentPath = '../attachments/' . $attachmentName; // Specify the directory to save attachments

        // Move the uploaded attachment to the desired location
        move_uploaded_file($attachmentTmpName, $attachmentPath);
        $addConvo = "INSERT INTO `convo` (user_id, recipient, subject) VALUES ('$user_id', '$recipient', '$subject')";

        if (mysqli_query($conn, $addConvo)) {
          $convo_id = mysqli_insert_id($conn);
          $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id, attachment) VALUES ('$convo_id', '$body', '$user_id', '$recipient', '$attachmentPath')";
          mysqli_query($conn, $addMessage);
          $message[] = 'Message successfully sent!';
        }
      } else {
        $message[] = 'An error occured, please try again.';
      }
    }
  } else {
    $addConvo = "INSERT INTO `convo` (user_id, recipient, subject) VALUES ('$user_id', '$recipient', '$subject')";

    if (mysqli_query($conn, $addConvo)) {
      $convo_id = mysqli_insert_id($conn);
      $addMessage = "INSERT INTO messages (convo_id, message, from_id, to_id) VALUES ('$convo_id', '$body', '$user_id', '$recipient')";
      mysqli_query($conn, $addMessage);
    }

    $message[] = 'Message successfully sent!';
  
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../NetGosyo-Admin/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../NetGosyo-Admin/assets/img/logo.png">
  <title>
    NetGosyo Admin
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../NetGosyo-Admin/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../NetGosyo-Admin/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../NetGosyo-Admin/assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <link rel="stylesheet" href="../NetGosyo-Admin/assets/css/style.css">
  
 
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#">       
        <span class="ms-1 font-weight-bold h3 strokeme">Administrator</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white" href="index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-white " href="manage_users.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">inventory</i>
            </div>
            <span class="nav-link-text ms-1">Manage Users</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-white " href="product_list.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">shopping_bag</i>
            </div>
            <span class="nav-link-text ms-1">List of Products</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-white " href="pending_approval.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">approval</i>
            </div>
            <span class="nav-link-text ms-1">Pending Appovals</span>
          </a>
        </li>

        <li class="nav-item ">
          <a class="nav-link text-white " href="checkout-pass.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">history</i>
            </div>
            <span class="nav-link-text ms-1">Checkout Pass Recovery</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Concerns and Messages</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white " href="messages.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">mail</i>
            </div>
            <span class="nav-link-text ms-1">Messages</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white " href="notifications.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>

      
      </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn button-remove w-100" href="logout.php" type="button">Logout Account</a>
      </div>
    </div>

  </aside>