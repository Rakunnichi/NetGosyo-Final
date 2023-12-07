  <?php
   ob_start();
  include('header.php');

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

$orders_query = mysqli_query($conn, "SELECT * FROM orders WHERE seller_id = '$user_id'");
$orders = array();

while ($order_row = mysqli_fetch_assoc($orders_query)) {
  $order_id = $order_row['order_id'];

  $sql = "SELECT *
      FROM  items
      JOIN products ON products.id = items.product_id
      WHERE items.order_id='$order_id' ";



  $items_query = mysqli_query($conn, $sql);

  $total = 0; 
  $items = [];
  $items_rows = []; // New array to store all fetched items

  while ($item_row = mysqli_fetch_assoc($items_query)) {
      $subtotal = $item_row['price'] * $item_row['qty'];
      $total += $subtotal;
      $items_rows[] = $item_row; // Add each item row to the array
  }







  $order_row['total'] = $total;
  $order_row['items'] = $items_rows; // Assign the array of items to the 'items' key
  $orders[] = $order_row;
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
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Orders</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Orders</h6>
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
                <h6 class="text-white text-capitalize ps-3">Orders</h6>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">

                  <thead>
                    <tr>

                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Update Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Order#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php foreach ($orders as $row) { ?>
                    <tr>
                   
                    
                    <?php if ($row['status'] == 'Pending') { ?>
                      
                      <td class="align-middle text-center text-sm">
                        <a href="#"><span class="badge badge-sm bg-gradient-secondary cursor-pointer" disabled>Update</span></a> 
                      </td>
                   
                   
                    <?php } elseif ($row['status'] == 'Received'){ ?>

                      <td class="align-middle text-center text-sm">
                        <a href="#"><span class="badge badge-sm bg-gradient-secondary cursor-pointer" disabled>Update</span></a> 
                      </td>

                    <?php } else if($row['status'] == 'Cancelled'){ ?>

                      <td class="align-middle text-center text-sm">
                        <a href="#"><span class="badge badge-sm bg-gradient-secondary cursor-pointer" disabled>Update</span></a> 
                      </td>

                  <?php  }else { ?>

                    <td class="align-middle text-center text-sm">
                        <a href="update-order-status.php?order_id=<?= $row['order_id']; ?>"><span class="badge badge-sm bg-gradient-info cursor-pointer" disabled>Update</span></a> 
                      </td>

                 <?php } ?>

                      
                   
                     

                    

                      <td>
                        <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="assets/img/images.png" class="avatar avatar-sm me-3 border-radius-lg" alt="ShoppingBag">
                          </div> -->
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><a href="javascript:" class="order" data-items='<?= json_encode($row["items"]); ?>'><?= $row['order_number'] ?></a></h6>
                            <p class="text-xs text-secondary mb-0"><b><?= $row['status'] ?></b></p>
                          </div>
                        </div>
                      </td>

                      <td>
                        <p class="text-s font-weight-bold mb-0"> <?= $row['name'] ?></p>
                        <p class="text-xs text-secondary mb-0"><b><?= $row['contact'] ?></b></p>
                      </td>

                      <td>
                      <b><?= $row['address'] ?>, <?= $row['city'] ?>, <?= $row['province'] ?>, <?= $row['zip'] ?></b>
                      </td>

                      <td class="align-middle text-center">
                        <p class="text-s font-weight-bold mb-0"> ₱<?= number_format($row['total'] + 45 , 2) ?></p>
                        <p class="text-xs text-secondary mb-0"><b><?= $row['order_added'] ?></b></p>
                       
                      </td>

                     <?php if ($row['status'] == 'Pending') { ?>
                      <td class="align-middle text-center text-sm">

                        <!-- 
                        <a href="../action.php?action=accept&id=<?= $row['order_id'] ?>&user_id=<?= $row['user_id'] ?>"onclick="return confirm('Are you sure do you want to ACCEPT this order?')">
                        <span class="badge badge-sm bg-gradient-success cursor-pointer">Accept</span>
                        </a> -->

                        <input type="hidden" class="order_id_value" value="<?= $row['order_id'] ?>" >
                        <input type="hidden" class="accept_id_value" value="<?= $row['user_id'] ?>" >

                        <a href="javascript:" class="accept_btn_ajax" >
                        <span class="badge badge-sm bg-gradient-success cursor-pointer">Accept</span>
                        </a>

                        <a href="javascript:" class="reject_btn_ajax" >
                        <span class="badge badge-sm bg-gradient-danger cursor-pointer">Reject</span>
                        </a>

                        <!-- <a href="../action.php?action=reject&id=<?= $row['order_id'] ?>&user_id=<?= $row['user_id'] ?>"onclick="return confirm('Are you sure do you want to REJECT this order?')">
                        <span class="badge badge-sm bg-gradient-danger cursor-pointer">Reject</span>
                        </a> -->

                      </td>


                      <?php }else if($row['status'] == 'Accepted'){ ?>

                         <td class="align-middle text-center text-sm">
                         <span class="badge badge-sm bg-gradient-success cursor-pointer" disabled>Accepted</span>
                         </td>
                      
                      <?php }else if($row['status'] == 'Rejected'){ ?>

                         <td class="align-middle text-center text-sm">
                         <span class="badge badge-sm bg-gradient-danger cursor-pointer"disabled>Rejected</span>
                         </td>
                        
                      <?php } else if($row['status'] == 'To-Ship'){ ?>

                        <td class="align-middle text-center text-sm">
                         <span class="badge badge-sm bg-gradient-success cursor-pointer" disabled>To Ship</span>
                         </td>
                      
                         <?php } else if($row['status'] == 'To-Recieve'){ ?>

                        <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success cursor-pointer" disabled>To Receive</span>
                        </td>

                        <?php } else if($row['status'] == 'Out-for-Deliver'){ ?>

                        <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success cursor-pointer" disabled>Out-for-Delivery</span>
                        </td>

                        <?php } else if($row['status'] == 'Delivered'){ ?>

                        <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success cursor-pointer" disabled>Delivered</span>
                        </td>

                        <?php } else if($row['status'] == 'Cancelled'){ ?>

                        <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-danger cursor-pointer" disabled>Cancelled</span>
                        </td>

                        <?php } else if($row['status'] == 'Received'){ ?>

                        <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success cursor-pointer" disabled>Received</span>
                        </td>

                      <?php } ?>
                    
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
  
                
               <!-- Modal -->
              <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalTitle">Order Details</h5>
                    </div>
                    <div class="modal-body">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Item Name</th>
                              <th>Price</th>
                              <th>Qty</th>
                              <th>Size</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody id="tbody">
                            <!-- javascript -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <span class="badge badge-sm bg-gradient-danger cursor-pointer" data-dismiss="modal">Close</span>
                    </div>
                  </div>
                </div>
              </div>
               <!-- Modal -->


              </div>
            </div>
            
          </div>
        </div>
      </div>
    <div class="container-fluid py-4">
    


  <?php
  include('footer.php');
  ?>  
 