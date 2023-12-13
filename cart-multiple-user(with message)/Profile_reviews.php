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

$convo_query = "SELECT items.user_id, items.seller_id, items.product_id, items.qty, items.status, items.item_id, products.name AS product_name, products.price
                    FROM items
                    JOIN products ON products.id = items.product_id
                    WHERE items.user_id='$user_id' OR items.seller_id='$user_id'
                    ORDER BY items.item_id DESC";

$convo_query = mysqli_query($conn, $convo_query);

$convos = array();

while ($item_row = mysqli_fetch_assoc($convo_query)) {
    $user_id = $item_row['user_id'];
    $seller_id = $item_row['seller_id'];
    $product_id = $item_row['product_id'];
    $quantity = $item_row['qty'];
    $status = $item_row['status'];
    $item_id = $item_row['item_id'];
    $product_name = $item_row['product_name'];
    $product_price = $item_row['price'];

    // You can use these variables as needed in your application logic.
    // For example, you might want to store them in an array or perform some operations.

    // Example of storing in an array:
    $item_info = array(
        'user_id' => $user_id,
        'seller_id' => $seller_id,
        'product_id' => $product_id,
        'qty' => $quantity,
        'status' => $status,
        'item_id' => $item_id,
        'product_name' => $product_name,
        'product_price' => $product_price
    );

    $convos[] = $item_info;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />


    <title>Profile settings - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-Bq5Uf6IFxDcw3pAglz9e9YVCsttKlcKbxG3kvmjhpj1lZb1L+pu7lMpJxXt0UayHfTVy7vmC1iLHl1AOT0YRGw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha512-PA98OcL5u22YWN7xZYi7uVeYvPbb+DFlUQ/Z1h75MD+ofLzQO9g8JLwy3+LlFnyo2mZLgvqAcr9qgJZ7W2s+Ng=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-7JM11oDPXg1/kFHndUdcJQGvsz++bO14/psW4Kc6tBMkWem9a3jZ7VZjtw7DL++G4DbKtVK8T86JIs6Y6frY2w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
        font-size: 1.2rem;
        font-weight: 500;
    }

    .form-paragraph {
        font-size: 0.7rem;
        color: rgb(105, 105, 105);
    }

    .drop-container {
        background-color: #fff;
        position: relative;
        display: flex;
        gap: 10px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
        border-radius: 10px;
        border: 2px dashed rgb(171, 202, 255);
        color: #444;
        cursor: pointer;
        transition: background .2s ease-in-out, border .2s ease-in-out;
    }

    .drop-container:hover {
        background: rgba(0, 140, 255, 0.164);
        border-color: rgba(17, 17, 17, 0.616);
    }

    .drop-container:hover .drop-title {
        color: #222;
    }

    .drop-title {
        color: #444;
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        transition: color .2s ease-in-out;
    }

    #file-input {
        width: 100%;
        max-width: 100%;
        color: #444;
        padding: 2px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid rgba(8, 8, 8, 0.288);
    }

    #file-input::file-selector-button {
        margin-right: 20px;
        border: none;
        background: #E6873C;
        padding: 10px 20px;
        border-radius: 10px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
    }

    #file-input::file-selector-button:hover {
        background: #000;
    }

    .btn:hover {
        color: #ffffff;
    }



    .dropdown {
        position: relative;
        display: inline-block;
    }

    #recipientInput {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-top: none;
        border-radius: 0 0 4px 4px;
    }

    .recipient-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .recipient-list li {
        cursor: pointer;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        font-size: 14px;
    }

    .recipient-list li:last-child {
        border-bottom: none;
    }

    .recipient-list li:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>
    <div class="container">
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
                            <a href="Profile_messages.php" class="nav-item nav-link has-icon nav-link-faded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor" class="feather feather-settings mr-2">
                                    <path
                                        d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z">
                                    </path>
                                </svg>Messages
                            </a>

                            <a href="Profile_reviews.php" class="nav-item nav-link has-icon nav-link-faded active">
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
                                    class="badge badge-danger ml-2"><?= mysqli_num_rows($notifications) ?>
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
                                <a href="Profile_messages.php" class="nav-link has-icon"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24"
                                        fill="currentColor" stroke-linejoin="round" class="feather feather-bell">
                                        <path
                                            d="M4 4h16v12H5.17L4 17.17V4m0-2c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H4zm2 10h12v2H6v-2zm0-3h12v2H6V9zm0-3h12v2H6V6z">
                                        </path>
                                    </svg></a>
                            </li>

                            <li class="nav-item">
                                <a href="Profile_reviews.php" class="nav-link has-icon active">
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

                        <div class="tab-pane" id="messages">
                            <div class="container-fluid py-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-wrapper">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="text-right" style="font-size: 30px;">Product Reviews:</h4>

                                            </div>

                                            <div class="card-body px-0 pb-2 mt-2 border-top">
                                                <div class="table-responsive p-0">

                                                    <table class="table table-striped table-hover mb-0" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php foreach ($convos as $row) { ?>
                                                            <tr>

                                                                <td>
                                                                    <?= $row['product_name'] ?>
                                                                </td>

                                                                <td>
                                                                    <?= $row['product_price'] ?>
                                                                </td>

                                                                <td>
                                                                    <?= $row['qty'] ?>
                                                                </td>

                                                                <td>
                                                                    <input type="hidden" name="reviewer_name"
                                                                        value="<?php echo $fullname; ?>">


                                                                    <?php if($row['status'] == 1){ ?>

                                                                    <button class="btn btn-secondary"
                                                                        disabled><b>Reviewed</b>
                                                                    </button>

                                                                    <?php  } else{ ?>
                                                                    <a
                                                                        href="Profile_reviews_submit.php?id=<?= $row['product_id'] ?> &item_id=<?= $row['item_id'] ?> "><button
                                                                            class="btn color-orange-bg"><b>Review</b>
                                                                        </button></a>


                                                                    <?php  }?>






                                                                </td>


                                                            </tr>
                                                            <?php } ?>

                                                            <?php if (!$convos) { ?>
                                                            <tr>
                                                                <td class="text-center" colspan="4">You did not Order a
                                                                    product yet.</td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js">
    </script>
    <script type="text/javascript"></script>
    <script>
    $(document).ready(function() {
        $.noConflict();
        // $('#myTable').dataTable();
    });
    </script>


    <script>
    $(document).ready(function() {
        // Event handler for input changes
        $('#recipientInput').on('input', function() {
            var input = $(this).val().toLowerCase();
            var recipientList = $('#recipientList');
            recipientList.empty();

            // Fetch user data from the server using AJAX
            $.ajax({
                url: 'get_users.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    search: input
                },
                success: function(users) {
                    // Update the dynamic list
                    users.forEach(function(user) {
                        var listItem = $('<li data-id="' + user.id + '">' + user
                            .fullname + '</li>');
                        listItem.on('click', function() {
                            $('#recipientInput').val(user.fullname);
                            $('#selectedRecipient').val(user.id);
                            recipientList
                                .empty(); // Clear the list after selection
                        });
                        recipientList.append(listItem);
                    });
                },
                error: function(error) {
                    console.error('Error fetching user data:', error);
                }
            });
        });

        // Show/hide dropdown based on focus
        $('#recipientInput').on('focus', function() {
            $('.dropdown-content').show();
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-content').hide();
            }
        });
    });
    </script>


    <script>
    $('.order').click(function() {
        let items = $(this).data('items');
        let total = 0;
        $('#tbody').html('');
        $('#modalTitle').text(items[0]['order_number']);
        items.map(row => {
            total += row.qty * row.price
            const html = `
				<tr>
					<td>${row.name}</td>
					<td>₱${row.price}</td>
					<td>${row.qty}</td>
					<td>₱${row.qty * row.price}</td>
				</tr>
			`;
            $('#tbody').append(html);
        });
        const total_row = `
				<tr>
					<td>Grand Total</td>
					<td></td>					
					<td></td>
					<td>₱${total}</td>
				</tr>
			`;

        $('#tbody').append(total_row);
        $('#orderModal').modal('show');
    });

    $('[data-dismiss="modal"]').click(function() {
        $('#orderModal').modal('hide');
    });
    </script>

</body>

</html>
<?php
//include footer.php file
include('footer.php');
?>