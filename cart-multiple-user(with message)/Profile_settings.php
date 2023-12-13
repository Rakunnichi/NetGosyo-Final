<?php
ob_start();
// include header.php file
include 'header.php';
include 'config.php';

$username = $_SESSION['user_id'];

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
    $archipelago = $res['archipelago'] ?? '';
    $zip = $res['zip'] ?? '';
    $dateofbirth = $res['dateofbirth'] ?? '';
    $gender = $res['gender'] ?? '';
    $image = $res['image'] ?? '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- crop -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />

    <!-- crop 2.0 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>

    <style type="text/css">
    body {

        color: #1a202c;
        text-align: left;
        background-color: #e2e8f0;
    }

    .main-body {
        padding: 15px;
    }

    .nav-link {
        color: #4a5568;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        margin-top: 20px;
        margin-bottom: 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }


    .form-title {
        color: #000000;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .form-paragraph {
        font-size: 0.9rem;
        color: rgb(105, 105, 105);
    }

    .btn:hover {
        color: #ffffff;
    }

    img {
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    /* img */
    .image_area {
        position: relative;
        margin-left: 10px;
        width: 150px;
    }

    img {
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .overlay {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
    }

    .image_area:hover .overlay {
        height: 40%;
        cursor: pointer;
    }

    .text {
        color: #333;
        font-size: 1rem;
        font-weight: 500;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <form action="" method="post" enctype='multipart/form-data'>
            <div class="row gutters-sm">

                <div class="col-md-3 d-none d-md-block">
                    <div class="card">
                        <div class="card-body">
                            <div style="text-align: center;" class="mt-2 mb-3">
                                <?php if ($image == null) {
                                    echo '<img src="user_profile/profile.png" class="rounded-circle img-fluid " style="height:150px; width: 150px; box-shadow: 1px 1px 5px #333333;">';
                                } else {
                                    echo '<img src="user-profiles/'.$image.'" class="rounded-circle img-fluid " style="height:150px; width: 150px; box-shadow: 1px 1px 5px #333333;">';
                                }
?>
                                <h5 style="text-align: center;" class="mt-3"><?php echo $fullname; ?></h5>
                                <h6 style="text-align: center;"> <?php echo $email; ?></h6>


                            </div>
                            <nav class="nav flex-column nav-pills nav-gap-y-1">
                                <a href="Profile_settings.php" class="nav-item nav-link has-icon nav-link-faded active">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user mr-2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>Profile Information
                                </a>
                                <a href="Profile_purchases.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="currentColor" class="feather feather-settings mr-2">
                                        <path
                                            d="M17 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2M1 2h3.27l.94 2H20a1 1 0 0 1 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1l-.9 1.63l-.03.12a.25.25 0 0 0 .25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1V2m6 16a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2m9-7l2.78-5H6.14l2.36 5H16Z">
                                        </path>
                                    </svg>Purchases
                                </a>
                                <a href="Profile_messages.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="currentColor" class="feather feather-settings mr-2">
                                        <path
                                            d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z">
                                        </path>
                                    </svg>Messages
                                </a>

                                <a href="Profile_reviews.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        class="feather feather-settings mr-2">
                                        <path fill="currentColor"
                                            d="M6 14h3.05l5-5q.225-.225.338-.513t.112-.562q0-.275-.125-.537T14.05 6.9l-.9-.95q-.225-.225-.5-.337t-.575-.113q-.275 0-.562.113T11 5.95l-5 5zm7-6.075L12.075 7zM7.5 12.5v-.95l2.525-2.525l.5.45l.45.5L8.45 12.5zm3.025-3.025l.45.5l-.95-.95zm.65 4.525H18v-2h-4.825zM2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm3.15-6H20V4H4v13.125zM4 16V4z" />
                                    </svg>Reviews
                                </a>

                                <a href="Profile_notifications.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-bell mr-2">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>Notification<span
                                        class="badge badge-danger ml-2"><?php echo mysqli_num_rows($notifications); ?></span>
                                </a>
                                <a href="Profile_changepass.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-shield mr-2">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg>Change Password
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-bottom mb-3 d-flex d-md-none">
                            <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                                <li class="nav-item">
                                    <a href="Profile_settings.php" class="nav-link has-icon active"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_purchases.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="currentColor" stroke-linejoin="round"
                                            class="feather feather-settings">
                                            <path
                                                d="M17 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2M1 2h3.27l.94 2H20a1 1 0 0 1 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1l-.9 1.63l-.03.12a.25.25 0 0 0 .25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1V2m6 16a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2m9-7l2.78-5H6.14l2.36 5H16Z">
                                            </path>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_messages.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="currentColor" stroke-linejoin="round"
                                            class="feather feather-bell">
                                            <path
                                                d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z">
                                            </path>
                                        </svg></a>
                                </li>

                                <li class="nav-item">
                                    <a href="Profile_reviews.php" class="nav-item nav-link has-icon nav-link-faded">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" class="feather feather-settings">
                                            <path fill="currentColor"
                                                d="M6 14h3.05l5-5q.225-.225.338-.513t.112-.562q0-.275-.125-.537T14.05 6.9l-.9-.95q-.225-.225-.5-.337t-.575-.113q-.275 0-.562.113T11 5.95l-5 5zm7-6.075L12.075 7zM7.5 12.5v-.95l2.525-2.525l.5.45l.45.5L8.45 12.5zm3.025-3.025l.45.5l-.95-.95zm.65 4.525H18v-2h-4.825zM2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm3.15-6H20V4H4v13.125zM4 16V4z" />
                                        </svg>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="Profile_notifications.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg><span
                                            class="badge badge-danger ml-1"><?php echo mysqli_num_rows($notifications); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_changepass.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shield">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg></a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">

                            <?php
    if (isset($_POST['update_user'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['emails'];
        $phonenumber = $_POST['number'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        // $archipelago = $_POST['archipelago'];
        $landmark = $_POST['landmark'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $zip = $_POST['zip'];
        $dateofbirth = $_POST['datebirth'];
        $gender = $_POST['Gender'];
        $folder = 'user-profiles/';
        $file = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $new_file_name = $_POST['new_file'];

        $file_name_array = explode('.', $file_name);
        $extension = end($file_name_array);

        $new_image_name = 'profile_'.rand().'.'.$extension;

        var_dump($_FILES['image']['name']);

        if ($_FILES['image']['name']) {
            if ($_FILES['image']['size'] > 10000000) {
                header('location: Profile_settings.php?error=Sorry, your image is too large. Upload less than 10 MB in size .');
                exit;
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
                header('location: Profile_settings.php?error=Username already exists. Choose a unique username.');
                exit;
            }
        } else {
            header('location: Profile_settings.php?error=Error checking username existence:'. mysqli_error($conn));
            exit;
        }


        if (!isset($error)) {
            if ($file != '') {
                $stmt = mysqli_query($conn, "SELECT image FROM  user_form WHERE id = '$user_id'");
                $row = mysqli_fetch_array($stmt);
                $deleteimage = $row['image'];
                unlink($folder.$deleteimage);
                move_uploaded_file($file, $folder.$new_image_name);
                mysqli_query($conn, "UPDATE user_form SET image='$new_image_name' WHERE id = '$user_id'");

                if (file_exists($new_file_name)) {
                    unlink($folder.$new_image_name);
                    rename($new_file_name, $folder.$new_image_name);
                }
            }
            $result = mysqli_query($conn, "UPDATE user_form SET fullname='$fullname', username='$username', email='$email', phonenumber='$phonenumber', address='$address', address2='$address2', landmark='$landmark', city='$city', province='$province', zip='$zip', dateofbirth='$dateofbirth', gender='$gender' WHERE id = '$user_id'");
            if (mysqli_query($conn, $sql)) {
                header('location: Profile_settings.php?status=Your data has been updated');
            } else {
                echo 'Error updating password: '.mysqli_error($conn);
            }
        }
    }
    if (isset($error)) {
        foreach ($error as $error) {
            echo '<p class="errmsg">'.$error.'</p>';
        }
    }
?>
                            <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-warning alert-dismissible fade show center-block bg-danger text-white mb-0"
                                role="alert" style="height: 60px">
                                <strong>Error!</strong> <?php echo $_GET['error']; ?>
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php } ?>
                            <?php if (isset($_GET['status'])) { ?>
                            <div class="alert alert-warning alert-dismissible fade show center-block bg-success bg-gradient text-white mb-0"
                                role="alert" style="height: 60px">
                                <strong>Success!</strong> <?php echo $_GET['status']; ?>
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php } ?>

                            <div class="tab-pane active" id="profile">

                                <div class="p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="text-right" style="font-size: 30px;">Your Profile Information</h4>
                                    </div>
                                    <div class="row mt-2 border-top border-bottom">
                                        <input type="hidden" name="user_id" value="<?php echo $fetch_user['id']; ?>">

                                        <div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Full
                                                Name <span
                                                    style="color: rgb(250, 1, 46); font-size: 14px;">*</span></label>
                                            <input type="text" name="fullname" placeholder="Enter your fullname"
                                                class="form-control" value="<?php echo $fullname; ?>">
                                        </div>

                                        <div class="mt-3 col-md-6"><label class="labels"
                                                style="font-size: 17px;">Username <span
                                                    style="color: rgb(250, 1, 46); font-size: 14px;">*</span></label>
                                            <input type="text" name="username" placeholder="Enter your username"
                                                class="form-control" value="<?php echo $username; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Email
                                                Address <span
                                                    style="color: rgb(250, 1, 46); font-size: 14px;">*</span></label>
                                            <input type="text" name="emails" placeholder="Enter your email address"
                                                class="form-control" value="<?php echo $email; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Mobile
                                                Number <span style="color: rgb(250, 1, 46); font-size: 14px;">*</span>
                                                <?php echo $numberVerified == 0 ? '<small><a style="color:red" href="verify-number.php?phone_number='.$phonenumber.'">(CLICK TO VERIFY)</a></small>' : ''; ?></label>
                                            <input type="text" name="number" placeholder="Enter your mobile number"
                                                class="form-control" value="<?php echo $phonenumber; ?>"
                                                style="<?php echo $numberVerified == 0 ? 'border:1px solid red' : ''; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels"
                                                style="font-size: 17px;">Default Address <span
                                                    style="color: rgb(250, 1, 46); font-size: 14px;">*</span></label>
                                            <input type="text" name="address" placeholder="Enter your address"
                                                class="form-control" value="<?php echo $address; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Second
                                                Address (Optional)</label>
                                            <input type="text" name="address2" placeholder="Enter your address"
                                                class="form-control" value="<?php echo $address2;?>">
                                        </div>

                                        <!-- <div class="mt-2 col-md-6"><label class="labels"
                                                style="font-size: 17px;">Archipelago <span style="color: rgb(250, 1, 46); font-size: 14px;">*</span></label>
                                                <select name="archipelago" class="form-control" >
                                                <?php
                                                    $archipelagoOptions = ["Luzon", "Visayas", "Mindanao", "NCR", "ISLAND"];

                                                    foreach ($archipelagoOptions as $option) {
                                                        if ($archipelago !== $option) {
                                                            echo '<option value="' . $option . '">' . $option . '</option>';
                                                        } else {
                                                            echo '<option value="' . $archipelago . '" selected>' . $archipelago . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                        </div> -->


                                        <div class="mt-2 col-md-6"><label class="labels"
                                                style="font-size: 17px;">Specific Location (Landmark)</label>
                                            <input type="text" name="landmark" placeholder="Enter your address"
                                                class="form-control" value="<?php echo $landmark;?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels"
                                                style="font-size: 17px;">City</label>
                                            <input type="text" name="city" placeholder="Enter your city"
                                                class="form-control" value="<?php echo $city; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels"
                                                style="font-size: 17px;">Province</label>
                                            <input type="text" name="province" placeholder="Enter your province"
                                                class="form-control" value="<?php echo $province; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Zip
                                                Code</label>
                                            <input type="number" name="zip" placeholder="Enter your zip code"
                                                class="form-control" value="<?php echo $zip; ?>">
                                        </div>

                                        <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Date
                                                of
                                                Birth</label>
                                            <input type="date" name="datebirth" class="form-control"
                                                value="<?php echo $dateofbirth; ?>">
                                        </div>

                                        <div class="mt-2 mb-4 col-md-6"><label class="labels"
                                                style="font-size: 17px;">Gender</label>
                                            <!-- <select name="Gender" class="custom-select" id="gender">
                                                <?php if (empty($gender['gender'])) { ?>
                                                <option selected><?php echo $gender; ?></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <?php } else { ?>
                                                <option selected><?php echo $gender; ?></option>

                                                <?php } ?>
                                            </select> -->

                                            <select name="gender" class="custom-select" id="gender">
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

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-3">
                                <div class="">
                                    <label class="labels" style="font-size: 17px;">
                                        <span class="form-title">Change Profile</span>
                                        <p class="form-paragraph">
                                            File size: maximum 10 MB <br>
                                            File extension: .JPEG, .PNG, .JPG
                                        </p>
                                    </label>
                                </div>

                                <div class="col-md-4">
                                    <div class="image_area">
                                        <form method="post">
                                            <label for="upload_image">
                                                <?php if ($image == null) {
                                                    echo '<img src="user_profile/profile.png" class="img-fluid" id="uploaded_image">';
                                                } else {
                                                    echo '<img src="user-profiles/'.$image.'" style="border-radius: 5px; box-shadow: 1px 1px 5px #333333;" class="img-fluid" id="uploaded_image">';
                                                }
?>
                                                <div class="overlay">
                                                    <div class="text">Change Profile Image</div>
                                                </div>
                                                <input type="file" accept=".jpg, .jpeg, .png" name="image" class="image"
                                                    id="upload_image" style="display:none" />
                                            </label>
                                        </form>
                                    </div>
                                </div>

                                <!-- <div class="d-flex flex-column align-items-center text-center">
                                    <div style="max-width:256px">
                                        <?php if ($image == null) {
                                            echo '<img src="user_profile/profile.png" class="img-fluid">';
                                        } else {
                                            echo '<img src="user-profiles/'.$image.'" style="height:100%; width: 100%; border-radius: 5px; box-shadow: 1px 1px 5px #333333;" class="img-fluid>';
                                        }
?>
                                        <div class="overlay">
                                                    <div class="text">Click to Change Profile Image</div>
                                                </div>
                                    </div>
                                        <br>
                                        <input type="file" name="image" class="image mt-2" style="width:100%;">
                                        <br>
                                        <br>
                                    </div>
                                </div>  -->

                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="submit" value="Update" name="update_user" class="btn color-orange-bg"
                                        style="font-weight: 600;">
                                </div>
                            </div>


                            <!-- modal 2.0 -->

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
                                            <button type="button" id="crop" class="btn btn-primary">Crop</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script type="text/javascript"></script>

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
                        url: 'upload.php',
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

</body>

</html>
<?php
// include footer.php file
include 'footer.php';
?>