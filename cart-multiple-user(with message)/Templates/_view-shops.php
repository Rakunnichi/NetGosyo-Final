
<section class="py-5">
    <div class="text-center">
            <h4 class="font-rubik font-size-50"><b>View Shops</b></h4>
        </div>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php
                    $select_seller = mysqli_query($conn, "SELECT * FROM `user_form` where `shopname` != 'user'") or die('query failed!');
                    if (mysqli_num_rows($select_seller) > 0) {
                    while ($fetch_seller = mysqli_fetch_assoc($select_seller)) {
         
                ?>

                    <div class="col mb-5">
                        <div class="card h-100"  style="box-shadow: 1px 1px 5px #333333;">

                        <?php if($fetch_seller['image'] == NULL){ ?>
                            <img class="card-img-top" src="assets/shop-image-default.png" alt="..." />
                        <?php  } else{ ?>
                            <img class="card-img-top" src="user-profiles/<?php echo $fetch_seller['image'] ?? '0'; ?>" alt="..." />
                        <?php } ?>

                            <div class="card-body">
                                <div class="text-center">
                                   
                                    <h4 id="smaller-text-for-viewshops" class="fw-bolder"><?php echo $fetch_seller['shopname'] ?? '0'; ?></h4>
                                 
                               
                                </div>
                            </div>
                          
                            <div class="card-footer p-3 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="<?php printf('%s?id=%s', 'view-shop-details.php',  $fetch_seller['id']); ?>">View Shop</a></div>
                            </div>
                        </div>
                    </div>
                        
                <?php
                };
                };
                ?>
                 
                </div>
            </div>
        </section>
