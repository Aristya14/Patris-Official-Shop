<?php

include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $user = $_SESSION['username'];
}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Patris Official Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content" style="flex-direction: column;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Order</li>
                                </ol>
                            </nav>
                            <h2 class="login-title mt-40">Order</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="login-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="basic-login">
                            <h3>Login From Here</h3>
                            <!-- <form action="#">
                                <label for="name">Email Address <span>**</span></label>
                                <input id="name" type="text" placeholder="Enter Username or Email address..." />
                                <label for="pass">Password <span>**</span></label>
                                <input id="pass" type="password" placeholder="Enter password..." />
                                <div class="login-action mb-20 fix">
                                    <span class="log-rem f-left">
                                        <input id="remember" type="checkbox" />
                                        <label for="remember">Remember me!</label>
                                    </span>
                                    <span class="forgot-login f-right">
                                        <a href="javascript:void(0)">Lost your password?</a>
                                    </span>
                                </div>
                                <button class="btn theme-btn-2 w-100">Login Now</button>
                                <div class="or-divide"><span>or</span></div>
                                <button class="btn theme-btn w-100">Register Now</button>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/one-page-nav-min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>