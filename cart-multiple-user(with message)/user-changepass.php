<?php
ob_start();
//include header.php file
include('header.php');
include('config.php');

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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
	<form action="" method="post">
		<div class="row">

			<?php
			if (isset($_POST['change_pass'])) {

				$current_password = $_POST['current_password'];
				$new_password = $_POST['new_pass'];
				$confirm_password = $_POST['confirm_pass'];


				if ($new_password != $confirm_password) {
					header("location: user-changepass.php?error=New password and confirm password do not match");
					exit;
				}

				$sql = "SELECT password FROM user_form WHERE id = '$user_id'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$current_password_hash = $row["password"];
				} else {
					header("location: user-changepass.php?error=User not found");
					exit;
				}

				if (md5($current_password) != $current_password_hash) {
					header("location: user-changepass.php?error=Current password is incorrect");
					exit;
				}


				$new_password_hash = md5($new_password);

				$sql = "UPDATE user_form SET password = '$new_password_hash' WHERE id = '$user_id'";

				if (mysqli_query($conn, $sql)) {
					header("location: user-changepass.php?status=Your password has been updated");
				} else {
					echo "Error updating password: " . mysqli_error($conn);
				}

				mysqli_close($conn);
			}
			?>
			<div class="row">
				<div class="col-md-3 color_left ">
					<div class="d-flex flex-column align-items-center text-center p-3 py-1 pt-5">
						<div style="max-width:150px;margin-bottom:12px">
							<?php if ($image == NULL) {
								echo '<img src="user_profile/profile.png" class="img-fluid">';
							} else {
								echo '<img src="user-profiles/' . $image . '" class="rounded-circle img-fluid">';
							}
							?>
						</div>
						<span class="font-weight-bold"><?php echo $fullname; ?></span><span class=><?php echo $email; ?></span><span> </span>
					</div>
					<nav id="navbar" class="nav-menu navbar">
						<ul style="list-style: none;">
							<li><a href="user.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-user" style="width:42px;text-align:center"></i> <span>Account</span></a></li>
							<li><a href="orders.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cart-shopping" style="width:42px;text-align:center"></i> <span>Purchases</span></a></li>
							<li><a href="messages.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-envelope" style="width:42px;text-align:center"></i> <span>Messages</span></a></li>
							<li><a href="notifications.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-bell" style="width:42px;text-align:center"></i> <span>Notifications <span class="badge badge-danger"><?= mysqli_num_rows($notifications) ?></span></span></a></li>
							<li><a href="user-changepass.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cog" style="width:42px;text-align:center"></i> <span>Change Password</span></a></li>
						</ul>
					</nav>
				</div>
				<div class="col-md-8 color_right">
					<div class="mt-6 mb-6">
						<?php if (isset($_GET['error'])) { ?>
							<div class="alert alert-warning alert-dismissible fade show center-block bg-danger text-white" role="alert">
								<strong>Error!</strong> <?php echo $_GET['error']; ?>
								<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>

						<?php if (isset($_GET['status'])) { ?>
							<div class="alert alert-warning alert-dismissible fade show center-block bg-success text-white" role="alert">
								<strong>Success!</strong> <?php echo $_GET['status']; ?>
								<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php } ?>

						<div class="p-5">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h4 class="text-right" style="font-size: 30px;">Change Password</h4>
							</div>
							<div class="row mt-2 border-top mb-4">
								<!-- <input type="hidden" name="user_id" value="<?php echo $fetch_cart['id']; ?>"> -->

								<div class="mt-3 col-md-8"><label class="labels" style="font-size: 17px;">Current Password</label>
									<input type="password" class="form-control" name="current_password" placeholder="Enter Old Password">
								</div>

								<div class="mt-3 col-md-8"><label class="labels" style="font-size: 17px;">New Password</label>
									<input type="password" class="form-control" name="new_pass" placeholder="Enter New Password">
								</div>

								<div class="mt-3 col-md-8"><label class="labels" style="font-size: 17px;">Confirm New Password</label>
									<input type="password" class="form-control" name="confirm_pass" placeholder="Confirm New Password">
								</div>
							</div>

							<input type="submit" value="Change Password" name="change_pass" class="btn btn-warning">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>
	</div>
	</div>

</body>

</html>
<?php
//include footer.php file
include('footer.php');
?>