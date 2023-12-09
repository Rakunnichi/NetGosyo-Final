<?php
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

$usernameValue = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
$nameValue = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$emailValue = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$phoneValue = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';


if (isset($_POST['submit'])) {
   


    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $checkoutpass = mysqli_real_escape_string($conn, md5($_POST['checkpass']));
    $concheckoutpass = mysqli_real_escape_string($conn, md5($_POST['concheckpass']));
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $archipelago = mysqli_real_escape_string($conn, $_POST['archipelago']);
  
     //generating vkey
     $vkey = md5(time().$name);


    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' ") or die('query failed');
    $select2 = mysqli_query($conn, "SELECT * FROM `user_form` WHERE username = '$username' ") or die('query failed');
    if (mysqli_num_rows($select) > 0) {
     
      $message[] = 'User already exist!';

    }   
    else if($pass != $cpass){
      $message[] = 'Password does not match!';
      
    }else if(strlen($username) > 10){
        $message[] = 'Username must not be up to 10 characters.';

    }else if(mysqli_num_rows($select2) > 0){
        $message[] = 'Username already Exist!';
    }

    else if($checkoutpass != $concheckoutpass){
        $message[] = 'Checkout Password does not match!';
      }
    
    else {
      mysqli_query($conn, "INSERT INTO `user_form` (fullname, email, username, password, checkout_pass, phonenumber, archipelago, vkey) VALUES('$name', '$email', '$username', '$pass', '$checkoutpass', '$phone', '$archipelago', '$vkey')") or die('query failed');
      $user_id = mysqli_insert_id($conn);
      mysqli_query($conn, "INSERT INTO notifications SET user_id='3', notification='A new user registered to NetGosyo. Congratulations!'");
      mysqli_query($conn, "INSERT INTO notifications SET user_id='$user_id', notification='Thank you for registering to NetGosyo. Have a happy shopping!'");
      
     
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
          $mail->Subject = 'Email Verfication';
          $template_file = "Templates/register_mail_template.php";
          $mail->Body    = "Click the link to Verify your Email Address <a href='http://localhost:3000/NetGosyo/cart-multiple-user(with%20message)/verify.php?vkey=$vkey'>Verify Account</a>";
          // file_get_contents($template_file);
         
          $mail->send();
          $message[] = 'registered successfully! please check your email address!';

      } catch (Exception $e) {
          $message[] =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

    }
  
    
  }


?>


<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <link href="css/user-seller.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <style>
    /* Add this CSS to style the email input with a red outline */
    .email-exists input[type="email"] {
        border: 1px solid red;
    }
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 form-block px-4">
                <div class="col-lg-8 col-md-6 col-sm-8 col-xs-12 form-box">
                    <div class="text-center mb-3 mt-5">
                        <img src="assets/logo-text.png" width="150px">
                    </div>
                    <h4 class="text-center mb-4">
                        Create an account
                    </h4>

                    <?php
                        if (isset($message)) {
                        foreach ($message as $message) {
                        echo '
                        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
                        <strong>'. $message .'</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
      
      

                            }
                            }
                        ?>
                 
                    <form action="" method="post">
                        <div class="form-input">
                            <span><i class="fa fa-user"></i></span>
                            <input type="text" name="username" placeholder="Username" value="<?php echo $usernameValue; ?>" required>
                        </div>

                        <div class="form-input">
                            <span><i class="fa fa-user"></i></span>
                            <input type="text" name="name" placeholder="Full Name" value="<?php echo $nameValue; ?>" required>
                        </div>

                        <div class="form-input">
                            <span><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" placeholder="Email Address" tabindex="10" value="<?php echo $emailValue; ?>" required>
                        </div>

                        <div class="form-input">
                            <span><i class="fa fa-phone"></i></span>
                            <input type="number" name="phone" placeholder="Phone Number" tabindex="10" value="<?php echo $phoneValue; ?>" required>
                        </div>

                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <span style="position: absolute; right: 20px; top: 50%; transform: translateY(-90%);" class="toggle-password" onclick="togglePasswordVisibility('password')"><i class="fa fa-eye"></i></span>
                            <input type="password" name="password" id="password" placeholder="Password" required>
                           
                        </div>

                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <span class="toggle-password" style="position: absolute; right: 20px; top: 50%; transform: translateY(-90%);" onclick="togglePasswordVisibility('cpassword', 'cpassword-eye')"><i id="cpassword-eye" class="fa fa-eye"></i></span>
                            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
                          
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create A Checkout Password</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group" style="position: relative;">
                                            <label for="archipelago" class="col-form-label"><b>Archipelago:</b></label>
                                            <select name="archipelago" class="form-control" id="archipelago">
                                            <option value="Luzon">Luzon</option>
                                            <option value="Visayas">Visayas</option>
                                            <option value="Mindanao">Mindanao</option>
                                            <option value="NCR">NCR</option>
                                            <option value="ISLAND">ISLAND</option>
                                            </select>
                                        </div>
                                    
                                        <div class="form-group" style="position: relative;">
                                            <label for="recipient-name" class="col-form-label"><b>Checkout Password:</b></label>
                                            <input type="password"  style="padding-right: 30px;" name="checkpass" id="checkpass" class="form-control" tabindex="10" required>
                                            <span class="toggle-password" style="position: absolute;  right: 10px; top: 88%; transform: translateY(-90%); cursor: pointer;" onclick="togglePasswordVisibility('checkpass', 'checkpass-eye')"><i id="checkpass-eye" class="fa fa-eye"></i></span>
                                        </div>

                                        <div class="form-group" style="position: relative;">
                                            <label for="recipient-name" class="col-form-label"><b>Confirm Checkout
                                                    Password:</b></label>
                                            <input type="password"  style="padding-right: 30px;" name="concheckpass" id="concheckpass" class="form-control"
                                                tabindex="10" required>
                                                <span class="toggle-password" style="position: absolute;  right: 10px; top: 88%; transform: translateY(-90%); cursor: pointer;" onclick="togglePasswordVisibility('concheckpass', 'concheckpass-eye')"><i id="concheckpass-eye" class="fa fa-eye"></i></span>
                                        </div>


                                        <br>
                                        <h3 class="text-center">What is A Checkout Password?</h3>

                                        <p class="text-justify">

                                            To guarantee that only the account owner can make purchases and prevent
                                            inadvertent checkouts, users will be asked to create a checkout password
                                            upon registration and each time they go through the checkout process.
                                            <br>
                                            <br>
                                            <b>What makes a good Checkout Password?</b>
                                            <br>
                                            • At least 8 characters long
                                            <br>
                                            • Random and difficult to guess
                                            <br>
                                            • Never re-used across different websites.
                                            <br>
                                            <br>
                                            Your best password is also one that is easy to remember. That might seem
                                            tricky if it has to be long and random, but in actual fact the strongest of
                                            passwords can be very easy to remember.
                                            <br>
                                            <br>

                                            <b>What should I pay attention to?</b>
                                            <br>
                                            • Remember to write down your checkout password.
                                            <br>
                                            • You can create a checkout password only once.
                                            <br>
                                            • Never divulge your checkout password to third parties.
                                            <br>
                                            <br>
                                            Since a checkout password can only be created once, we advise making a note
                                            of it so you won't forget it. In the event that it is forgotten, please
                                            message <b>NetGosyo</b>  through the website or send an email to
                                            <b>netgosyo398@gmail.com</b>. 

                                        </p>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="submit"
                                            class="btn color-checkout-bg">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <button type="submit" data-toggle="modal" data-target="#exampleModal" id="proceedButton"
                                data-whatever="@getbootstrap" class="btn btn-block" disabled>
                                Proceed
                            </button>
                        </div>

                        <div class="text-center mb-5">
                            Already have an account?
                            <a class="login-link" href="login.php">Login here!</a>
                        </div>
                    </form>
                  

                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block image-container"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    
<script>
  <?php if (isset($message) && !empty($message)) : ?>
    // If there is an error, focus on the first input field
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelector('input[name="username"]').focus();
    });
  <?php endif; ?>
</script>

<script>
    function togglePasswordVisibility(passwordFieldId) {
        var passwordField = document.getElementById(passwordFieldId);
        var icon = document.querySelector('.toggle-password i');

        // Toggle password field type
        if (passwordField.type === "password") {
            passwordField.type = "text";
            // icon.classList.remove('fa-eye');
            // icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = "password";
            // icon.classList.remove('fa-eye-slash');
            // icon.classList.add('fa-eye');
        }
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the form and the submit button
        var form = document.querySelector('form');
        var registerButton = document.getElementById('proceedButton');
        var modal = new bootstrap.Modal(document.getElementById('exampleModal'));

        // Function to enable/disable the button based on field values
        function updateRegisterButtonState() {
            var username = form.querySelector('[name="username"]').value;
            var fullname = form.querySelector('[name="name"]').value;
            var email = form.querySelector('[name="email"]').value;
            var phone = form.querySelector('[name="phone"]').value;
            var password = form.querySelector('[name="password"]').value;
            var cpassword = form.querySelector('[name="cpassword"]').value;

            var isButtonDisabled = username === '' || fullname === '' || email === '' || phone === '' || password === '' || cpassword === '';

            // Enable or disable the button based on the conditions
            registerButton.disabled = isButtonDisabled;
        }

        // Attach event listeners to form fields
        form.addEventListener('input', updateRegisterButtonState);
        form.addEventListener('change', updateRegisterButtonState);
        
       // Show the modal when the button is clicked
        registerButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent form submission for now

        // If the button is disabled, show the modal
        if (registerButton.disabled) {
            modal.show();
        } else {
            // If the button is not disabled, proceed with form submission
            form.submit();
        }
    });

    });
</script>


</body>

</html>