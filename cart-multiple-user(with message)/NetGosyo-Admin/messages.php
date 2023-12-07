
<?php
  include('header.php');

  function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

$user_id = '3';

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
								WHERE user_id='$user_id' 
								OR recipient='$user_id' 
								ORDER BY convo_id DESC";
$convo_query = mysqli_query($conn, $convo_query);
$convos = array();

while ($convo_row = mysqli_fetch_assoc($convo_query)) {
	$convo_id = $convo_row['convo_id'];
	$sql = "SELECT *
	        FROM messages
					WHERE convo_id = '$convo_id'";

	$message_query = mysqli_query($conn, $sql);

	$messages = [];

	while ($message_row = mysqli_fetch_assoc($message_query)) {
		array_push($messages, $message_row);
	}

	$convo_row['messages'] = $messages;
	$convos[] = $convo_row;
}
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
  <div class="row">
        <div class="col-12">

          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="color-greyish-bg shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><button class="btn btn-success" data-toggle="modal" data-target="#messageModal">Compose Message</button></h6>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">Recepient</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Message</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                  
                     
                    </tr>
                  </thead>

                  <tbody>
                  <?php foreach ($convos as $row) { ?>
                    <tr>
                    <?php if ($row['user_id'] == $user_id) { ?>

                      <td>
                      <div class="d-flex px-2 py-1">
                          <div>
                            <img src="assets/img/images.png" class="avatar avatar-sm me-3 border-radius-lg" alt="ShoppingBag">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['email'] ?></a> </h6>
                          </div>
                        </div>            
                      </td>
                      
                      <?php } else { ?>

                      <td>
                        <p class="text-s font-weight-bold mb-0"> <a href="message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $email ?></a> </p>
                      </td>

                      <?php } ?>
                      <td>
                      <p class="text-s font-weight-bold mb-0"> <a href="message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['subject'] ?></a>  </p>
                      </td>

                      <td>
                      <p class="text-s font-weight-bold mb-0"> <a href="message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['messages'][count($row['messages']) - 1]['message'] ?></a>  </p>
                      </td>
                    
                      <td>
                      <p class="text-s font-weight-bold mb-0"> <a href="message.php?convo_id=<?= $row['convo_id'] ?>" style="color:#333;text-decoration: none;"><?= $row['convo_added'] ?></a>  </p>
                      </td>
                      
                    <?php } ?>
                    <?php if (!$convos) { ?>   
                        <td>
                            <p class="text-s font-weight-bold mb-0 text-center">   </p>
                        </td>
                    <?php } ?>
                  </tbody>
                </table>
  
                
             

              </div>
            </div>
          </div>
        </div>
      </div>
    
       <!-- Modal -->
	<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="messageLabel">Compose Message</h5>
					
				</div>
				<div class="modal-body">
					<form action="" method="POST" id="frmMessage" enctype="multipart/form-data">
						<input type="hidden" value="compose" name="compose">
						<div class="form-group">
							<label>Recepient</label>
							<select class="form-control" name="recipient" required>
								<option value="">- select recipient -</option>
								<?php foreach ($users as $row) { ?>
									<?php if ($row['id'] != $user_id) { ?>
										<option value="<?= $row['id'] ?>"> <?= $row['fullname'] ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Subject</label>
							<input type="text" class="form-control" name="subject" required>
						</div>
						<div class="form-group">
							<label>Message</label>
							<textarea name="message" rows="4" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Attachment</label>
							<input type="file" name="attachment" accept="image/*,video/*" class="form-control">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn button-remove" data-dismiss="modal">Close</button>
					<button type="submit" class="btn button-update" form="frmMessage">Send Message</button>
				</div>
			</div>
		</div>
	</div>
      

     
    

    
    
  

  <?php
  include('footer.php');
  ?>  