<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Email Verified</title>
  <style>
    body {
      background-color: #d8dadc;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      max-width: 400px;
    }

    .alert {
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .alert-success {
      background-color: #ffffff;
      color: #155724;
      padding: 20px;
      text-align: center;
    }

    .fa-times-circle {
      font-size: 3em;
      color:#6c0101;
    }
   
    h4 {
      font-size: 1.5em;
      margin-bottom: 10px;
     
    }

    p {
      font-size: 1.2em;
      margin-bottom: 20px;
     
    }

    .btn-home {
      background-color: #E6873C;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
    }

    .btn-home:hover {
      background-color: #0d0a07;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="alert alert-success" role="alert">
    <div>
      <i class="fas fa-times-circle mb-3"></i>
      <h4 class="alert-heading">Your Email has Already been Verified!</h4>
      <p class="mb-4">You can now Login to Your Account!</p>
      <button class="btn btn-home" onclick="goToHomePage()">Go Back to Home Page</button>
    </div>
  </div>
</div>

<!-- Font Awesome Icons (you can include this from a CDN or download and host it locally) -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit-code.js" crossorigin="anonymous"></script>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
  function goToHomePage() {
    // Replace this with the actual URL of your home page
    window.location.href = "https://netgosyo.com";
  }
</script>

</body>
</html>
