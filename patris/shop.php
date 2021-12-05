<?php
include 'connect.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
}

if ($_GET['cat']) {
    $cat = $_GET['cat'];

    $sql2 = "SELECT category_name FROM category where category_id = '$cat'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $sql = "SELECT * FROM product, category where product_category = category_id and category_id = '$cat'";
    $result = mysqli_query($conn, $sql);
    $num = $result->num_rows;
} else if ($_GET['search']) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM product, category where product_category = category_id and 
    (product_name like '$search%' or category_name like '$search%' 
    or product_name like '%$search' or category_name like '%$search'
    or product_name like '%$search%' or category_name like '%$search%')";
    $result = mysqli_query($conn, $sql);
    $num = $result->num_rows;
} else {
    $sql = "SELECT * FROM product, category where product_category = category_id";
    $result = mysqli_query($conn, $sql);
    $num = $result->num_rows;
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
    <div class="shop-body mb-90">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="mb-40">
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </nav>
            <div class="shop-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center align-items-center">
                            <?php if ($_GET['cat']) echo '<h2>Categories: ' . $row2['category_name'] . '</h2>';
                            else if ($_GET['search']) echo '<h2>Search results for: ' . $search . '</h2>';
                            else echo '<h2>All Products</h2>'; ?>
                        </div>
                        <div class="filter-heading">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                    <div class="filter-shown-item">
                                        <?php if ($num != 0) echo '<p class="mb-0">Showing 1 - ' . $num . ' of ' . $num . ' results </p>';
                                        else echo '<p class="mb-0">No results found</p>'; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-content">
                            <div class="tab-content">
                                <div class="tab-pane fade  show active" id="shop-tab-3">
                                    <div class="product-wrapper mt-55">
                                        <div class="row">
                                            <?php while ($row = mysqli_fetch_assoc($result)) {
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
                        </div> ';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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