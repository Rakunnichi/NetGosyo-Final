<?php
include 'config.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('location:index.php');
}

if (isset($_POST['submit']) || isset($_POST['submit2'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? $_POST['email2']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password'] ?? $_POST['password2']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass' ") or die('query failed');
    // $ifseller = '';
   
//     if (mysqli_num_rows($select) > 0) {
//         $row = mysqli_fetch_assoc($select);
//         $_SESSION = $row;
//         $verified = $row['verified'];
//         $ifseller = $row['shopname'];

//         if($row['is_banned'] == 0){
//           if (isset($_POST['submit'])) {
//             $_SESSION['role'] = ($ifseller == 'user') ? 'user' : 'seller';

//             if ($ifseller == 'user') {
//               $_SESSION['user_id'] = $row['id'];
//                 header('Location:index.php');
//             } else if ( $row['verified'] != 1) {
               
//                 $message[] = 'Please Check Your Email First To Verify your Account!';
//             } else {
//                 $message[] = 'The Account you are trying to login is not a User Account!';
//             }
//           } elseif (isset($_POST['submit2'])) {
//               $_SESSION['role'] = ($ifseller == 'user') ? 'user' : 'seller';

//               if ($ifseller != 'user' && $verified == 1) {
//                   $_SESSION['user_id'] = $row['id'];
//                   header('location:Seller_Page/index.php');
//               } elseif ($ifseller == 'user') {
//                   $message[] = 'The Account you are trying to login is not a Seller Account!';
//               } else {
//                   $message[] = 'Please Check Your Email First To Verify your Account!';
//               }
//           }
//         } else {
//           $message[] = 'Your Account is Banned';
//         }

        
//     } else {
//         $message[] = 'Incorrect Credentials!';
//     }


if (mysqli_num_rows($select) > 0) {
  $row = mysqli_fetch_assoc($select);
  $_SESSION = $row;
  $verified = $row['verified'];
  $ifseller = $row['shopname'];
//   // Check if the account is banned
//   if ($row['is_banned'] == 0) {
//       if ($row['verified'] == 1) { // Check if the account is verified
//           $ifseller = $row['shopname'];

//           if (isset($_POST['submit'])) {
//             $_SESSION['role'] = ($ifseller == 'user') ? 'user' : 'seller';
//             $_SESSION['user_id'] = $row['id'];
//             header('Location:index.php');
          
//           }
//            elseif (isset($_POST['submit2'])) {
//             $_SESSION['role'] = ($ifseller == 'user') ? 'user' : 'seller';
//             $_SESSION['user_id'] = $row['id'];
//             header('location:Seller_Page/index.php');

//           }
          
//       } else {
//           $message[] = 'Your account is not yet verified. Please check your email for the verification link.';
//       }
//   } else {
//       $message[] = 'Your account is banned.';
//   }
// } else {
//   $message[] = 'Incorrect Credentials!';
// }

if ($row['is_banned'] == 0) {
  if ($row['verified'] == 1) {
      if (isset($_POST['submit']) && $ifseller == 'user') {
          $message[] = 'The Account you are trying to login is not a Seller Account!';
      } elseif (isset($_POST['submit2']) && $ifseller != 'user') {
          $_SESSION['role'] = 'seller';
          $_SESSION['user_id'] = $row['id'];
          header('location:Seller_Page/index.php');
      } else {
          $_SESSION['role'] = ($ifseller == 'user') ? 'user' : 'seller';
          $_SESSION['user_id'] = $row['id'];
          header('Location:index.php');
      }
  } else {
      $message[] = 'Your account is not yet verified. Please check your email for the verification link.';
  }
} else {
  $message[] = 'Your account is banned.';
}
} else {
$message[] = 'Incorrect Credentials!';
}

}

?>