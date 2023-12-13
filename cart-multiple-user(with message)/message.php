<?php
ob_start();
//include header.php file
include('header.php');
include('config.php');

function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

$user_id = $_SESSION["user_id"];
$convo_id = $_GET['convo_id'];

$result = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'");
if ($res = mysqli_fetch_array($result)) {
	$fullname = $res['fullname'] ?? '';
	$username = $res['username']  ?? '';
	$oldusername = $res['username']  ?? '';
	$email = $res['email']  ?? '';
	$phonenumber = $res['phonenumber']  ?? '';
	$address = $res['address']  ?? '';
	$dateofbirth = $res['dateofbirth']  ?? '';
	$gender = $res['gender']  ?? '';
	$image = $res['image']  ?? '';
}

$users = mysqli_query($conn, "SELECT * FROM user_form");

$convo_query = "SELECT * FROM convo 
								JOIN user_form ON user_form.id = convo.recipient
								WHERE convo_id='$convo_id'";
$convo_query = mysqli_query($conn, $convo_query);
$convo = mysqli_fetch_assoc($convo_query);

$messages_query = "SELECT * FROM messages 
WHERE convo_id='$convo_id'";
$messages = mysqli_query($conn, $messages_query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style-messages.css">
</head>

<body>

    <div class="container">
        <div class="row gutters-sm">
            <div class="col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <div style="text-align: center;" class="mt-2 mb-3">
                            <?php if ($image == NULL) {
                                    echo '<img src="user_profile/profile_587153058.png" class="img-fluid">';
                                } else {
                                    echo '<img src="user-profiles/' . $image . '" class="rounded-circle img-fluid " style="height:150px; width: 150px; box-shadow: 1px 1px 5px #333333;">';
                                }
                            ?>
                            <h5 style="text-align: center;" class="mt-3"><?php echo $fullname; ?></h5>
                            <h6 style="text-align: center;"> <?php echo $email; ?></h6>


                        </div>
                        <nav class="nav flex-column nav-pills nav-gap-y-1">
                            <a href="Profile_settings.php" class="nav-item nav-link has-icon nav-link-faded">
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
                            <a href="Profile_messages.php" class="nav-item nav-link has-icon nav-link-faded active">
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
                                    class="badge badge-danger ml-2"><?= mysqli_num_rows($notifications) ?></span>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header border-bottom mb-3 d-flex d-md-none">
                        <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                            <li class="nav-item">
                                <a href="Profile_settings.php" class="nav-link has-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg></a>
                            </li>
                            <li class="nav-item">
                                <a href="Profile_purchases.php" class="nav-link has-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        fill="currentColor" stroke-linejoin="round" class="feather feather-settings">
                                        <path
                                            d="M17 18a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2M1 2h3.27l.94 2H20a1 1 0 0 1 1 1c0 .17-.05.34-.12.5l-3.58 6.47c-.34.61-1 1.03-1.75 1.03H8.1l-.9 1.63l-.03.12a.25.25 0 0 0 .25.25H19v2H7a2 2 0 0 1-2-2c0-.35.09-.68.24-.96l1.36-2.45L3 4H1V2m6 16a2 2 0 0 1 2 2a2 2 0 0 1-2 2a2 2 0 0 1-2-2c0-1.11.89-2 2-2m9-7l2.78-5H6.14l2.36 5H16Z">
                                        </path>
                                    </svg></a>
                            </li>
                            <li class="nav-item">
                                <a href="Profile_messages.php" class="nav-link has-icon active"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        fill="currentColor" stroke-linejoin="round" class="feather feather-bell">
                                        <path
                                            d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z">
                                        </path>
                                    </svg></a>
                            </li>

                            <li class="nav-item">
                                <a href="Profile_reviews.php" class="nav-item nav-link has-icon nav-link-faded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        class="feather feather-settings">
                                        <path fill="currentColor"
                                            d="M6 14h3.05l5-5q.225-.225.338-.513t.112-.562q0-.275-.125-.537T14.05 6.9l-.9-.95q-.225-.225-.5-.337t-.575-.113q-.275 0-.562.113T11 5.95l-5 5zm7-6.075L12.075 7zM7.5 12.5v-.95l2.525-2.525l.5.45l.45.5L8.45 12.5zm3.025-3.025l.45.5l-.95-.95zm.65 4.525H18v-2h-4.825zM2 22V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v12q0 .825-.587 1.413T20 18H6zm3.15-6H20V4H4v13.125zM4 16V4z" />
                                    </svg>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="Profile_notifications.php" class="nav-link has-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-bell">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg><span
                                        class="badge badge-danger ml-1"><?= mysqli_num_rows($notifications) ?></a>
                            </li>
                            <li class="nav-item">
                                <a href="Profile_changepass.php" class="nav-link has-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-shield">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                    </svg></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
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

                            <div class="tab-pane active" id="messages">

                                <div class="p-3">
                                    <div class="top-card align-items-center mt-3 mb-4">
                                        <ul class="nav align-items-center">
                                            <li class="nav-item mr-3">
                                                <a class="back" href="Profile_messages.php">
                                                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li class="nav-item mt-1">
                                                <h6 id="smaller-text-for-message">Conversation with:
                                                    <?= $convo['fullname'] ?></h6>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="mt-2 pt-3 border-top">
                                        <div class="convo" id="convo">
                                            <?php foreach ($messages as $row) { ?>
                                            <div class="<?= $row['from_id'] != $user_id ? 'sender' : 'receiver' ?>"
                                                style="max-width: 500px;">
                                                <span><?= $row['message'] ?></span>
                                                <?php if (!empty($row['attachment'])) { ?>
                                                <?php if (strpos($row['attachment'], '.mp4') !== false || strpos($row['attachment'], '.mpeg') !== false || strpos($row['attachment'], '.mov') !== false) { ?>
                                                <video src="<?= $row['attachment'] ?>" controls
                                                    class="attachment"></video>
                                                <?php } elseif (strpos($row['attachment'], '.jpg') !== false || strpos($row['attachment'], '.jpeg') !== false || strpos($row['attachment'], '.png') !== false || strpos($row['attachment'], '.gif') !== false) { ?>
                                                <img src="<?= $row['attachment'] ?>" alt="Attachment"
                                                    class="attachment">
                                                <?php } ?>
                                                <?php } ?>
                                                <br>
                                                <small><span
                                                        style="font-size: .5em; opacity: 80%;"><?= $row['message_added'] ?></span></small>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="textarea-container">
                                            <textarea id="mytext" class="form-control col-md-12" rows="1" name="message"
                                                placeholder="Enter reply.."></textarea>

                                            <label for="fimage" class="attachment-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M13 11.5a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0Zm-1.864 1.602a.75.75 0 0 0-1.272 0l-2.5 4A.75.75 0 0 0 8 18.25h8a.75.75 0 0 0 .6-1.2l-1.5-2a.75.75 0 0 0-1.2 0l-.844 1.125l-1.92-3.073Z" />
                                                    <path fill="currentColor" fill-rule="evenodd"
                                                        d="M7 2.25A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V7.968c0-.381-.124-.751-.354-1.055l-2.998-3.968a1.75 1.75 0 0 0-1.396-.695H7ZM5.75 5c0-.69.56-1.25 1.25-1.25h7.25v4.397c0 .414.336.75.75.75h3.25V19c0 .69-.56 1.25-1.25 1.25H7c-.69 0-1.25-.56-1.25-1.25V5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </label>

                                            <button class="btn btn-warning" name="send">
                                                <i class="fa fa-paper-plane mr-2 ml-1" aria-hidden="true"></i>
                                            </button>

                                            <input type="file" id="fimage" name="attachment" class="btn btn-warning"
                                                accept="image/*,video/*" style="display:none; visibility: none;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

<script>
$(document).ready(function() {
    var convo_div = document.getElementById("convo");
    convo_div.scrollTop = convo_div.scrollHeight;
});
</script>

</html>

<?php
include('footer.php');
?>