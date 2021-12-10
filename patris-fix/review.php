<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $userid = $_SESSION['userid'];
}


$pid = $_GET['pid'];
$orderid = $_GET['id'];
$sql = "SELECT customer_id from orders where order_id='$orderid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['customer_id'] != $userid) {
    header("Location: order.php?id=" .  $_GET['id']);
}

$sql2 = "SELECT * from product where product_id='$pid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

if (isset($_POST['submit'])) {

    $pid = $_GET['pid'];
    $orderid = $_GET['id'];
    $rating = $_POST['rating'];
    $desc = $_POST['desc'];
    $sql3 = "INSERT INTO review(product_id, order_id, review_rating, review_desc) 
    VALUES ('$pid','$orderid','$rating','$desc')";
    if (!mysqli_query($conn, $sql3)) {
        echo "<script>alert('Something is wrong.')</script>";
    } else {
        header("Location: order.php?id=" .  $_GET['id']);
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
    <main>
        <section class="login-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="basic-login">
                            <h3 class="text-center mb-60">Give Review for <?php echo $row2['product_name']; ?></h3>
                            <form method="POST">
                                <div class="text-center">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row2['product_image']) ?>" class="w-50 mb-5" alt="">
                                </div>
                                <label for="rating">Rating (1-5) <i class="fal fa-star red-color"></i> <i class="fal fa-star red-color"></i> <i class="fal fa-star red-color"></i> <i class="fal fa-star red-color"></i> <i class="fal fa-star red-color"></i></label>
                                <input type="number" name="rating" min="1" max="5" value="5">
                                <label for="desc">Review</label>
                                <input type="text" name="desc" placeholder="Type your review here.....">
                                <div class="mt-10"></div>
                                <button name="submit" class="btn theme-btn-2 w-100">Submit Review</button>
                            </form>
                            <div class="or-divide"><span>or</span></div>
                            <a href="order.php?id=<?php echo $orderid ?>"><button class="btn theme-btn w-100">Back to Order Details</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
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