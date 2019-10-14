<?php
$pageTitle = 'Login';
$noNavbar = '';
include 'init.php';
//echo password_hash('123456', PASSWORD_DEFAULT);
if(isset($_SESSION['admin'])) {
    redirect('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- OUR CSS FILES -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <!-- START LOGIN -->
        <div class="login">
            <div class="container">
                <div class="row">
                    <div class="login-container col-md-6 offset-md-3 shadow p-3 mb-5  rounded">
                        <h1 class="d-flex justify-content-center ">Login To</h1>
                        <img  src="assets/images/logo.png" alt="LOGO">
                        <!-- START PHP CODE -->

                        <!-- END PHP CODE -->
                        <form action="loginprocess.php" method="POST">
                            <div class="form-group input-perant">
                                <input type="email" name='email' class="form-control" placeholder='Enter Your Email' autocomplete='off'>
                                <i class="fas fa-envelope fa-fw fa-1x"></i>
                            </div>
                            <div class="form-group input-perant">
                                <input type="password" name='password' class="form-control" placeholder='Enter Your Password' autocomplete='off'>
                                <i class="fas fa-lock fa-fw fa-1x"></i>
                            </div>
                            <div class="form-group input-perant ">
                                <input type="submit"  class="btn   submit" value="Login">
                                <i class="fas fa-location-arrow fa-fw fa-1x"></i>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- END LOGIN -->

    <!-- OUR SCRIPT -->
<script src="<?php echo $js . 'jquery-3.3.1.min.js' ?>"> </script>
<script src="<?php echo $js . 'bootstrap.min.js' ?>"> </script>
<script src="<?php echo $js . 'main.js' ?>"> </script>
</body>
</html>