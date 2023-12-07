
<section class="py-5" id="view_top_products">
    <div class="text-center">
        <h3 class="font-rubik font-size-50"><b>Showing All results for:</b> <?php echo isset($_GET['search']) ? $_GET['search'] : ''?></h3>
    </div>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

        <!-- <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE `name` LIKE '%{$search}%'") or die('query failed!');
            
            $rows = mysqli_fetch_all($select_product, MYSQLI_ASSOC);
            if (mysqli_num_rows($select_product) > 0) {
            foreach ($rows as $fetch_product) {
        ?>
            <div class="col mb-5">
                <div class="card h-100" style="box-shadow: 1px 1px 5px #333333;">

                   
                    <a href="<?php printf('%s?id=%s', 'product.php',  $fetch_product['id']); ?>">
                    <img class="card-img-top" src="Seller-uploads/<?php echo $fetch_product['image']; ?>" alt="..." />
                    </a>

                    <div class="card-body p-4">
                        <div class="text-center">

                            <h6 class="fw-bolder"><?php echo $fetch_product['name'] ?? '0'; ?></h6>
                            
                         
                            <b>₱&nbsp;<?php echo $fetch_product['price'] ?? '0'; ?>.00</b>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                }
            } 
    ?>		 -->

        <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Updated SQL query with LEFT JOIN and WHERE condition to exclude banned users
        $select_product = mysqli_query($conn, "
            SELECT products.*
            FROM products
            LEFT JOIN user_form ON products.user_id = user_form.id
            WHERE (user_form.is_banned = 0 OR user_form.is_banned IS NULL)
            AND products.name LIKE '%$search%'
        ") or die('Query failed!');

        $rows = mysqli_fetch_all($select_product, MYSQLI_ASSOC);

        if (mysqli_num_rows($select_product) > 0) {
            foreach ($rows as $fetch_product) {
        ?>
            <div class="col mb-5">
                <div class="card h-100" style="box-shadow: 1px 1px 5px #333333;">
                    <a href="<?php printf('%s?id=%s', 'product.php',  $fetch_product['id']); ?>">
                        <img class="card-img-top" src="Seller-uploads/<?php echo $fetch_product['image']; ?>" alt="..." />
                    </a>
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h6 id="smaller-text-for-mobile" class="fw-bolder"><?php echo $fetch_product['name'] ?? '0'; ?></h6>
                            <b>₱&nbsp;<?php echo $fetch_product['price'] ?? '0'; ?>.00</b>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
    ?>
    <div class="col mb-5">
        <div class="card h-100" style="box-shadow: 1px 1px 5px #333333;">
                <div class="badge position-absolute" style="top: 0.5rem; right: 0.5rem "><i
                            class="fas fa-ban text-red fa-lg"></i>
                    </div>
                <img class="card-img-top" src="Seller-uploads/<?php echo $fetch_product['image']; ?>" alt="..." />
        
            <div class="card-body p-4">
                <div class="text-center">
                    <h6 class="fw-bolder"><?php echo $fetch_product['name'] ?? '0'; ?></h6>
                    <b>₱&nbsp;<?php echo $fetch_product['price'] ?? '0'; ?>.00</b>
                </div>
            </div>
        </div>
    </div>

   <?php
}
?>

        </div>
    </div>
</section>