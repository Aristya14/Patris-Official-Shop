<?php
include 'connect.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
    $userid = $_SESSION['userid'];
}

$id = $_GET['id'];

$sql = "SELECT * FROM product, category where product_category = category_id and product_id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT product_id, customer_name, review_rating, review_desc FROM review r, orders o, customer c where r.order_id = o.order_id and o.customer_id = c.customer_id and r.product_id = '$id'";
$result2 = mysqli_query($conn, $sql2);
$num = $result2->num_rows;

if (isset($_POST['submitqty'])) {
    if (isset($_SESSION['username'])) {
        $qty = $_POST['qty'];
        $stock = $_POST['stock'];
        $pname = $_POST['pname'];
        
        $sql4 = "SELECT * from cart where customer_id = '$userid' and product_id = '$id'";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        if ($result4->num_rows == 0) {
            $sql5 = "INSERT INTO cart(product_id, quantity, customer_id) VALUES ('$id', '$qty', '$userid')";
            $result5 = mysqli_query($conn, $sql5);
            if (!$result5)
                echo "<script>alert('Something is wrong.')</script>";
        } else {
            if (($row4['quantity'] + $qty) > $stock) {
                echo "<script>alert('" . $pname . " only have " . $stock . " on stock. You already have " . $row4['quantity'] . " in cart')</script>";
            } else {
                $sql5 = "UPDATE cart set quantity = quantity+'$qty' where customer_id = '$userid' and product_id = '$id'";
                $result5 = mysqli_query($conn, $sql5);
                if (!$result5)
                    echo "<script>alert('Something is wrong.')</script>";
            }
        }
    } else {
        header("Location: login.php");
    }
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
    <section class="single-product mb-90">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="mb-40">
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item" aria-current="page">Product</li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['category_name']; ?></li>
                </ol>
            </nav>
            <div class="shop-wrapper">
                <div class="single-product-top">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-12">
                            <div class="shop-img">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="tab-1">
                                                <div class="product-img">
                                                    <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['product_image']) . '"class="w-100" alt="">'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-12">
                            <div class="single-product-sidebar">
                                <div class="product-content">
                                    <div class="single-product-title">
                                        <h2><?php echo $row['product_name']; ?></h2>
                                    </div>
                                    <div class="single-product-price">Rp. <?php echo number_format($row['product_price']); ?></div>
                                    <div class="single-product-desc mb-25">
                                        <p>PATRIS OFFICIAL STORE - FASHION STYLE.</p>
                                        <p><?php echo $row['product_desc']; ?></p>
                                        <p>Material: High Quality Synthetic Leather</p>
                                        <p>Size: <?php echo $row['product_size']; ?></p>
                                        <p>100% Brand New and High Quality!</p>
                                        <p>Stock available: <?php echo $row['product_stock']; ?></p>
                                    </div>

                                    <div class="quick-quantity mt-0">
                                        <form method="POST">
                                            <input id="pname" name="pname" type="hidden" value="<?php echo $row['product_name']; ?>">
                                            <input id="stock" name="stock" type="hidden" value="<?php echo $row['product_stock']; ?>">
                                            <input name="qty" type="number" class="mb-20" value="1" min="1" max="<?php echo $row['product_stock']; ?>" style="margin-right: 20px; width: 119px;">
                                            <button name="submitqty" type="submit" class="list-add-cart-btn red-hover-btn border-0" style="padding-left: 80px;padding-right: 80px;transition: all .5s;">add to cart
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-product-bottom mt-80 gray-border-top" id="review">
                    <ul class="nav nav-pills justify-content-center mt-100" role="tablist">
                        <li class="nav-item">
                            <a class="active">Reviews (<?php echo $num; ?>)</a>
                        </li>
                    </ul>
                    <div class="container container-1200">
                        <div class="tab-content mt-60">
                            <div class="tab-pane fade show active" id="desc-tab-2">
                                <div class="single-product-tab-content">
                                    <h3 class="title mb-30">Reviews</h3>
                                    <?php
                                    if ($num == 0) {
                                        echo '<p>There are no reviews yet.</p>';
                                    } else {
                                        echo '<div class="review-box-item">
                                        <div class="review-box-content">
                                            <div class="row">';

                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                            echo
                                            '
                                                        <div class="col-7">
                                                            <div class="author-name">
                                                                <h6>' . $row2['customer_name'] . '</h6>
                                                                <div class="content">
                                                                    <p class="mb-3">' . $row2['review_desc'] . '</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-5 pr-5-px pl-0">
                                                            <div class="rating text-right">';
                                            for ($i = 0; $i < $row2['review_rating']; $i++) {
                                                echo '<i class="fal fa-star red-color"></i>';
                                            }
                                            for ($i = $row2['review_rating']; $i < 5; $i++) {
                                                echo '<i class="fal fa-star"></i>';
                                            }
                                            echo
                                            '</div>
                                                        </div>
                                                        ';
                                        }

                                        echo '
                                            </div>
                                        </div>
                                    </div>';
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>

    <script src="js/jquery.min.js"></script>
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