
<?php
  include('header.php');
  $username = $_SESSION["user_id"] ?? '3';
  $findresult = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'");
  if ($res = mysqli_fetch_array($findresult)) {
      $fullname = $res['fullname'];
      $username = $res['username'];
      $oldusername = $res['username'];
      $email = $res['email'];
      $phonenumber = $res['phonenumber'];
      $address = $res['address'];
      $dateofbirth = $res['dateofbirth'];
      $gender = $res['gender'];
      $image = $res['image'];
      $id_pic = $res['id_pic'];
      $has_verified_badge = $res['has_verified_badge'];

      if($has_verified_badge == 1 && $id_pic){
        $status = 'Verified';
      } else if($has_verified_badge == 0 && $id_pic){
        $status =  'Pending Verification';
      } else {
        $status =  'Not Verified';
      }
  }

  if (isset($_FILES['id_pic']['name']) && $_FILES['id_pic']['name'] != '') {
    $file = $_FILES['id_pic']['tmp_name'];
    $file_name = $_FILES['id_pic']['name'];
    $verifybadgemessage[] = '';
    $folder = '../Seller-IDS/';



    $file_name_array = explode(".", $file_name);
    $extension = end($file_name_array);

  if ($file != "") {
      if (
          $extension != "jpg" && $extension != "png" && $extension != "jpeg"
          && $extension != "gif" && $extension != "PNG" && $extension != "JPG" && $extension != "GIF" && $extension != "JPEG"
      ) {

        $verifybadgemessage[] ="Invalid format .";

      }else{

      $new_image_name = 'id_pic_' . rand() . '.' . $extension;
      $stmt = mysqli_query($conn, "SELECT id_pic FROM  user_form WHERE id = '$user_id'");
      $row = mysqli_fetch_array($stmt);
      $deleteimage = $row['id_pic'];
      if(file_exists($folder . $deleteimage) && $deleteimage){
        unlink($folder . $deleteimage);
      }
      if($file){

        move_uploaded_file($file, $folder . $new_image_name);
        mysqli_query($conn, "UPDATE user_form SET id_pic='$new_image_name' WHERE id = '$user_id'");
        $id_pic = $new_image_name;
        $status =  'Pending Verification';
        $verifybadgemessage[] ="Sent Valid ID Updated!";
      }

      }
  }


  }
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
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Badge Verification</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Badge Verification</h6>
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
                    <h3 class="card-title mb-4">Badge Application</h3>
                    
                    <?php
                            if (isset($verifybadgemessage)) {
                                foreach ($verifybadgemessage as $verifybadgemessage) {
                        ?>
                                    <script>
                                        swal({
                                            text: "<?php echo htmlspecialchars($verifybadgemessage, ENT_QUOTES, 'UTF-8')?>",
                                            button: "Okay",
                                        });
                                    </script>
                        <?php
                                                    
                            }
                                }
                        ?>

                    <p><b> What is A Badge Verfication?</b></p>
                    <p class="text-justify"> Sellers are required to submit credentials, such as a valid ID, in order to authenticate their accounts. A badge will appear in the Shop of the seller account once it has been verified.</p>
                  
                    <p><b> Why do you need a Badge Verification?</b></p>
                    <p class="text-justify"> All of our verified sellers go through an extensive verification process to ensure they meet all regulatory, legal, and quality requirements and a level of service that is consistent with our terms and conditions.</p>

                    <p><b> Badge Verification Form:</b></p>
                    <p class="text-justify"> Please take a moment to fill out our Badge Verification Form to process your badge verification. This simple and quick form will help us authenticate your account and ensure that your credentials are legit.</p>
                    <p><b> The Link to Our Form: <br><a href="https://forms.gle/XhqKoTDDMhPDT7Nz6" target=”_blank”><button type="button" class="btn button-update btn-sm">Click Here!</button></a>
                    </b></p>

        <div class="row">
        <div class="col-12">

          <div class="card my-4">
        
            <div class="card-body px-0 pb-2">
            <h4 class="card-title ml-3">Personal Details:</h4>  
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Address</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Date of Birth</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../user-profiles/<?php echo $image;?>" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?php echo $fullname ?></h6>
                            <p class="text-sm text-secondary mb-0"><?php echo $email ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0"><?php echo $address ?></p>
                        <p class="text-sm text-secondary mb-0"><?php echo $phonenumber ?></p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0"><?php echo $dateofbirth ?></p>
                        <p class="text-sm text-secondary mb-0"><?php echo $gender ?></p>
                      </td>
                    
                     
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
                    <span> <b>Please Submit A Valid ID:</b></span> <br>
                    <span><b>Recommended:</b><br>
                    ‣ UMID <br>
                    ‣ TIN ID <br>
                    ‣ Philhealth Card <br>
                    ‣ Driver’s License <br><br>
                        <b>Others:</b> <br>
                        ‣ Passport <br>
                        ‣ Voter’s ID <br>
                        ‣ SSS ID <br>
                        ‣ Alien/Immigrant COR <br>
                        ‣ Government Office/GOCC ID <br>
                        ‣ HDMF ID (Pagibig) <b></b>
                        ‣ Postal ID <br>
                        ‣ PRC ID <br>

                    </span> <br>
                    <span> Your Status: <b><?php echo $status ?></b></span>
                    <?php if ($status != 'Verified') { ?>
                    <?php if ($id_pic != NULL) {
                      echo '<div><span>ID Submitted</span><br><a href="#" data-toggle="modal" data-target="#orderModal"><img src="../Seller-IDS/' . $id_pic . '" style="border-radius: 5px; box-shadow: 1px 1px 5px #333333; width: 80%; max-width: 100px; " class="img-fluid" id="uploaded_image"> </a></div>';
                    } else { 

                      echo '<div><span>ID Submitted</span><br><a href="#"><img src="../assets/no-id-submitted.png" style="border-radius: 5px; box-shadow: 1px 1px 5px #333333; width: 80%; max-width: 100px; " class="img-fluid" id="uploaded_image"> </a></div>';

                    }?>
                      

                  
                    
                    <!-- Modal -->
                    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitle">Submitted ID</h5>  
                        </div>
                        <div class="modal-body text-center">
                        <div><img src="../Seller-IDS/<?php echo $id_pic; ?>" style="border-radius: 5px; box-shadow: 1px 1px 5px #333333; width: 100%; max-width: 800px; " class="img-fluid" id="uploaded_image"></div>
                            <tbody id="tbody">
                                <!-- javascript -->
                            </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <span class="badge badge-sm bg-gradient-danger cursor-pointer" data-dismiss="modal">Close</span>
                        </div>
                        </div>
                    </div>
                    </div>           
                    <!-- Modal -->

                    <br>  <?php if ($status == 'Pending Verification') {?>
                    <h5 class="card-title mb-4">Resubmit ID</h5>
                    <?php } ?>
                        <div class="input-group input-group-outline my-3">
                            <input type="file" accept=".jpg, .jpeg, .png" name="id_pic" 
                                class="form-control" required>
                        </div>

                        <button class="btn btn-icon btn-3 button-update" type="submit">
                            <span class="btn-inner--text">Submit</span>
                        </button>

                        <?php } ?>
                    </div>
                  </form>


                </div>
            </div>
        </div>
    </div>
</div>
    

   



   
     
  

  <?php
  include('footer.php');
  ?>  