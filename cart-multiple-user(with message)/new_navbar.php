<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? '3';
$notifications = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id='$user_id' ORDER BY notification_added DESC");


$sql = "SELECT * FROM user_form WHERE id=$user_id";
$select_review = mysqli_query($conn, $sql);

if (mysqli_num_rows($select_review) > 0) {
  $row = mysqli_fetch_assoc($select_review);
  $reviewer_name = $row["username"];
 
}

if (isset($_GET['logout'])) {
  unset($user_id);
  session_destroy();
  header('location:index.php');
}


if (isset($_POST['add_to_cart'])) {
  if($user_id == 3){
    header('location:login.php');
    
}else{
  $product_id = $_POST['product_id'];
 
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' 
    AND user_id = '$user_id'") or die('query failed');

  if (mysqli_num_rows($select_cart) > 0) {
    $message[] = 'Product Already in Cart!';
  } else {
    mysqli_query($conn, "INSERT INTO `cart` (user_id, product_id, name, price, image, quantity) VALUES
        ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
    $message[] = 'Product Added to Cart!';
  }
}
}

if (isset($_POST['update_cart'])) {
  $update_quantity = $_POST['cart_quantity'];
  $update_id = $_POST['cart_id'];
  mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id= '$update_id'") or die('query failed');
  $message[] = 'quantity updated!';
}

if (isset($_GET['remove'])) {
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
  header('location:cart-main.php');
}

if (isset($_GET['delete_all'])) {
  mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
  header('location:index.php');
}

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
        $attachmentPath = 'attachments/' . $attachmentName; // Specify the directory to save attachments

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
    mysqli_query($conn, $addMessage);
  }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NetGosyo Project</title>
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">

    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    
    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- CSS File -->
    <link rel="stylesheet" href="css/style-header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="new_navbar.css">
    
</head>

<body>

    <div class="main-navbar shadow-sm sticky-top" id="main-navbar-design">
        <div class="top-navbar">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4 my-auto d-none d-sm-none d-md-block d-lg-block" href="index.php">
                        <a class="brand-name">
                            <img style="width:auto; height:40px; margin-right: 5px;"src="assets/logo.png">
                            NetGosyo
                        </a>
                    </div>

                    <div class="col-md-4 my-auto">
                        <form role="search" method="GET" action="search-page.php">
                            <div class="input-group">
                                <input type="text" name="search" placeholder="Search Products" class="form-control"
                                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                                <button class="btn border text-white" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 my-auto">
                        <ul class="nav justify-content-end">
                            <?php if($user_id == 3){?>

                            <?php }else{
                            
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="cart-main.php">
                                    <i class="fa fa-shopping-cart"></i> Cart <span id="cart-item"
                                        class="badge badge-success"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="checkout.php">
                                    <i class="fas fa-money-check-alt"></i> Checkout</a>
                                </a>
                            </li>
                            <?php }
                        ?>
                            <?php
                            $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id' ") or die('query failed!');
                            if (mysqli_num_rows($select_user) > 0) {
                            $fetch_user = mysqli_fetch_assoc($select_user);
                            };
                        ?>
                            <?php if($user_id == 3){
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">

                                    <i class="fa fa-user"></i></a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="login.php"><i class="fa fa-sign-in"></i>Sign
                                            In</a></li>
                                </ul>
                            </li>
                            <?php
                            }else{
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="javascript:" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">

                                    <i class="fa fa-user"></i> <?php echo $fetch_user['username']; ?></a>

                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <li><a class="dropdown-item" href="Profile_settings.php"><i
                                                class="fa fa-user text-dark mr-1"></i> Profile</a></li>
                                    <!-- <li><a class="dropdown-item" href="orders.php"><i
                                                class="fa fa-cart-shopping text-dark mr-1"></i> Purchases</a></li>
                                    <li><a class="dropdown-item" href="messages.php"><i
                                                class="fa fa-envelope text-dark mr-1"></i> Messages</a></li>
                                    <li><a class="dropdown-item" href="notifications.php"><i
                                                class="fa fa-bell text-dark mr-1"></i> Notifications <span
                                                class="badge badge-danger"><?= mysqli_num_rows($notifications) ?></span></a>
                                    </li>
                                    <li><a class="dropdown-item" href="user-changepass.php"><i
                                                class="fa fa-cog text-dark mr-1"></i> Change Password</a></li> -->

                                    <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out text-dark mr-1"></i> Logout</a></li>
                                </ul>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg" id="navbar-design">
            <div class="container-fluid">
                <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="index.php">
                    <img style="width:auto; height:25px; margin-right: 1px; margin-left: 7px; margin-bottom: 3px;" src="assets/logo.png">
                    NetGosyo
                </a>
                <button class="navbar-toggler" style="margin-right: 7px;" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php">All Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-shops.php">View Shops</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-top-products.php">Top Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-special-offers.php">Special Offers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-new-arrivals.php">New Arrivals</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <script type="text/javascript">
    $('.js-scroll-trigger').click(function() {
        $('.navbar-collapse').collapse('hide');
    });
    </script>
