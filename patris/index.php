<?php
include 'connect.php';

error_reporting(0);

session_start();

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
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
    
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
    <?php include 'header.php'; ?>
    <section class="slider">
        <div class="slider-active">
            <div class="single-slider d-flex align-items-center h-950" data-background="img/bg.jpg">
                <div class="container">
                    <div class="single-slider-inner d-flex align-items-center justify-content-start">
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                            <a href="single-product.php?id=' . $row['product_id'] . '">
                                <div class="product-img">
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['product_image']) . '"class="w-100" alt="">
                                    <a href="single-product.php?id=' . $row['product_id'] . '" class="product-img-link quick-view-1 text-capitalize">Product Details</a>
                                </div></a>
                                <div class="product-desc pb-20">
                                    <div class="product-desc-top">
                                        <div class="categories">
                                            <a href="shop.php?cat=' . $row['category_id'] . '" class="product-category"><span>' . $row['category_name'] . '</span></a>
                                        </div>
                                    </div>
                                    <a href="single-product.php?id=' . $row['product_id'] . '" class="product-title">' . $row['product_name'] . '</a>
                                    <a class="red-color">Rp. ' . number_format($row['product_price']) . '</a>
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
        <div class="container gray-border-bottom pb-110"></div>
    </section>
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
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>