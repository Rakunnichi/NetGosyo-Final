<?php
    include('config.php');

    if(isset($_POST['password_update'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $new_password = mysqli_real_escape_string($conn,  md5($_POST['new_password']) );
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        $token = mysqli_real_escape_string($conn, $_POST['password_token']);
       

        if(!empty($token)){

            if(!empty($email) && !empty($new_password) && !empty($confirm_password)){

                //checking if token is valid
                $check_token = "SELECT verify_token FROM user_form WHERE verify_token = '$token' LIMIT 1";
                $check_token_run = mysqli_query($conn,$check_token);

                if(mysqli_num_rows($check_token_run)){
                    
                    if($new_password == $confirm_password){

                        $update_password = "UPDATE user_form SET password = '$new_password' WHERE verify_token = '$token' LIMIT 1";
                        $update_password_run = mysqli_query($conn, $update_password);

                        if($update_password_run){

                            $new_token = md5(rand())."NetGosyo";
                            $update_to_new_token = "UPDATE user_form SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1";
                            $update_to_new_token_run = mysqli_query($conn, $update_to_new_token);

                            if($update_to_new_token_run){
                                $Message = "Updated Successfully!";
                            } else{
                                $Message = "Something Went Wrong!";
                            }
                            
                            

                        } else{
                            $Message = "Cannot Update Something Went Wrong!";
                        }

                    }else{
                        $Message = "Passwords does not Match!";
                    }

                } else{
                    $Message = "Token Expired!";
                }

            } else{
                $Message = "All Fields Required!";
            }

        }else{
            $Message = "No Token Available!";
        }

    }
  
?>

<!DOCTYPE html>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>


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


    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- CSS File -->
    <link rel="stylesheet" href="css/style-header.css">

    <!-- <link href="css/category-page.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />





</head>

<body>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <div class="card">

                        <div class="card-header">
                            <h5>Change Password:</h5>
                        </div>

                        <div class="card-body p-4">

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



                            <form method="post">
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){ echo $_GET['token']; }  ?>">
                            <div class="form-group mb-3">
                                <label for=""><b>Email Address:</b></label>
                                <input type="text" class="form-control" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email']; }  ?>" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for=""><b>New Password:</b></label>
                                <input type="password" class="form-control" name="new_password" placeholder="Enter New Password">
                            </div>

                            <div class="form-group mb-3">
                                <label for=""><b>Confirm Password:</b></label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" name="password_update" class="btn color-checkout-bg">Update Password</button>
                                <button class="btn btn-dark"><a href="login.php" class="color-darkshade-bg">Back</a></button>
                            </div>

                            </form>
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- JavaScript Bundle with Popper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>