<!-- Product -->
<?php
include('config.php');
$id = $_GET['id'] ?? 1;
$user_id = $_SESSION['user_id']?? '3';

$sql = "SELECT * FROM user_form WHERE id=$id";
$user = mysqli_query($conn, $sql);

if (mysqli_num_rows($user) > 0) {
  $rows = mysqli_fetch_assoc($user);
  $badge =  $rows["has_verified_badge"];
  $banned = $rows["is_banned"];
  $address = $rows['address'];
  $city = $rows['city'];
  $province = $rows['province'];
  $zip = $rows['zip'];
}

$products_count = mysqli_query($conn, "SELECT * FROM products WHERE user_id='$id' ");

$stmt = $conn->prepare('SELECT * FROM user_form');
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) :
  if ($row['id'] == $id) :
?>

<section class="py-3">


    <div class="container">
        <?php
                    if($banned != 0){
                ?>
        <div class="alert alert-danger" role="alert"><b>
                <center>This Account Has been banned because it did not follow our Community Standards or Terms of
                    Service!</center>
            </b></div>
        <?php
                                     
         } else if ($badge == 0){ ?>

            <div class="alert alert-info" role="alert"><b>
                <center>This account has not yet been verified by NetGosyo. While you can still make purchases, we advise you to exercise caution.</center>
            </b></div>

        <?php
         }                            
        ?>

        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-12">
                <div class="card">
                    <!-- style="background-image: url('./assets/SOBackground.jpg');" -->
                    <div class="rounded-top text-white d-flex flex-row"
                        style="background-image: url('./assets/sellerBG.jpeg'); height:200px;">
                        <div class="ms-4 mt-5 ml-3 d-flex flex-column" style="width: 160px;">

                        <?php if($row['image'] == NULL){ ?>

                            <img src="assets/shop-image-default.png" alt="Generic placeholder image"
                                class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">

                        <?php  } else{ ?>
                            <img src="user-profiles/<?php echo $row['image']; ?>" alt="Generic placeholder image"
                                class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                        <?php } ?>

                        </div>
                        <div class="ms-3" style="margin-top: 120px;">
                            <h5><b><?php echo $row['shopname']; ?></b></h5>
                            <h6 class="ml-2"><?php echo $row['fullname'];?></h6>
                        </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                        <div class="d-flex justify-content-end text-center py-1">
                            <div>
                                <?php
                               if($badge == 1){

                              ?>
                                <p class="mb-1 h5"><i class="fas fa-certificate text-green"></i></p>
                                <p class="small text-muted mb-0">Verified</p>
                                <?php
                                 }else{
                                ?>
                                <p class="mb-1 h5"><i class="fas fa-certificate text-red"></i></p>
                                <p class="small text-muted mb-0">Unverified</p>

                                <?php

                                }

                                ?>

                            </div>
                            <div class="px-3">
                                <p class="mb-1 h5"><?= mysqli_num_rows($products_count) ?></p>
                                <p class="small text-muted mb-0">Products</p>
                            </div>
                            <div>
                                <?php
                                if($banned != 0){
                             ?>


                                <p class="mb-1 h5"><i class="fas fa-ban text-red"></i></p>
                                <p class="small text-muted mb-0">Banned</p>
                                <?php
                                     
                                    }else{
                                    
                                        ?>

                                <p class="mb-1 h5"><i class="fas fa-signal text-green"></i></p>
                                <p class="small text-muted mb-0">Active</p>

                                <?php
                                            
                                    }
                                    ?>






                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


      <div class="container mt-4">
      <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                <h6 class="font-rubik font-size-20"><b>Shop Details</b></h6>
                <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Mobile:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><b>(+63) <?php echo $row['phonenumber'];?></b></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><b><?php echo $row['email'];?></b></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Address:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><b><?php echo $row['address'];?></b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Province:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><b><?php echo $row['province'];?></b></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Municipality:</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><b><?php echo $row['city'];?></b></p>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
        </div>

      </div>

      
        <div class="row py-4">
            <div class="col-12 pt-4">
                <h6 class="font-rubik font-size-20"><b>Shop Description</b></h6>
                <hr>

                <p class="font-rale font-size-16 text-justify"><?php echo $row['shopdesc'];?></p>

            </div>
        </div>
    </div>

    <!-- !Product -->
    <?php
endif;
endwhile;
?>

</section>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>