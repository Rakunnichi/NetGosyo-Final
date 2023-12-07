<?php
  include('header.php');
  ?>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main bg-gradient-dark navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
        id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-3 text-dark" href="javascript:;">
                            <svg width="12px" height="12px" class="mb-1 text-white" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#fff" fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item text-sm"><a class="opacity-7 text-white" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Donations</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Donations</h6>
            </nav>



            <?php
        include('navbar.php');
         ?>


        </div>
    </nav>

    <div class="collapse" id="collapseExample">
        <div class="container-fluid py-1 px-3">
            <ul class="list-group">
                <li class="list-group-item">
                    <a class="nav-link" href="index.php">
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="add_product.php">
                        <span class="nav-link-text ms-1">Add New Product</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="my_products.php">
                        <span class="nav-link-text ms-1">My Products</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="orders.php">
                        <span class="nav-link-text ms-1">Orders</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="sales-report.php">
                        <span class="nav-link-text ms-1">Sales Report</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="verify-badge.php">
                        <span class="nav-link-text ms-1">Apply for Badge</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="profile.php">
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="messages.php">
                        <span class="nav-link-text ms-1">Messages</span>
                    </a>
                </li>

                <li class="list-group-item">
                    <a class="nav-link" href="notifications.php">
                        <span class="nav-link-text ms-1">Notifications</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>


    <div class="container-fluid py-4">

        <div class="content-wrapper">

            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="card">

                        <form action="" method="post" enctype='multipart/form-data'>


                            <div class="card-body">
                                <h3 class="card-title mb-4">Support NetGosyo</h3>


                                <p><b> What is NetGosyo?</b></p>
                                <p class="text-justify"> NetGosyo is a mobile and web-based shopping application
                                    intended for local shops in Leyte and features local brands, products, and services
                                    that are offered and sold locally. It is a hybrid e-commerce app that <b>focuses on
                                        bringing local small and large businesses together on one online shopping
                                        platform.</b></p>

                                <p><b>What we do with Donations:</b></p>
                                <p class="text-justify"> By donating to NetGosyo, you are investing in the local
                                    products of Leyte. We rely on the generosity of our users and sellers to continue
                                    the tradition of providing our heartfelt services. NetGosyo also uses the generous
                                    donations of its users and sellers to further improve our website and application.
                                </p>
                                <hr>
                                <p><b>Our Donation Information:</b></p>

                               <!-- Other HTML code -->

                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="list-group">
                                            <a href="https://www.beta.gcash.com/" class="list-group-item list-group-item-action">
                                                <b>GCash:</b> 0923456887
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="list-group">
                                            <a href="https://www.paypal.com/ph/home" class="list-group-item list-group-item-action" target="_blank">
                                                <b>Paypal:</b> PayPal.Me/NetGosyo
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="list-group">
                                            <a href="https://www.maya.ph/send-money" class="list-group-item list-group-item-action">
                                                <b>PayMaya:</b> 0923456887
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Other HTML code -->


                            </div>








                            <?php
  include('footer.php');
  ?>