<?php
  include('header.php');


  if(isset($_POST['addcategory-submit'])){
    
    $categoryname = mysqli_real_escape_string($conn, $_POST['categoryname']);
    $categorykey = mysqli_real_escape_string($conn, $_POST['categorykey']);
    $description = mysqli_real_escape_string($conn, $_POST['categorydesc']);
  
   
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $tmp = explode('.', $_FILES['file']['name']);
    $file_ext = strtolower(end($tmp));
    $extensions = array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions) === false){
       
        $Message = "Please choose a JPEG or PNG file.";
      
    }elseif(!isset($categoryname) || trim($categoryname) == '' || !isset($categorykey) || trim($categorykey) == '' || !isset($description) || trim($description) == ''){
       
        $Message = "Please Provide all Fields";

    }else{
         
    $new_file_name = time().'-'.$file_name;
   
    $destination = "category-img/".$new_file_name;
    move_uploaded_file($file_tmp, $destination);
        
    mysqli_query($conn, "INSERT INTO `categories` (name, keywords, description, image) VALUES( '$categoryname', '$description', '$categorykey', '$new_file_name')") or die ('query failed');
       
    $Message = "Category Added Successfully";
    

    }
   


    
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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>Add Categories</b></li>
                </ol>

            </nav>

        </div>
    </nav>

    <div class="container-fluid py-4">

        <div class="content-wrapper">

            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Add New Categories</h5>
                            <?php
                            if(!empty($Message)){
                                echo"
                                <div class='alert alert-secondary alert-dismissible text-white color-orange-bg' role='alert'>
                                <span class='text-sm'>$Message</span>
                                <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert'
                                    aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>
                                
                                ";
                            }
                        ?>
                            
                            <form action="" method="post" enctype='multipart/form-data'>
                                <input type="hidden" name="user_id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="text" name="categoryname" placeholder="Category Name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <input type="text" name="categorykey" placeholder="Keywords"
                                                class="form-control">
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <textarea type="text" name="categorydesc" rows="3" placeholder="Description"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-2">
                                        <label>Add Image &#8595;</label>
                                        <input class="form-control" type="file" name="file" style="width:100%;">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-icon btn-3 button-update" type="submit" name="addcategory-submit">
                                    <span class="btn-inner--icon"><i class="material-icons">add_circle</i></span>
                                    <span class="btn-inner--text">Add Category</span>
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
  include('footer.php');
  ?>