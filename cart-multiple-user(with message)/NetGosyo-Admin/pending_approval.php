<?php
  include('header.php');

  $select_user = mysqli_query($conn, "SELECT * FROM `user_form` where shopname != 'user' AND id_pic != '' ORDER BY register_date DESC, has_verified_badge DESC ") or die('query failed!');
  $sellers = array();

  while($fetch_user = mysqli_fetch_assoc($select_user) ){
    if($fetch_user['has_verified_badge'] == 1 && $fetch_user['id_pic']){
        $fetch_user['status'] = 'Verified';
      } else if($fetch_user['has_verified_badge'] == 0 && $fetch_user['id_pic']){
        $fetch_user['status'] =  'Pending Verification';
      } else {
        $fetch_user['status'] =  'Not Verified';
      }
        array_push($sellers, $fetch_user);

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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>Pending Approvals</b>
                    </li>
                </ol>

            </nav>

        </div>
    </nav>


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">

                <div class="card my-4">

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">

                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Email</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Username</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Phone Number</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            ID</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($sellers as $row) { ?>
                                    <tr>
                                        <td>
                                            <p class="text-s font-weight-bold mb-0"> <?= $row['fullname'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-s font-weight-bold mb-0"> <?= $row['email'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-s font-weight-bold mb-0"> <?= $row['username'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-s font-weight-bold mb-0"> <?= $row['phonenumber'] ?></p>
                                        </td>
                                        <td>
                                            <?php if ($row['id_pic'] != NULL) {
                                                echo '<div><a href="#" data-toggle="modal" data-target="#orderModal"><img src="../Seller-IDS/' . $row['id_pic'] . '" style="border-radius: 5px; box-shadow: 1px 1px 5px #333333; width: 80%; max-width: 100px; " class="img-fluid" id="uploaded_image"></a></div>';
                                                }?>
                                        </td>


                                      

                                        <?php if ($row['status'] == 'Pending Verification') { ?>
                                        <td class="align-middle text-center text-sm">
                                            <a href="../action.php?badge_action=accept&user_id=<?= $row['id'] ?>"
                                                onclick="return confirm('Are you sure do you want to Approve this seller?')">
                                                <span
                                                    class="badge badge-sm bg-gradient-success cursor-pointer">Approve</span>
                                            </a>
                                            <a href="../action.php?badge_action=reject&user_id=<?= $row['id'] ?>"
                                                onclick="return confirm('Are you sure do you want to REJECT this seller?')">
                                                <span
                                                    class="badge badge-sm bg-gradient-danger cursor-pointer">Reject</span>
                                            </a>
                                            <!-- <span class="badge badge-sm bg-gradient-success cursor-pointer" href="../action.php?action=accept&id=<?= $row['order_id'] ?>&user_id=<?= $row['user_id'] ?>"onclick="return confirm('Are you sure do you want to ACCEPT this order?')">Accept</span>
                        <span class="badge badge-sm bg-gradient-danger cursor-pointer" href="../action.php?action=reject&id=<?= $row['order_id'] ?>&user_id=<?= $row['user_id'] ?>"onclick="return confirm('Are you sure do you want to REJECT this order?')">Reject</span> -->
                                        </td>


                                        <?php }else if($row['status'] == 'Verified'){ ?>

                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success cursor-pointer"
                                                disabled>Accepted</span>
                                        </td>

                                        <?php }else if($row['status'] == 'Rejected'){ ?>

                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-danger cursor-pointer"
                                                disabled>Rejected</span>
                                        </td>

                                        <?php } ?>
                                    </tr>
                                
                                </tbody>
                            </table>                                                  
                            <!-- Modal -->
                            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle">Submitted ID</h5>
                                        </div>
                                        <div class="modal-body text-center">
                                            <div><img src="../Seller-IDS/<?= $row['id_pic'] ?>"
                                                    style="border-radius: 5px; box-shadow: 1px 1px 5px #333333; width: 100%; max-width: 800px; "
                                                    class="img-fluid" id="uploaded_image"></div>
                                            <tbody id="tbody">
                                                <!-- javascript -->
                                            </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <span class="badge badge-sm bg-gradient-danger cursor-pointer" data-dismiss="modal">Close</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>









    <?php
  include('footer.php');
  ?>