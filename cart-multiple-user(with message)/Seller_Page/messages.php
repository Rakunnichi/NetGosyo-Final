
<?php
  include('header.php');

  function dd($data) {
	echo "<pre>";
	print_r(var_dump($data));
	die;
}

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
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Messages</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Messages</h6>
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

      <div class="row">
        <div class="col-12">

          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="color-orange-bg shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><button class="btn background-gray" data-toggle="modal" data-target="#messageModal">Compose Message</button></h6>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recepient</th>
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

							<!-- <label>Recepient</label>
							<select class="form-control" name="recipient" required>
								<option value="">- select recipient -</option>
								<?php foreach ($users as $row) { ?>
									<?php if ($row['id'] != $user_id) { ?>
										<option value="<?= $row['id'] ?>"> <?= $row['fullname'] ?></option>
									<?php } ?>
								<?php } ?>
							</select> -->

              <label for="recipientInput">Recipient:  </label>
                      <div class="dropdown">
                      <input type="text" class="form-control" id="recipientInput" placeholder="Type to search" autocomplete="off">
                      <div class="dropdown-content">
                      <ul id="recipientList" class="recipient-list"></ul>
                      </div>
                      </div>
              <input type="hidden" id="selectedRecipient" name="recipient">
              

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
 