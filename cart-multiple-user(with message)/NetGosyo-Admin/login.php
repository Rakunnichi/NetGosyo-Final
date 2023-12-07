<?php
include 'config.php';
session_start();


     if(isset($_POST['submit'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == "admin" && $password =="admin"){
            $Message = "Logged in Succesfully!";
            $_SESSION["username"] = $username;
            header('location:index.php');
        
        }else{
            $Message = "Invalid Credentials!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <title>
        NetGosyo Administrator
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
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

</head>

<body class="bg-gray-200">


    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1694714567169-bcdb197f5ad6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1886&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="color-greyish-bg shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Administrator Login
                                    </h4>
                                    <div class="row mt-3">
                                        <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center px-1">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-github text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                                <i class="fa fa-google text-white text-lg"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        

                            <div class="card-body">
                            <?php
                            if(!empty($Message)){
                                echo"
                                <div class='alert alert-danger alert-dismissible text-white' role='alert'>
                                    <span class='text-sm'>$Message</span>
                                    <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert'
                                        aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>
                              
                                ";
                            }
                            ?>


                                <form role="form" method="post" class="text-start">

                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label"><b>Username</b></label>
                                        <input name="username" type="text" class="form-control">
                                    </div>

                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label"><b>Password</b></label>
                                        <input name="password" type="password" class="form-control">
                                    </div>

                                    <div class="text-center">
                                        <button id="button_login" type="submit" name="submit"
                                            class="btn color-greyish-bg text-white w-100 my-4 mb-2">Login</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-12 col-md-6 my-auto">
                            <div class="copyright text-center text-sm text-white text-lg-start">
                                © Copyright 2022, NetGosyo
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-white">NetGosyo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="../about-us.php" class="nav-link text-white" >About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-white" >Privacy Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link pe-0 text-white">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    
    <script src="../NetGosyo-Admin/assets/js/core/popper.min.js"></script>
    <script src="../NetGosyo-Admin/assets/js/core/bootstrap.min.js"></script>
    <script src="../NetGosyo-Admin/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../NetGosyo-Admin/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../NetGosyo-Admin/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>