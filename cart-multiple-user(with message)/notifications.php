<?php
ob_start();
//include header.php file
include('header.php');
include('config.php');

$user_id = $_SESSION["user_id"];
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
	<style>
		body {
			overflow-x: hidden;
		}
	</style>
</head>

<body>
	<div class="mt-6 mb-6">
		<div class="row">
			<div class="col-3 color_left">

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
						
							<li><a href="user.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-user" style="width:42px;text-align:center"></i> <span>Profile</span></a></li>
							<li><a href="orders.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cart-shopping" style="width:42px;text-align:center"></i> <span>Purchases</span></a></li>
							<li><a href="messages.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-envelope" style="width:42px;text-align:center"></i> <span>Messages</span></a></li>
							<li><a href="notifications.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-bell" style="width:42px;text-align:center"></i> <span>Notifications <span class="badge badge-danger"><?= mysqli_num_rows($notifications) ?></span></span></a></li>
							<li><a href="user-changepass.php" class="nav-link scrollto ml-3"><i class="fa-solid fa-cog" style="width:42px;text-align:center"></i> <span>Change Password</span></a></li>		
					</ul>
				</nav>
			</div>

			<div class="row col-9 border-right pr-0">
				<?php if (isset($_GET['error'])) { ?>
					<div class="alert alert-warning alert-dismissible fade show center-block bg-danger text-white mb-0" role="alert" style="height: 60px">
						<strong>Error!</strong> <?php echo $_GET['error']; ?>
						<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php } ?>
				<?php if (isset($_GET['status'])) { ?>
					<div class="alert alert-warning alert-dismissible fade show center-block bg-success bg-gradient text-white mb-0" role="alert" style="height: 60px">
						<strong>Success!</strong> <?php echo $_GET['status']; ?>
						<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php } ?>
				<div class="p-5 py-5">
					<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
						<h4 style="font-size: 30px;">Notifications</h4>
					</div>
					<div class="mt-2 border-top">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Notification</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!$notifications->num_rows) { ?>
									<tr>
										<td colspan="2" class="text-center">No notification</td>
									</tr>
								<?php } ?>
								<?php foreach ($notifications as $row) { ?>
									<tr>
										<td><?= $row['notification'] ?></td>
										<td><?= $row['notification_added'] ?></td>
										<td><a href="action-notif.php?user_id=<?= $user_id?>" onclick="return confirm('Are you sure do you want to Delete this Notification?')">
										<button type="button" class="btn btn-danger">Delete</button>
										</a></td>
									</tr>

									
								<?php } ?>

								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<?php
include('footer.php');
?>