<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>Dashboard</b></li>
                </ol>

            </nav>

        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape color-greyish-bg shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>Users</b></p>
                            <h4 class="mb-0"><?= mysqli_num_rows($user_count) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person_pin</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>Sellers</b></p>
                            <h4 class="mb-0"><?= mysqli_num_rows($seller_count) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">inventory_2</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>Listed Products</b></p>
                            <h4 class="mb-0"><?= mysqli_num_rows($products_count) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-danger shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">message</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize"><b>Messages</b></p>
                            <h4 class="mb-0"><?= mysqli_num_rows($message_count) ?></h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span></p>
                    </div>
                </div>
            </div>

        </div>


        <div class="row mt-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">

                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="row">

                            <div class="col-lg-6 col-7">
                                <h5>List of Users</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Fullname</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Username</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Email</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Date Registered</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                    
  			                        $select_user = mysqli_query($conn, "SELECT * FROM `user_form` where shopname = 'user' ORDER BY register_date DESC LIMIT 7 ") or die('query failed!');
                                    if(mysqli_num_rows($select_user) > 0){
                                    while($fetch_user = mysqli_fetch_assoc($select_user)){    
                                    ?>

                                    <tr>

                                        <td>

                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $fetch_user['fullname'];?></h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $fetch_user['username'];?></h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="text-xs font-weight-bold"><?php echo $fetch_user['email'];?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span
                                                class="text-xs font-weight-bold"><?php echo $fetch_user['register_date'];?></span>
                                        </td>

                                    </tr>



                                    <?php
                        };
                    }; 
                     ?>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <div class="col-lg-6 col-7">
                                <h5>List of Sellers</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Fullname</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Username</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Email</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">
                                            Date Registered</th>
                                    </tr>
                                </thead>

                                <tbody>
                                  <?php
  			                            $select_user = mysqli_query($conn, "SELECT * FROM `user_form` where shopname != 'user' ORDER BY register_date DESC LIMIT 7") or die('query failed!');
                                    if(mysqli_num_rows($select_user) > 0){
                                    while($fetch_user = mysqli_fetch_assoc($select_user)){    
                                  ?>

                                    <tr>

                                        <td>

                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $fetch_user['fullname'];?></h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex px-2 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?php echo $fetch_user['username'];?></h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="text-xs font-weight-bold"><?php echo $fetch_user['email'];?></span>
                                        </td>

                                        <td class="align-middle">
                                            <span
                                                class="text-xs font-weight-bold"><?php echo $fetch_user['register_date'];?></span>
                                        </td>

                                    </tr>



                                    <?php
                                    };
                                    }; 
                                    ?>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
               
            </div>

            





            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h5>Product Lists</h5>

                    </div>

                    <div class="card-body p-3">

                        <div class="timeline timeline-one-side">

                   <?php
                    $sr_no=1;
  			            $select_product = mysqli_query($conn, "SELECT * FROM `products` ORDER BY date_added DESC LIMIT 12 ") or die('query failed!');
                        if(mysqli_num_rows($select_product) > 0){
                        while($fetch_product = mysqli_fetch_assoc($select_product)){    
                    ?>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-info text-gradient">inventory</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-greyish text-sm font-weight-bold mb-0">
                                        <?php echo $fetch_product['name'];?></h6>

                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                        <?php echo $fetch_product['date_added'];?></p>
                                </div>
                            </div>

                            <?php
                        };
                    }; 
                     ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>