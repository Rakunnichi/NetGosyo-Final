<?php
require '../config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require '../vendor/autoload.php';
session_start();



if(isset($_GET['deleteProduct'])){
	
    $id = $_GET['id'];
	
		mysqli_query($conn, "DELETE FROM products WHERE id='$id'");
		header("location:product_list.php");
	

}

if(isset($_GET['deleteUser'])){
	
    $id = $_GET['id'];
	
		mysqli_query($conn, "DELETE FROM user_form WHERE id='$id'");
		header("location:manage_users.php");
	

}

if(isset($_GET['banUser'])){
	
    $id = $_GET['id'];
	
		mysqli_query($conn, "UPDATE user_form SET is_banned = 1 WHERE id='$id'");
		if(isset($_GET['email'])){
			sendEmail($_GET['email'], $_GET['name'], 1);
		}
		header("location:manage_users.php");
	

}

if(isset($_GET['unbanUser'])){
	
    $id = $_GET['id'];
	
		mysqli_query($conn, "UPDATE user_form SET is_banned = 0 WHERE id='$id'");
		if(isset($_GET['email'])){
			sendEmail($_GET['email'], $_GET['name'], 0);
		}
		header("location:manage_users.php");
	

}

function sendEmail($email, $name, $is_banned){
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
		$mail->Subject = 'Account Banned!';
		$template_file = "Templates/register_mail_template.php";
		$mail->Body    =  $is_banned == 1 ? "Your NetGosyo Account has been BANNED by the administrator. If This is a mistake please reach out to our email:<b> netgosyo398@gmail.com </b>": "Congatulations, Your NetGosyo Account has been UNBANNED.";
		// file_get_contents($template_file);
		
		$mail->send();
		$message[] = 'registered successfully! please check your email address!';

      } catch (Exception $e) {
          $message[] =  "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
}

