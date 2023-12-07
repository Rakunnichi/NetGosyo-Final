<?php
    


    if(isset($_GET['vkey'])){
        //process verification
        $vkey = $_GET['vkey'];

         //database connection
         $mysqli = new mysqli('localhost', 'root','','ecom');

        $resultSet = $mysqli->query ("select verified,vkey from user_form where verified = 0 and vkey= '$vkey'
        limit 1");

        if($resultSet ->num_rows == 1){
            //validating email

            $update = $mysqli ->query("update user_form set  verified = 1 where vkey= '$vkey' limit 1");

            if($update){
                header('location:Templates/email_verify.php');
            }else{
                echo $mysqli->error;
            }

        }else{
            header('location:Templates/email_already_verify.php');
        }


    }else{
        die("Error! Something went wrong");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NetGosyo</title>
    
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- CSS File -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
   
</body>

</html>
