<?php
  include('header.php');

  $username = $_SESSION["user_id"] ?? '3';
  
  $findresult = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'");
  if ($res = mysqli_fetch_array($findresult)) {
    $fullname = $res['fullname'] ?? '';
    $username = $res['username'] ?? '';
    $oldusername = $res['username'] ?? '';
    $email = $res['email'] ?? '';
    $phonenumber = $res['phonenumber'] ?? '';
    $numberVerified = $res['number_verified'] ?? '0';
    $address = $res['address'] ?? '';
    $address2 = $res['address2'] ?? '';
    $landmark = $res['landmark'] ?? '';
    $city = $res['city'] ?? '';
    $province = $res['province'] ?? '';
    $municipality = $res['city'] ?? '';
    $zip = $res['zip'] ?? '';
    $dateofbirth = $res['dateofbirth'] ?? '';
    $gender = $res['gender'] ?? '';
    $image = $res['image']  ?? '';
}

  if (isset($_POST['change_pass'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_pass'];
    $confirm_password = $_POST['confirm_pass'];
    $settingsmessage = "";

    if ($current_password && $new_password && $confirm_password) {
        if ($new_password != $confirm_password) {
            $settingsmessage[] = "New password and confirm password do not match";
        } else {
            $sql = "SELECT password FROM user_form WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $current_password_hash = $row["password"];

                    if (md5($current_password) != $current_password_hash) {
                        $settingsmessage[] = "Current password is incorrect!";
                    } else {
                        $new_password_hash = md5($new_password);

                        $updateSql = "UPDATE user_form SET password = '$new_password_hash' WHERE id = '$user_id'";

                        if (mysqli_query($conn, $updateSql)) {
                            $settingsmessage[] = "Your Password has Been Updated!";
                        } else {
                            $settingsmessage[] = "Error updating password: " . mysqli_error($conn);
                        }
                    }
                } else {
                    $settingsmessage[] = "User not found";
                }
            } else {
                $settingsmessage[] = "Error retrieving data: " . mysqli_error($conn);
            }
        }
    } else {
        $settingsmessage[] = "Error! Incomplete form!";
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
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Settings</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Settings</h6>
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
        <form action="" method="post" enctype='multipart/form-data'>
            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($_POST['update_seller'])) {
                            $fullname = $_POST['fullname'];
                            $username = $_POST['username'];
                            $email = $_POST['emails'];
                            $phonenumber = $_POST['number'];
                            $address = $_POST['address'];
                            $province = $_POST['province'];
                            $gender = $_POST['Gender'];
                            $zip = $_POST['zip'];
                            $dateofbirth = $_POST['datebirth'];
                            $city = $_POST['Municipality'];
                            $folder = '../user-profiles/';
                            $file = $_FILES['image']['tmp_name'];
                            $file_name = $_FILES['image']['name'];
                            $new_file_name = $_POST['new_file'];

                            $file_name_array = explode('.', $file_name);
                            $extension = end($file_name_array);

                            $new_image_name = 'profile_'.rand().'.'.$extension;


                            if ($_FILES['image']['name']) {
                                if ($_FILES['image']['size'] > 10000000) {
                                    $settingsmessage[] = "Sorry, your image is too large. Upload less than 10 MB in size .";
                                }
                            }

                            if ($file != '') {
                                if (
                                $extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'
                                && $extension != 'gif' && $extension != 'PNG' && $extension != 'JPG' && $extension != 'GIF' && $extension != 'JPEG'
                                ) {
                                }
                            }

                            $sql = "SELECT COUNT(*) as count FROM user_form WHERE username = '$username' AND id != '$user_id'";
                            $res = mysqli_query($conn, $sql);
                    
                            if ($res) {
                                $row = mysqli_fetch_assoc($res);
                    
                                if ($row['count'] > 0) {
                                    $settingsmessage[] = "Username alredy Exists. Create Unique username";
                                    header (Location: 'settings.php');
                                } else{

                                    if (!isset($error)) {
                                        if ($file != '') {
                                            $stmt = mysqli_query($conn, "SELECT image FROM  user_form WHERE id = '$user_id'");
                                            $row = mysqli_fetch_array($stmt);
                                            // $deleteimage = $row['image'];

                                            // if (file_exists($folder.$deleteimage)) {
                                            //     unlink($folder.$deleteimage);
                                            // }else {
                                            //     echo "File does not exist: " . $folder.$deleteimage;
                                              
                                            // }
                                            move_uploaded_file($file, $folder.$new_image_name);
                                            mysqli_query($conn, "UPDATE user_form SET image='$new_image_name' WHERE id = '$user_id'");
                                           
                                            
            
                                            if (file_exists($new_file_name)) {
                                                unlink($folder.$new_image_name);
                                                rename($new_file_name, $folder.$new_image_name);
                                            }
                                        }
                                        $result = mysqli_query($conn, "UPDATE user_form SET fullname='$fullname', username='$username', email='$email', phonenumber='$phonenumber', address='$address', address2='$address2', landmark='$landmark', city='$city', province='$province', zip='$zip', dateofbirth='$dateofbirth', gender='$gender' WHERE id = '$user_id'");
                                            if (mysqli_query($conn, $sql)) {
                                                $settingsmessage[] = "Your data has been updated";
                                                } else {
                                                    $settingsmessage[] = "Error updating password: " . mysqli_error($conn);
                                                }
                                            }
    

                                }

                            } 
                    
                    
                          
                            }
                            if (isset($error)) {
                                foreach ($error as $error) {
                                    echo '<p class="errmsg">'.$error.'</p>';
                                }
                            }
                        ?>


                            <div class="tab-pane active" id="profile">

                                <div class="p-3">

                        <?php
                            if (isset($settingsmessage)) {
                                foreach ($settingsmessage as $settingsmessage) {
                        ?>
                                    <script>
                                        swal({
                                            text: "<?php echo htmlspecialchars($settingsmessage, ENT_QUOTES, 'UTF-8')?>",
                                            button: "Okay",
                                        });
                                    </script>
                        <?php
                                                    
                            }
                                }
                        ?>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="text-right" style="font-size: 30px;">Your Profile Information</h4>
                                    </div>
                                    <div class="row mt-2 border-top">
                                        <input type="hidden" name="user_id" value="<?php echo $fetch_user['id']; ?>">

                                        <div class="col-md-4 mt-3"><label class="labels" style="font-size: 17px;">Full
                                                Name</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" name="fullname" placeholder="Enter your fullname"
                                                    class="form-control" value="<?php echo $fullname; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels"
                                                style="font-size: 17px;">Username</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" name="username" placeholder="Enter your username"
                                                    class="form-control" value="<?php echo $username; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels" style="font-size: 17px;">Email
                                                Address</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" name="emails" placeholder="Enter your email address"
                                                    class="form-control" value="<?php echo $email; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels" style="font-size: 17px;">Mobile
                                                Number</label>
                                            <div class="input-group input-group-outline">

                                                <input type="text" name="number" placeholder="Enter your mobile number"
                                                    class="form-control" value="<?php echo $phonenumber; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels" style="font-size: 17px;">Shop
                                                Address</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" name="address" placeholder="Enter your address"
                                                    class="form-control" value="<?php echo $address; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels"
                                                style="font-size: 17px;">Province</label>

                                            <select name="province" class="custom-select" id="province">
                                                <?php
                                            $provinces = ['Leyte']; // Add more provinces as needed
                                            foreach ($provinces as $provinceOption) {
                                                $selected = ($provinceOption == $province) ? 'selected' : '';
                                                echo "<option value=\"$provinceOption\" $selected>$provinceOption</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels"
                                                style="font-size: 17px;">Municipality</label>

                                                <select name="Municipality" class="custom-select" id="municipality">
                                                    <?php
                                                    $municipalities = ['Abuyog', 'Alangalang', 'Albuera', 'Babatngon', 'Barugo', 'Bato', 'Baybay', 'Burauen', 'Calubian', 'Capoocan', 'Carigara', 'Dagami', 'Dulag', 'Hilongos', 'Hindang', 'Inopacan', 'Isabel', 'Jaro', 'Javier', 'Julita',
                                                        'Kananga', 'La Paz', 'Leyte', 'MacArthur', 'Mahaplag', 'Matag-ob', 'Matalom', 'Mayorga', 'Merida', 'Ormoc', 'Palo', 'Palompon', 'Pastrana',
                                                        'San Isidro', 'San Miguel', 'Santa Fe', 'Tabango', 'Tabontabon', 'Tacloban', 'Tanauan', 'Tolosa', 'Tunga', 'Villaba'
                                                    ]; // Add more municipalities as needed

                                                    foreach ($municipalities as $municipalityOption) {
                                                        $selected = ($municipalityOption == $municipality) ? 'selected' : '';
                                                        echo "<option value=\"$municipalityOption\" $selected>$municipalityOption</option>";
                                                    }
                                                    ?>
                                                </select>

                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels" style="font-size: 17px;">Zip
                                                Code</label>
                                            <div class="input-group input-group-outline">
                                                <input type="text" name="zip" placeholder="Enter your zip code"
                                                    class="form-control" value="<?php echo $zip; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels" style="font-size: 17px;">Date
                                                of
                                                Birth</label>
                                            <div class="input-group input-group-outline">
                                                <input type="date" name="datebirth" placeholder="Enter your zip code"
                                                    class="form-control" value="<?php echo $dateofbirth; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-3"><label class="labels"
                                                style="font-size: 17px;">Gender</label>

                                            <select name="Gender" class="custom-select" id="Gender">
                                                <?php
                                                $genders = ['Male', 'Female']; // Add more genders as needed
                                                foreach ($genders as $genderOption) {
                                                    $selected = ($genderOption == $gender) ? 'selected' : '';
                                                    echo "<option value=\"$genderOption\" $selected>$genderOption</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" id="new_file" name="new_file" value='' />
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <form method="post">
                                    <div class="d-flex justify-content-between align-items-center border-top">
                                        <h4 class="text-right mt-4" style="font-size: 22px;">Change Profile</h4>
                                    </div>
                                    <div class="image_area mt-2">
                                        <label class="custum-file-upload" for="upload_image">
                                            <div class="icon1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                                                    <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                                    <g stroke-linejoin="round" stroke-linecap="round"
                                                        id="SVGRepo_tracerCarrier"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path fill=""
                                                            d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="text1">
                                                <span>Click to upload image</span>
                                            </div>
                                            <input type="file" accept=".jpg, .jpeg, .png" name="image"
                                                id="upload_image">
                                        </label>

                                    </div>
                                    <label class="labels ml-2" style="font-size: 17px;">
                                        <p class="form-paragraph ml-2">
                                            File extension: .JPEG, .PNG, .JPG<br>
                                            File size: maximum 10 MB
                                        </p>
                                    </label>
                                    <br>
                                    <button class="btn btn-icon btn-3 button-update ml-2" type="submit"
                                        name="update_seller">
                                        <span class="btn-inner--text">Update Shop Profile</span>
                                    </button>

                                </form>
                            </div>

                            <!-- Modal Crop -->
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Crop Image Before Upload</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <img src="" id="sample_image" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="crop" class="btn button-update">Crop</button>
                                            <button type="button" class="btn button-remove"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 border-top">
                                <h5 class="card-title" style="font-size: 22px;">Change Password</h5>
                                <input type="hidden" name="user_id" value="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="password" name="current_password"
                                                placeholder="Current Password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="password" name="new_pass" placeholder="New Password"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="password" name="confirm_pass"
                                                placeholder="Confirm New Password" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-icon btn-3 button-update mt-2" type="submit" name="change_pass">
                                    <span class="btn-inner--icon"><i class="material-icons">lock</i></span>
                                    <span class="btn-inner--text">Change Password</span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
    $(document).ready(function() {

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        url: 'SellerUpload.php',
                        method: 'POST',
                        data: {
                            image: base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            console.log(data);
                            $('#uploaded_image').attr('src', data);
                            $('#new_file').attr('value', data);
                        }
                    });
                };
            });
        });

    });
    </script>

    <?php
  include('footer.php');
  ?>