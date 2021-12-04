<?php
include 'connect.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
}

$sql = "SELECT * FROM product, category where product_category = category_id";
$result = mysqli_query($conn, $sql);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Patris Official Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="produk/logo.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
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
    <!-- preloader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <!-- header section start -->
    <header class="header pt-30 pb-30  header-sticky header-static" style="padding-top: 30px; padding-bottom: 15px; top: 0px;">
        <div class="container-fluid">
            <div class="header-nav position-relative">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6 hidden-md position-static">
                        <div class="header-nav">
                            <nav>
                                <ul>
                                    <li><a class="active" href="index.php"><span style="font-size: 15px; margin-right: 20px;margin-left: 15px;">Home</span></a>
                                    </li>
                                    <li><a href="shop.php"><span style="font-size: 15px;margin-right: 20px;">Shop</span></a></li>
                                    <li><a href="contact.php"><span style="font-size: 15px;margin-right: 20px;">Contact</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-3">
                        <div class="logo">
                            <a href="index.php"><img src="produk/logo2.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-3 col-6 col-md-6 col-sm-6 col-9">
                        <div class="header-right" style="font-size: 15px; margin-right: 20px;margin-left: 15px;">
                            <ul class="text-right">
                                <li>
                                    <a href="
                                 <?php
                                    if (isset($_SESSION['username'])) {
                                        echo "account.php";
                                    } else {
                                        echo "login.php";
                                    }
                                    ?>
                                 " class="account">
                                        <i class="fal fa-user-friends"></i>
                                        <article class="account-registar d-inline-block">
                                            <?php
                                            if (isset($_SESSION['username'])) {
                                                echo $user;
                                            } else {
                                                echo "Login/Sign Up";
                                            }
                                            ?>
                                        </article>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fal fa-search"></i></a>
                                    <!-- search popup -->
                                    <div id="search-popup">
                                        <div class="close-search-popup">
                                            <i class="fal fa-times"></i>
                                        </div>
                                        <div class="search-popup-inner mt-135">
                                            <div class="search-title text-center">
                                                <h2>Search</h2>
                                            </div>
                                            <div class="search-content pt-55">
                                                <div class="search-form mt-35">
                                                    <form action="#" method="post">
                                                        <input type="text" placeholder="Search Products...">
                                                        <button type="submit"><i class="fal fa-search"></i></button>
                                                    </form>
                                                </div>
                                                <div class="search-result-list">
                                                    <ul class="text-left">
                                                        <li class="d-block d-flex align-items-center">
                                                            <div class="search-result-img">
                                                                <img src="img/product/1.jpg" class="w-100" alt="">
                                                            </div>
                                                            <div class="search-result-desc pl-10">
                                                                <a href="single-product.php" class="title px-0">ELLE -
                                                                    Recliner syntheti chair</a>
                                                                <div class="price">$<span>399</span></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-block d-flex align-items-center">
                                                            <div class="search-result-img">
                                                                <img src="img/product/2.jpg" class="w-100" alt="">
                                                            </div>
                                                            <div class="search-result-desc pl-10">
                                                                <a href="single-product.php" class="title px-0">RIMINI -
                                                                    Folding leather deck chair</a>
                                                                <div class="price">$<span>399</span></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-block d-flex align-items-center">
                                                            <div class="search-result-img">
                                                                <img src="img/product/3.jpg" class="w-100" alt="">
                                                            </div>
                                                            <div class="search-result-desc pl-10">
                                                                <a href="single-product.php" class="title px-0">LANDSCAPE
                                                                    - Folding fabric deck chair</a>
                                                                <div class="price">$<span>399</span></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-block d-flex align-items-center">
                                                            <div class="search-result-img">
                                                                <img src="img/product/1.jpg" class="w-100" alt="">
                                                            </div>
                                                            <div class="search-result-desc pl-10">
                                                                <a href="single-product.php" class="title px-0">ELLE -
                                                                    Recliner syntheti chair</a>
                                                                <div class="price">$<span>399</span></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-block d-flex align-items-center">
                                                            <div class="search-result-img">
                                                                <img src="img/product/2.jpg" class="w-100" alt="">
                                                            </div>
                                                            <div class="search-result-desc pl-10">
                                                                <a href="single-product.php" class="title px-0">RIMINI -
                                                                    Folding leather deck chair</a>
                                                                <div class="price">$<span>399</span></div>
                                                            </div>
                                                        </li>
                                                        <li class="d-block d-flex align-items-center">
                                                            <div class="search-result-img">
                                                                <img src="img/product/3.jpg" class="w-100" alt="">
                                                            </div>
                                                            <div class="search-result-desc pl-10">
                                                                <a href="single-product.php" class="title px-0">LANDSCAPE
                                                                    - Folding fabric deck chair</a>
                                                                <div class="price">$<span>399</span></div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="cart.php"><i class="fal fa-shopping-bag"><span>5</span></i></a>
                                    <div class="minicart">
                                        <div class="minicart-body">
                                            <div class="minicart-content">
                                                <ul class="text-left">
                                                    <li>
                                                        <div class="minicart-img">
                                                            <a href="single-product.php" class="p-0"><img src="img/product/1.jpg" class="w-100" alt=""></a>
                                                        </div>
                                                        <div class="minicart-desc">
                                                            <a href="single-product.php" class="p-0">Capitalize on low
                                                                hanging fruit t</a>
                                                            <strong>1 × $250.00</strong>
                                                        </div>
                                                        <div class="remove">
                                                            <i class="fal fa-times"></i>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="minicart-img">
                                                            <a href="single-product.php" class="p-0"><img src="img/product/2.jpg" class="w-100" alt=""></a>
                                                        </div>
                                                        <div class="minicart-desc">
                                                            <a href="single-product.php" class="p-0">Leather Courriere
                                                                duffle ba</a>
                                                            <strong>1 × $150.00</strong>
                                                        </div>
                                                        <div class="remove">
                                                            <i class="fal fa-times"></i>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="minicart-img">
                                                            <a href="single-product.php" class="p-0"><img src="img/product/3.jpg" class="w-100" alt=""></a>
                                                        </div>
                                                        <div class="minicart-desc">
                                                            <a href="single-product.php" class="p-0">Party Supplies
                                                                Around Cupcake</a>
                                                            <strong>1 × $150.00</strong>
                                                        </div>
                                                        <div class="remove">
                                                            <i class="fal fa-times"></i>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="minicart-checkout">
                                            <div class="minicart-checkout-heading mt-8 mb-25 overflow-hidden">
                                                <strong class="float-left">Subtotal:</strong>
                                                <span class="price float-right">503.00</span>
                                            </div>
                                            <div class="minicart-checkout-links">
                                                <a href="cart.php" class="generic-btn black-hover-btn text-uppercase w-100 mb-20">View
                                                    cart</a>
                                                <a href="checkout.php" class="generic-btn black-hover-btn text-uppercase w-100 mb-20">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><i class="fal fa-align-right"></i></a>
                                    <ul class="submenu bold-content text-right">
                                        <li><a href="account.php">My Account</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                        <li><a href="shop.php">Shop</a></li>
                                        <li><a href="order.php">My Order</a></li>
                                        <?php if (isset($_SESSION['username'])) echo '<li><a href="logout.php">Logout</a></li>'; ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu visible-sm">
                <div id="mobile-menu">
                    <ul>
                        <li><a class="pl-3" href="javascript:void(0)" href="index.php">Home</a></li>
                        <li><a class="pl-3" href="javascript:void(0)" href="shop.php">Shop</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
            <!-- /. mobile nav -->
        </div>
    </header>
    <!-- header section end -->
    <!-- slider section start -->
    <section class="slider">
        <div class="slider-active">
            <div class="single-slider d-flex align-items-center h-950" data-background="produk/bg.jpg">
                <div class="container">
                    <div class="single-slider-inner d-flex align-items-center justify-content-start">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- slider section end -->
    <!-- main product sections tart -->
    <!-- new arrival section start -->
    <section class="new-arrival mt-120">
        <div class="container container-1430">
            <div class="generic-title text-center">
                <h2 class="mb-20">Our Products</h2>
            </div>
            <div class="new-arrival-wrapper mt-55">
                <div class="row">
                    <?php for ($i = 0; $i < 8; $i++) {
                        $row = mysqli_fetch_assoc($result);
                        echo '
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-box mb-40">
                            <div class="product-box-wrapper">
                                <div class="product-img">
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['product_image']) . '"class="w-100" alt="">
                                    <a href="single-product.php?id=' . $row['product_id'] . '" class="product-img-link quick-view-1 text-capitalize">Product Details</a>
                                </div>
                                <div class="product-desc pb-20">
                                    <div class="product-desc-top">
                                        <div class="categories">
                                            <a href="shop.php" class="product-category"><span>' . $row['category_name'] . '</span></a>
                                        </div>
                                    </div>
                                    <a href="single-product.php?id=' . $row['product_id'] . '" class="product-title">' . $row['product_name'] . '</a>
                                    <div class="price-switcher">
                                        <span class="price switcher-item">Rp. ' . $row['product_price'] . '</span>
                                        <a href="cart.php" class="add-cart text-capitalize switcher-item">+add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>';
                    }
                    ?>

                </div>
                <div class="text-center load-btn mt-20">
                    <a href="shop.php" class="load-more">SHOW MORE...</a>
                </div>
            </div>
        </div>
        <div class="container   gray-border-bottom pb-110"></div>
    </section>
    <!-- new arrival section end -->
    <!-- main product sections end -->
    <!-- footer section start -->
    <section class="footer">
        <!-- footer top -->
        <div class="footer-bottom pt-77" style="background-color: #F0628C;">
            <div class="container-1180">
                <div class="footer-bottom-wrapper">
                    <div class="footer-bottom-primary pb-60">
                        <div class="row">
                            <div class="col-xl-5 col-lg-5 col-md-9">
                                <div class="footer-item has-desc">
                                    <div class="footer-logo mb-25">
                                        <img src="produk/logo patris 2.png" width="120" height="90" href="index.php">
                                        <p style="color: #FFFFFF;font-size: 20px;font-weight: 20px;margin-top: 40px;">
                                            Customer Service
                                        </p>
                                        <p style="color: #FFFFFF;font-size: 20px;font-weight: 20px;margin-top: 40px;">Jam
                                            Kerja: 09.00 s/d 15.00 WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-12">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
                                        <div class="footer-menu">
                                            <ul>
                                                <li><a href="index.php" style="color: #FFFFFF;font-size: 20px;font-weight: 20px;">Home</a></li>
                                                <li><a href="account.php" style="color: #FFFFFF;font-size: 20px;font-weight: 20px; margin-top: 30px;">My account</a></li>
                                                <li><a href="checkout.php" style="color: #FFFFFF;font-size: 20px;font-weight: 20px;margin-top: 30px;">Checkout</a>
                                                </li>
                                                <li><a href="shop.php" style="color: #FFFFFF;font-size: 20px;font-weight: 20px;margin-top: 30px;">Shop</a>
                                                </li>
                                                <li><a href="contact.php" style="color: #FFFFFF; font-size: 20px;font-weight: 20px;margin-top: 30px;">Contact</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 hidden-sm" style="margin-left:100px;">
                                        <div class="footer-menu">
                                            <ul>
                                                <li style="color: #FFFFFF;font-size: 20px;font-weight: 20px;">Follow Us:
                                                </li>
                                                <li style="color: #FFFFFF; font-size: 20px;font-weight: 20px;margin-top: 30px;">
                                                    <img src="https://img.icons8.com/material-rounded/50/ffffff/instagram-new.png" />
                                                    Patris.Official
                                                </li>
                                                <li style="color: #FFFFFF; font-size: 20px;font-weight: 20px;margin-top: 30px;">
                                                    <img src="https://img.icons8.com/material-rounded/50/ffffff/twitter.png" />
                                                    Patris_Shoes</a>
                                                </li>
                                                <li style="color: #FFFFFF; font-size: 20px;font-weight: 20px;margin-top: 30px;">
                                                    <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook--v1.png" />
                                                    PATRIS SHOES</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer section end -->
    <!-- JS here -->
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
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>