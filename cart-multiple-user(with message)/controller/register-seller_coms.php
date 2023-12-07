<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_POST['submit'])) {
    $shopname = mysqli_real_escape_string($conn, $_POST['shopname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    // generating vkey
    $vkey = md5(time().$name);

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or exit('query failed');
    if (mysqli_num_rows($select) > 0) {
        $message[] = 'user already exist!';
    } elseif ($pass != $cpass) {
        $message[] = 'password does not match!';
    } else {
        mysqli_query($conn, "INSERT INTO `user_form` (fullname, email, username, password, shopname, vkey) VALUES('$name', '$email', '$username', '$pass', '$shopname', '$vkey')") or exit('query failed');
        $user_id = mysqli_insert_id($conn);
        mysqli_query($conn, "INSERT INTO notifications SET user_id='1', notification='A new user registered to NetGosyo. Congratulations!'");
        mysqli_query($conn, "INSERT INTO notifications SET user_id='$user_id', notification='Thank you for registering to NetGosyo. Have a happy shopping!'");

        // sending email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'netgosyo398@gmail.com';                     // SMTP username
            $mail->Password = 'oxohqqatqijavfza';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('netgosyo398@gmail.com', 'NetGosyo Team');
            $mail->addAddress($email, $name);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Email Verfication';
            $template_file = 'Templates/register_mail_template.php';
            $mail->Body = "Click the link to Verify your Email Address <a href='http://localhost:3000/NetGosyo/cart-multiple-user(with%20message)/verify.php?vkey=$vkey'>Verify Account</a>";
            // file_get_contents($template_file);

            $mail->send();
            $message[] = 'registered successfully! please check your email address!';
        } catch (Exception $e) {
            $message[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
