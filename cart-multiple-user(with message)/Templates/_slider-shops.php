<!-- <section id="slider-shops" class="pt-5">
    <div class="container">
        <h1 class="text-center"><b>#Shops</b></h1>
        <hr>

        <div class="slider">
            <div class="owl-carousel">

                <?php
                    $select_seller = mysqli_query($conn, "SELECT * FROM `user_form` where `shopname` != 'user'") or die('query failed!');
                    if (mysqli_num_rows($select_seller) > 0) {
                    while ($fetch_seller = mysqli_fetch_assoc($select_seller)) {
         
                ?>

            <div class="slider-card">

                    <div class="d-flex justify-content-center align-items-center mb-4"> 

                    </div>
                    <div class="card-footer border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                href="<?php printf('%s?id=%s', 'view-shop-details.php',  $fetch_seller['id']); ?>"><b><?php echo $fetch_seller['shopname'] ?? '0'; ?></b></a>
                        </div>
                    </div>
                    <p class="text-center p-4"></p>
                </div>

                <?php
                };
                };
                ?>

            </div>
        </div> 

    </div>
</section> -->



<section id="top-products">
                <div class="container py-5">
                <h1 class="text-center carousel-title"><b>#Shops</b></h1>
                <hr>
                     <!-- Owl-carousel -->
                     <div class="owl-carousel owl-theme">
                    
                <!-- <?php
                    $select_seller = mysqli_query($conn, "SELECT * FROM `user_form` where `shopname` != 'user'") or die('query failed!');
                    if (mysqli_num_rows($select_seller) > 0) {
                    while ($fetch_seller = mysqli_fetch_assoc($select_seller)) {
         
                ?>
                        <div class="item py-2">
                            <div class="product font-rale">
                                <a href="<?php printf('%s?id=%s', 'view-shop-details.php',  $fetch_seller['id']); ?>"><img  src="user-profiles/<?php echo $fetch_seller['image']; ?>"class="rounded-circle" style="width: 200px; height: 200px;
                                border: 2px solid #ddd; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" alt="product1" class="img-fluid"></a>
                                 <span class="hover-text"><b><?php echo $fetch_seller['shopname'] ?? '0'; ?></b></span>
                              
                            </div>
                        </div>

                      
                <?php
                };
                };
                ?> -->


<?php
$select_seller = mysqli_query($conn, "SELECT * FROM `user_form` where `shopname` != 'user'") or die('query failed!');
if (mysqli_num_rows($select_seller) > 0) {
    while ($fetch_seller = mysqli_fetch_assoc($select_seller)) {
?>
        <div id="slider-item" class="item py-2">
            <div id="slider-hover" class="product font-rale">
                <a href="<?php printf('%s?id=%s', 'view-shop-details.php',  $fetch_seller['id']); ?>">
                    <?php if($fetch_seller['image'] == NULL){ ?>
                        
                    <img src="assets/shop-image-default.png" class="rounded-circle" alt="product1">

                  <?php  } else{ ?>
                    <img src="user-profiles/<?php echo $fetch_seller['image']; ?>" class="rounded-circle" alt="product1">
                 <?php } ?>
                 
                </a>
                
            </div>
        </div>
<?php
    }
}
?>





                     </div>
                     <!-- !Owl-carousel -->
                </div>
             </section>