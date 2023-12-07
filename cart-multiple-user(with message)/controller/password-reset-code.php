<?php
    include('../config.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    require '../vendor/autoload.php';

function send_password_reset($get_name,$get_email, $token){
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
		$mail->addAddress( $get_email, $get_name);     //Add a recipient
		
	
		
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Password Change';
		$mail->Body    =  "
            <h2>Hello! <b> .$get_name.</b> </h2>
            <h3>You are Receiving this email because you have requested a password reset for your account.</h3>
            <br></br>
            <a href='http://localhost:3000/NetGosyo/cart-multiple-user(with%20message)/password-change.php?token=$token&email=$get_email'> Click Here! </a>
        
        ";
		
		
		$mail->send();
		$message[] = 'registered successfully! please check your email address!';

      } catch (Exception $e) {
          $message[] =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

}

    if(isset($_POST['password_reset_link'])){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $token = md5(rand());

        $check_email = "SELECT email FROM user_form WHERE email='$email' LIMIT 1 ";
        $check_email_run = mysqli_query($conn, $check_email);

        if(mysqli_num_rows($check_email_run) > 0){

            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['fullname'];
            $get_email = $row['email'];

            $update_token = "UPDATE users SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
            $update_token_run = mysqli_query($conn,$update_token);

            if($update_token_run){

                send_password_reset($get_name,$get_email, $token);
                $Message = "We sent you a link. Please check your email.";
                header("Location:forgot-password.php");
                exit(0);

            }else{

                $Message = "Something Went Wrong!";
                header("Location:forgot-password.php");
                exit(0);

            }

        } else{
            $Message = "No Email Found!";
            header("Location:forgot-password.php");
            exit(0);
        }

    }
?>