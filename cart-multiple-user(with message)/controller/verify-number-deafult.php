<?php
ob_start();
// include header.php file
include 'header.php';
include 'config.php';
require __DIR__.'/vendor/autoload.php'; // Adjust the path based on your project structure

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

$otp = rand(1000, 9999);
$number = '';
$status = 'unverified';

if (isset($_GET['phone_number'])) {
    $number = $_GET['phone_number'];

    // Check if the number starts with "09"
    if (substr($number, 0, 2) === '09') {
        // Replace "09" with "639"
        $number = '639'.substr($number, 2);
    }

    $client = new Client([
        'base_uri' => 'https://e1elr1.api.infobip.com/',
        'headers' => [
            'Authorization' => 'App c6ce382c477c6deee35f1c2d507f9273-f6affcec-e3b1-4c35-8abd-cce9cd6d5819',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]);

    $response = $client->request(
        'POST',
        'sms/2/text/advanced',
        [
            RequestOptions::JSON => [
                'messages' => [
                    [
                        'from' => 'InfoSMS',
                        'destinations' => [
                            ['to' => $number],
                        ],
                        'text' => 'OTP :'.$otp,
                    ],
                ],
            ],
        ]
    );
}

$try = 0;
$error = 0;

if (isset($_GET['try'])) {
    $try = 1;
}

if (isset($_GET['error'])) {
    $error = 1;
}

if (isset($_POST['phone_number'])) {
    $otp = $_POST['otp'];
    $otp_input = $_POST['otp_input'];
    $user_id = $_POST['user_id'];
    $phone_number = $_POST['phone_number'];

    if ($otp == $otp_input) {
        mysqli_query($conn, "UPDATE user_form SET number_verified=1 WHERE id='$user_id'");
        header('location: Profile_settings.php');
    } else {
        header('location: verify-number.php?phone_number='.$phone_number.'&try=1&error=1');
    }
}

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
                                    echo '<img src="user_profile/profile_587153058.png" class="img-fluid">';
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
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_purchases.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="currentColor" stroke-linejoin="round"
                                            class="feather feather-settings">
                                            <path
                                                d="M17 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2M1 2h3.27l.94 2H20a1 1 0 0 1 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1l-.9 1.63l-.03.12a.25.25 0 0 0 .25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1V2m6 16a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2m9-7l2.78-5H6.14l2.36 5H16Z">
                                            </path>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_messages.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="currentColor" stroke-linejoin="round"
                                            class="feather feather-bell">
                                            <path
                                                d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z">
                                            </path>
                                        </svg></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_notifications.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg><span
                                            class="badge badge-danger ml-1"><?php echo mysqli_num_rows($notifications); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a href="Profile_changepass.php" class="nav-link has-icon"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20"
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

        $sql = "SELECT * from user_form where username = '$oldusername'";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);

            if ($oldusername != $username) {
                if ($username == $row['username']) {
                    header('location: Profile_settings.php?error=Username alredy Exists. Create Unique username');
                    exit;
                }
            }
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
            $result = mysqli_query($conn, "UPDATE user_form SET fullname='$fullname', username='$username', email='$email', phonenumber='$phonenumber', address='$address', dateofbirth='$dateofbirth', gender='$gender' WHERE id = '$user_id'");
            if (mysqli_query($conn, $sql)) {
                header('location: Profile_settings.php?status=Your data has been updated');
            } else {
                echo 'Error updating password: '.mysqli_error($conn);
            }
        }
    }
?>
                            <?php if ($error != 0) { ?>
                            <div class="alert alert-warning alert-dismissible fade show center-block bg-danger text-white mb-0"
                                role="alert" style="height: 60px">
                                <strong>Wrong OTP input
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span
                                        aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php } ?>
                            <?php if ($try != 0) { ?>
                            <div class="alert alert-success alert-dismissible fade show center-block bg-success text-white mb-0"
                                role="alert" style="height: 60px">
                                <strong>New OTP Code hase been sent
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
                                        <h4 class="text-right" style="font-size: 30px;">Verify Number</h4>
                                    </div>
                                    <div class="mt-2 pb-5 border-top border-bottom">
                                        <input type="hidden" name="user_id" value="<?php echo $fetch_user['id']; ?>">
                                        <input type="hidden" name="phone_number" value="<?php echo $number; ?>">
                                        <input type="hidden" name="otp" value="<?php echo $otp; ?>">
                                        <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Enter the OTP sent</label>
                                            <input type="number" name="otp_input" class="form-control"
                                               >
                                        </div>
                                        <br>
                                        <a style="color:gray; cursor:pointer;" href="verify-number.php?phone_number=<?php echo $number; ?>&try=1">Resend Code</a>
                                        <button class="m-2 btn btn-success" type="submit">VERIFY</button>
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
</body>

</html>
<?php
// include footer.php file
include 'footer.php';
?>