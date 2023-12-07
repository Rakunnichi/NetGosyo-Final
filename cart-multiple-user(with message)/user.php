<?php
ob_start();
//include header.php file
include('header.php');
include('config.php');


$username = $_SESSION["user_id"];
$findresult = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '$user_id'");
if ($res = mysqli_fetch_array($findresult)) {
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

?>


<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <link rel="stylesheet" type="text/css" href="user_profile/css/style1.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        overflow-x: hidden;
    }
    </style>

</head>

<body>
    <form action="" method="post" enctype='multipart/form-data'>
        <div class="mt-6 mb-6">
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

				$file_name_array = explode(".", $file_name);
				$extension = end($file_name_array);

				$new_image_name = 'profile_' . rand() . '.' . $extension;

				// echo "<pre>";
				// print_r(var_dump($_FILES['image']['name']));
				// die;
				if ($_FILES['image']['name']) {
					if ($_FILES["image"]["size"] > 10000000) {
						header("location: user.php?error=Sorry, your image is too large. Upload less than 10 MB in size .");
						exit;
					}
				}

				if ($file != "") {
					if (
						$extension != "jpg" && $extension != "png" && $extension != "jpeg"
						&& $extension != "gif" && $extension != "PNG" && $extension != "JPG" && $extension != "GIF" && $extension != "JPEG"
					) {
					}
				}

				$sql = "SELECT * from user_form where username = '$oldusername'";
				$res = mysqli_query($conn, $sql);
				if (mysqli_num_rows($res) > 0) {
					$row = mysqli_fetch_assoc($res);

					if ($oldusername != $username) {
						if ($username == $row['username']) {
							header("location: user.php?error=Username alredy Exists. Create Unique username");
							exit;
						}
					}
				}

				if (!isset($error)) {
					if ($file != "") {
						$stmt = mysqli_query($conn, "SELECT image FROM  user_form WHERE id = '$user_id'");
						$row = mysqli_fetch_array($stmt);
						$deleteimage = $row['image'];
						unlink($folder . $deleteimage);
						move_uploaded_file($file, $folder . $new_image_name);
						mysqli_query($conn, "UPDATE user_form SET image='$new_image_name' WHERE id = '$user_id'");
					}
					$result = mysqli_query($conn, "UPDATE user_form SET fullname='$fullname', username='$username', email='$email', phonenumber='$phonenumber', address='$address', dateofbirth='$dateofbirth', gender='$gender' WHERE id = '$user_id'");
					if (mysqli_query($conn, $sql)) {
						header("location: user.php?status=Your data has been updated");
					} else {
						echo "Error updating password: " . mysqli_error($conn);
					}
				}
			}
			if (isset($error)) {
				foreach ($error as $error) {
					echo '<p class="errmsg">' . $error . '</p>';
				}
			}
			?>
            <div class="row">
                <div class="col-3 color_left">

                    <div class="d-flex flex-column align-items-center text-center p-3 py-1 pt-5">
                        <div style="max-width:150px">
                            <?php if ($image == NULL) {
								echo '<img src="user_profile/profile.png" class="img-fluid">';
							} else {
								echo '<img src="user-profiles/' . $image . '" class="rounded-circle img-fluid " style="height:150px; width: 150px;">';
							}
							?>
                        </div>
                        <div class="row mt-1"></div>
                        <div class="row mt-2"></div>
                        <span class="font-weight-bold"><?php echo $fullname; ?></span><span
                            class=><?php echo $email; ?></span><span> </span>
                    </div>
                    <nav id="navbar" class="nav-menu navbar">
                        <ul style="list-style: none;">
                            <?php if ($_SESSION['role'] == 'user') { ?>
                            <li><a href="user.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-user"
                                        style="width:42px;text-align:center"></i> <span>Profile</span></a></li>
                            <li><a href="orders.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cart-shopping"
                                        style="width:42px;text-align:center"></i> <span>Purchases</span></a></li>
                            <li><a href="messages.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-envelope"
                                        style="width:42px;text-align:center"></i> <span>Messages</span></a></li>
                            <li><a href="notifications.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-bell"
                                        style="width:42px;text-align:center"></i> <span>Notifications <span
                                            class="badge badge-danger"><?= mysqli_num_rows($notifications) ?></span></span></a>
                            </li>
                            <li><a href="user-changepass.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cog"
                                        style="width:42px;text-align:center"></i> <span>Change Password</span></a></li>
                            <?php } else { ?>
                            <li><a href="user.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-user"
                                        style="width:42px;text-align:center"></i> <span>Profile</span></a></li>
                            <li><a href="orders.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cart-shopping"
                                        style="width:42px;text-align:center"></i> <span>Orders</span></a></li>
                            <li><a href="messages.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-envelope"
                                        style="width:42px;text-align:center"></i> <span>Messages</span></a></li>
                            <li><a href="notifications.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-bell"
                                        style="width:42px;text-align:center"></i> <span>Notifications <span
                                            class="badge badge-danger"><?= mysqli_num_rows($notifications) ?></span></span></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>

                <div class="row col-6 border-right pr-0">
                    <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show center-block bg-danger text-white"
                        role="alert">
                        <strong>Error!</strong> <?php echo $_GET['error']; ?>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } ?>
                    <?php if (isset($_GET['status'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show center-block bg-success bg-gradient text-white"
                        role="alert">
                        <strong>Success!</strong> <?php echo $_GET['status']; ?>
                        <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php } ?>
                    <div class="p-5 py-5">
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                            <h4 class="text-right" style="font-size: 30px;">User Profile</h4>
                        </div>
                        <div class="row mt-2 border-top">
                            <input type="hidden" name="user_id" value="<?php echo $fetch_user['id']; ?>">

                            <div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Full Name</label>
                                <input type="text" name="fullname" placeholder="Enter your fullname"
                                    class="form-control" value="<?php echo $fullname; ?>">
                            </div>

                            <div class="mt-3 col-md-6"><label class="labels" style="font-size: 17px;">Username</label>
                                <input type="text" name="username" placeholder="Enter your username"
                                    class="form-control" value="<?php echo $username; ?>">
                            </div>

                            <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Email
                                    Address</label>
                                <input type="text" name="emails" placeholder="Enter your email address"
                                    class="form-control" value="<?php echo $email; ?>">
                            </div>

                            <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Mobile
                                    Number</label>
                                <input type="text" name="number" placeholder="Enter your mobile number"
                                    class="form-control" value="<?php echo $phonenumber; ?>">
                            </div>

                            <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Address</label>
                                <input type="text" name="address" placeholder="Enter your address" class="form-control"
                                    value="<?php echo $address; ?>">
                            </div>

                            <div class="mt-2 col-md-6"><label class="labels" style="font-size: 17px;">Date of
                                    Birth</label>
                                <input type="date" name="datebirth" class="form-control"
                                    value="<?php echo $dateofbirth; ?>">
                            </div>

                            <div class="mt-2 mb-4 col-md-6"><label class="labels"
                                    style="font-size: 17px;">Gender</label>
                                <select name="Gender" class="custom-select" id="gender">
                                    <?php if (empty($gender['gender'])) { ?>
                                    <option selected><?php echo $gender; ?></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <?php } else { ?>
                                    <option selected><?php echo $gender; ?></option>

                                    <?php } ?>
                                </select>
                                <!-- <input type="list" name="Gender" placeholder="Enter your gender" class="form-control" value="<?php echo $gender; ?>"> -->
                            </div>
                        </div>
                        <input type="submit" value="Update" name="update_user" class="btn btn-warning">
                    </div>
    </form>

    </div>
    <div class="row col-3">
        <div class="p-5 py-5">
            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                <h4 class="text-right"></h4>
            </div>
            <div class="d-flex flex-column align-items-center text-center p-1 py-6">
                <div style="max-width:256px">
                    <?php if ($image == NULL) {
						echo '<img src="user_profile/profile.png" class="img-fluid">';
					} else {
						echo '<img src="user-profiles/' . $image . '" style="height:80px; width: 80px; " class="rounded-circle img-fluid>';
					}
					?>
                </div>
                <div class="form-group">
                    <br>
                    <label>Change Image &#8595;</label>
                    <input class="form-control" type="file" name="image" style="width:100%;">
                    <br>
                    <label>File size: maximum 10 MB</label>
                    <label>File extension: .JPEG, .PNG, .JPG</label>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
//include footer.php file
include('footer.php');
?>