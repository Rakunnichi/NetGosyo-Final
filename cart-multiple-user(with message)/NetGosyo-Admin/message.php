<?php
  include('header.php');

  function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

$user_id = '3';
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


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>Messages</b></li>
                </ol>

            </nav>

        </div>
    </nav>
    
  

    <div class="container-fluid py-4">

    <div class=" mb-6">
		<div class="row">
			<div class="row col-14 border-right pr-0">
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
				<div class="p-5 pb-0">
					<div class="d-flex justify-content-between align-items-center mt-3 mb-3">
						<h4 style="font-size: 30px;">Subject: <?= $convo['subject'] ?></h4>
						<small>Conversation with <?= $convo['email'] ?></small>
					</div>
					<div class="mt-2 pt-3 border-top">
						<div class="convo" id="convo">
							<?php foreach ($messages as $row) { ?>
								<div class="<?= $row['from_id'] != $user_id ? 'sender' : 'receiver' ?>" style="max-width: 500px;">
									<span><?= $row['message'] ?></span>
									<?php if (!empty($row['attachment'])) { ?>
										<?php if (strpos($row['attachment'], '.mp4') !== false || strpos($row['attachment'], '.mpeg') !== false || strpos($row['attachment'], '.mov') !== false) { ?>
											<video src="<?= $row['attachment'] ?>" controls class="attachment"></video>
										<?php } elseif (strpos($row['attachment'], '.jpg') !== false || strpos($row['attachment'], '.jpeg') !== false || strpos($row['attachment'], '.png') !== false || strpos($row['attachment'], '.gif') !== false) { ?>
											<img src="<?= $row['attachment'] ?>" alt="Attachment" class="attachment">
										<?php } ?>
									<?php } ?>
									<br>
									<small><span><?= $row['message_added'] ?></span></small>
								</div>
							<?php } ?>
						</div>
						<div class="mt-3">
							<form action="" method="POST" enctype="multipart/form-data">
								<textarea class="form-control" rows="2" name="message" placeholder="Enter reply.."></textarea>
								<input type="submit" value="Send Reply" class="btn button-update mt-2" name="send">
								<input type="file" name="attachment" accept="image/*,video/*">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


    
  <?php
  include('footer.php');
  ?>  