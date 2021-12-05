<?php

include 'connect.php';

error_reporting(0);

session_start();

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
    <section class="contact-area pb-30" data-background="assets/img/bg/bg-map.png">
        <div class="has-breadcrumb-bg mb-120" style="background-image: url('img/contact.jpg');">
            <!-- <div class="breadcrumb-content d-flex justify-content-center align-items-center" style="flex-direction: column;">
                <h2 class="title">Contact</h2>
                <nav aria-label="breadcrumb" class="mb-40">
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div> -->
        </div>
        <div class="container container-1430">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact text-center mb-30">
                        <a href="mailto:AdminPatris@gmail.com"><i class="fas fa-envelope"></i></a>
                        <h3>Mail Here</h3>
                        <p style="font-size:large;">AdminPatris@gmail.com</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="contact text-center mb-30">
                        <a href="https://goo.gl/maps/4PBTDh4XXd6ykB2E7"><i class="fas fa-map-marker-alt"></i></a>
                        <h3>Visit Here</h3>
                        <p style="font-size:large;">Perumahan Graha Menganti 2 Blok K2 no 22, Menganti, Gresik</p>
                    </div>
                </div>
                <div class="col-xl-4  col-lg-4 col-md-4 ">
                    <div class="contact text-center mb-30">
                        <a href="https://api.whatsapp.com/send?phone=88230143092"><i class="fas fa-phone"></i></a>
                        <h3>WhatsApp Admin</h3>
                        <p style="font-size:large;">88230143092</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="contact-form-area grey-bg pt-100 pb-100">
        <div class="container container-1430">
            <div class="form-wrapper">
                <div class="row align-items-center">
                    <div class="col-xl-8 col-lg-8">
                        <div class="section-title mb-55">
                            <p><span></span> Anything On your Mind</p>
                            <h1>Estimate Your Idea</h1>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 d-none d-xl-block ">
                        <div class="section-link mb-80 text-right">
                            <a class="btn theme-btn" href="tel:+8123985789"><i class="fas fa-phone"></i> make call</a>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contact-form" action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-box user-icon mb-30">
                                    <input type="text" name="name" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-box email-icon mb-30">
                                    <input type="text" name="email" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-box phone-icon mb-30">
                                    <input type="text" name="phone" placeholder="Your Phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-box subject-icon mb-30">
                                    <input type="text" name="subject" placeholder="Your Subject">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-box message-icon mb-30">
                                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
                                </div>
                                <div class="contact-btn text-center">
                                    <button class="btn theme-btn" type="submit">get action</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <p class="ajax-response text-center"></p>
                </div>
            </div>
        </div>
    </section> -->

    <!-- <section class="contact-form-area pt-100 pb-100">
        <div class="container container-1430">
            <div class="row  service-row">
                <div class="col-md-4">
                    <div class="service-box service-box-2">
                        <div class="service-logo text-center">
                            <img src="img/logo/icon-1.jpg" alt="" class="service-img">
                        </div>
                        <div class="service-content text-center">
                            <h6 class="title">Creative Design</h6>
                            <p>Duis autem vel eum iriure dolor in hendrerit vulputate <br> velit esse molestie
                                consequat.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-box service-box-2">
                        <div class="service-logo text-center">
                            <img src="img/logo/icon-2.jpg" alt="" class="service-img">
                        </div>
                        <div class="service-content text-center">
                            <h6 class="title">Strong Branding</h6>
                            <p>Duis autem vel eum iriure dolor in hendrerit vulputate <br> velit esse molestie
                                consequat.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="service-box service-box-2">
                        <div class="service-logo text-center">
                            <img src="img/logo/icon-3.jpg" alt="" class="service-img">
                        </div>
                        <div class="service-content text-center">
                            <h6 class="title">Project Development</h6>
                            <p>Duis autem vel eum iriure dolor in hendrerit vulputate <br> velit esse molestie
                                consequat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
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