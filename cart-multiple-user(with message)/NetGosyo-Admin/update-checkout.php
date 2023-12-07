<?php
  include('header.php');
  ob_start();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../vendor/autoload.php';

  ?>

<?php
    $id =  $_GET["id"];
    $sql = "SELECT * FROM user_form WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $name = $row["fullname"];
    $username = $row["username"];
    $email = $row["email"];
    $phone = $row["phonenumber"];



    // Function to generate a random string
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    // Generate a random string
    $randomString = generateRandomString();
    
    if(isset($_POST['update-submit'])){

        $new_password = $_POST['new-checkout-pass'];

        $new_password_hash = md5($new_password);

        $sql = "UPDATE user_form SET checkout_pass = '$new_password_hash' WHERE id = '$id'";
        
        
        if (mysqli_query($conn, $sql)) {

        
        //sending email
        $mail = new PHPMailer(true);

        try {
          //Server settings
          $mail->isSMTP();                                            //Send using SMTP
          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
          $mail->Username   = 'netgosyo398@gmail.com';                     //SMTP username
          $mail->Password   = 'oxohqqatqijavfza';                               //SMTP password
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      
          //Recipients
          $mail->setFrom('netgosyo398@gmail.com', 'NetGosyo Team');
          $mail->addAddress( $email, $name);     //Add a recipient
         
      
         
          //Content
          $mail->isHTML(true);                                  //Set email format to HTML
          $mail->Subject = 'Checkout Password Recovery';
        //   $template_file = "Templates/register_mail_template.php";
          $mail->Body    = "Your New Checkout Password is:  <b>" . $new_password . "</b>  Please Delete this Mail After Reading!";
          // file_get_contents($template_file);
         
          $mail->send();
          $Message = "Updated Successfully";

      } catch (Exception $e) {
          $message =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
            
           

        } else {
            
            $Message = "Something Went Wrong!";

        }

        mysqli_close($conn);
    

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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><b>Checkout Password
                            Recovery</b></li>
                </ol>

            </nav>

        </div>


        <!-- <div class="input-group input-group-outline pt-3">

            <form class="input-group input-group-outline" role="search" method="GET" action="action-search-product.php">
                <input class="form-control mr-sm-2" name="search-product" type="search"
                    value="<?php echo isset($_GET['search-product']) ? $_GET['search-product'] : ''; ?>"
                    placeholder="Search" aria-label="Search">
                <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </div> -->

    </nav>


    <div class="container-fluid py-4">

        <div class="row">

            <div class="col-12">
                <div class="card my-4">
                    
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="color-greyish-bg shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Checkout Password Recovery:</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 p">
                    <div class="container py-4 ml-3">
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
                                <input type="hidden" name="id" value="">
                                <div class="row">

                                    <div class="col-md-12 pb-3">

                                        
                                            <ul class="list-group">
                                                <li class="list-group-item"><b>ID: </b>&nbsp; <?php echo $id; ?></li>
                                                <li class="list-group-item"><b>Name: </b>&nbsp; <?php echo $name; ?></li>
                                                <li class="list-group-item"><b>Username: </b>&nbsp; <?php echo $username; ?></li>
                                                <li class="list-group-item"><b>Email: </b>&nbsp; <?php echo $email; ?></li>
                                                <li class="list-group-item"><b>Phone Number: </b>&nbsp; <?php echo $phone; ?></li>
                                            </ul>

                                   
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                  
                                        <label><b>New Checkout Password:</b></label>
                                        <div class="input-group input-group-outline my-3">
                                            <input type="password"  name="new-checkout-pass"  value="<?php echo $randomString; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    
                                </div>


                                <button class="btn btn-icon btn-3 button-update" type="submit" name="update-submit">
                                    <span class="btn-inner--icon"><i class="material-icons">arrow_circle_up</i></span>
                                    <span class="btn-inner--text">Update</span>
                                </button>

                                <a href="checkout-pass.php" class="btn btn-icon btn-3 button-remove">
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