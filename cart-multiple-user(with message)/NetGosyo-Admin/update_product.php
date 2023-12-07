<?php
  include('header.php');
  ob_start();
  ?>

<?php
    $id =  $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row["name"];
    $price = $row["price"];
    $image =$row["image"];
    $itembrand = $row["item_brand"];
    $quantity = $row["quantity"];

if(isset($_POST['update-submit'])){
   
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $itembrand = mysqli_real_escape_string($conn, $_POST["item_brand"]);
    $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);
   
    $old_image = mysqli_real_escape_string($conn, $_POST["product_img_old"]);
    $new_image = $_FILES['prod_image']['name'];

    if($new_image != ''){

        $update_filename = $_FILES['prod_image']['name'];


    }else{
        $update_filename = $old_image;
    }

    if(file_exists("../Seller-uploads/". $_FILES['prod_image']['name'])){

        $filename = $_FILES['prod_image']['name'];
        $Message = "Image Already Exist!";

    }else{

        $sql = "UPDATE products SET name='$name', price = '$price', image = '$update_filename', item_brand='$itembrand', quantity = '$quantity' where id=$id ";
        $result = $conn->query($sql);
        
        if($result){

            if($_FILES['prod_image']['name'] != ''){
                move_uploaded_file($_FILES['prod_image']['tmp_name'], "../Seller-uploads/".$_FILES['prod_image']['name']);
                unlink("../Seller-uploads/" .$old_image);
            }

            $Message = "Product Updated Successfully";
           
        }else{
            $Message = "Invalid query: " . $conn->error;
        }

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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Update Product</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Update Product</h6>
            </nav>


            <?php
        include('navbar.php');
         ?>


        </div>
    </nav>

    <div class="container-fluid py-4">

        <div class="content-wrapper">

            <div class="row mb-2">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Update Product</h5>

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
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Product Name:</label>
                                        <div class="input-group input-group-outline my-3">
                                            <input type="text" value="<?php echo $name; ?>" name="name"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Product Price:</label>
                                        <div class="input-group input-group-outline my-3">
                                            <input type="number" name="price" value="<?php echo $price; ?>"
                                                class="form-control">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Product Quantity:</label>
                                        <div class="input-group input-group-outline my-3">
                                            <input type="number" name="quantity" value="<?php echo $quantity; ?>"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Product Category:</label>
                                        <div class="input-group input-group-outline my-3">
                                            <select class="form-control" name="item_brand" id="category">
                                                <option selected=""><?php echo $itembrand; ?></option>
                                                <option value="Gadget">Gadgets</option>
                                                <option value="Women-Apparel">Women-Apparel</option>
                                                <option value="Men-Apparel">Men-Apparel</option>
                                                <option value="Men-Bag-Accesories">Men-Bag-Accesories</option>
                                                <option value="Makeup-Fragrance">Makeup-Fragrance</option>
                                                <option value="Women-Bag">Women-Bag</option>
                                                <option value="Home-Living">Home-Living</option>
                                                <option value="Furniture">Furniture</option>
                                                <option value="Souvenirs">Souvenirs</option>
                                                <option value="Foods">Foods</option>
                                                <option value="Men-Shoes">Men-Shoes</option>
                                                <option value="Women-Shoes">Women-Shoes</option>
                                                <option value="Sports-Travel">Sports-Travel</option>
                                                <option value="Toys">Toys</option>
                                                <option value="Lingerie-Loungewear">Lingerie-Loungewear</option>
                                                <option value="Pottery">Pottery</option>
                                                <option value="Babies-Kids">Babies-Kids</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 pt-3" style="max-width:100px">
                                        <img src="../Seller-uploads/<?php echo $image; ?>" class="img-fluid">
                                    </div>

                                    <div class="col-md-5 pb-4">
                                        <div class="input-group input-group-outline my-2">
                                            <label>Change Product Image &#8595;</label>
                                            <input class="form-control" type="file" name="prod_image" style="width:100%;">
                                            <input type="hidden" name="product_img_old" value="<?php echo $image; ?>">
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-icon btn-3 button-update" type="submit" name="update-submit">
                                    <span class="btn-inner--icon"><i class="material-icons">arrow_circle_up</i></span>
                                    <span class="btn-inner--text">Update Product</span>
                                </button>

                                <a href="my_products.php" class="btn btn-icon btn-3 button-remove">
                                    <span class="btn-inner--icon"><i class="material-icons">arrow_back</i></span>
                                    <span class="btn-inner--text">Back</span>
                                    <a>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
  include('footer.php');
  ?>