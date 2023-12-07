<?php
  include 'header.php';
  ?>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>Search Results:</b></li>
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
                            <h6 class="text-white text-capitalize ps-3">Search Results:</h6>

                        </div>

                    </div>

                    <div class="ms-md-auto pe-md-3 d-flex align-items-center pt-3 p-l-2">

<div class="input-group input-group-outline">
    
<form class="input-group input-group-outline" role="search" method="GET" action="action-search.php">
<input class="form-control mr-sm-2" name="search" type="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder="Search" aria-label="Search">
<button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
</form>
  </div>
</div>


                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">

                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                            Id</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Fullname</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Username</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Email</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Contact#</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Gender</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Date of Birth</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Date Added</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                            Status</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                        <td colspan="10">
                                            <p class="font-weight-bold mb-0 text-center">
                                                No Search Result Found!
                                            </p>
                                        </td>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        



        <?php
      include 'footer.php';
  ?>