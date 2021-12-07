<?php

include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $user = $_SESSION['username'];
    $userid = $_SESSION['userid'];
}

$ship = $_SESSION['shipprice'];
$city = $_SESSION['cityname'];
$prov = $_SESSION['provname'];
$cour = $_SESSION['courier'];
$serv = $_SESSION['service'];



$sql = "SELECT * FROM cart c, product p where c.product_id=p.product_id and customer_id='$userid'";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT sum(c.quantity*p.product_price) as sumprice FROM cart c, product p where c.product_id=p.product_id and customer_id='$userid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$sumprice = $row2['sumprice'];

$sql2 = "SELECT sum(quantity) as sumquantity FROM cart  where customer_id='$userid'";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$sumquantity = $row2['sumquantity'];

$sql3 = "SELECT * FROM customer where customer_id='$userid'";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$name = explode(' ', $row3['customer_name']);
$first = $name[0];
$last = $name[1];

if (isset($_POST['placeorder'])) {
    $payment = $_POST['payment'];
    $receiver = $_POST['firstname'] . " " . $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $date = date("Y-m-d");
    $shiporder = $cour . " " . $serv;
    $total = $sumprice + $ship;

    $sql4 = "INSERT INTO payment(payment_methode, payment_status) VALUES ('$payment', 'Not Paid')";
    if (!mysqli_query($conn, $sql4)) {
        echo "<script>alert('Something is wrong.')</script>";
    }
    $payid = mysqli_insert_id($conn);

    $sql5 = "INSERT INTO orders(customer_id, payment_id, order_date, order_status, order_address, 
    order_receiver, order_cost, order_sumproduct, order_city, order_province, order_ship, order_shipcost, order_total) 
    VALUES ('$userid','$payid','$date','Waiting for payment','$address','$receiver','$sumprice','$sumquantity','$city',
    '$prov','$shiporder','$ship','$total')";
    if (!mysqli_query($conn, $sql5)) {
        echo "<script>alert('Something is wrong.')</script>";
    }
    $ordid = mysqli_insert_id($conn);

    $sql6 = "SELECT * FROM cart c, product p where c.product_id=p.product_id and customer_id='$userid'";
    $result6 = mysqli_query($conn, $sql6);

    while ($row6 = mysqli_fetch_assoc($result6)) {
        $pid = $row6['product_id'];
        $qty = $row6['quantity'];
        $sql7 = "INSERT INTO order_detail(order_id, product_id, quantity) VALUES ('$ordid','$pid','$qty')";
        if (!mysqli_query($conn, $sql7)) {
            echo "<script>alert('Something is wrong.')</script>";
        }
        $sql8 = "UPDATE product set product_stock = product_stock-'$qty' where product_id='$pid'";
        if (!mysqli_query($conn, $sql8)) {
            echo "<script>alert('Something is wrong.')</script>";
        }
    }
    $sql9 = "DELETE from cart where customer_id='$userid'";
    if (!mysqli_query($conn, $sql9)) {
        echo "<script>alert('Something is wrong.')</script>";
    }

    unset($_SESSION['provid'], $_SESSION['provname'], $_SESSION['cityid'], $_SESSION['cityname'], $_SESSION['courier'], $_SESSION['service'], $_SESSION['shipprice']);

    header("Location: order.php?id=".$ordid);
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
        <section class="breadcrumb-area" data-background="img/bg/page-title.png">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content" style="flex-direction: column;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                </ol>
                            </nav>
                            <h2 class="cart-title mt-40 mb-40">Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="checkout-area pb-70">
            <div class="container">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkbox-form">
                                <h3>Shipment Details</h3>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" name="firstname" value="<?php echo $first ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" name="lastname" value="<?php echo $last ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" name="phone" value="<?php echo $row3['customer_telp'] ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input type="text" name="address" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>City</label>
                                            <input type="text" value="<?php echo $city ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Province</label>
                                            <input type="text" value="<?php echo $prov ?>" disabled />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="your-order mb-30 ">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <?php echo $row['product_name']; ?> <strong class="product-quantity"> × <?php echo $row['quantity']; ?></strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">Rp. <?php echo number_format($row['product_price'] * $row['quantity']); ?></span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount red-color">Rp. <?php echo number_format($sumprice) ?></span></td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Shipping (<?php echo strtoupper($cour) ?> <?php echo $serv ?>)</th>
                                                <td><span class="amount red-color">Rp. <?php echo number_format($ship) ?></span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">Rp. <?php echo number_format($sumprice + $ship) ?></span></strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <h3 class="mt-5">Payment Method</h3>
                                <div class="payment-method">
                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="mb-0">
                                                    Bank Transfer
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <input required type="radio" name="payment" value="BCA" style="transform: scale(1.5); margin: 10px;">
                                                <label for="payment1">
                                                    <h6>BCA</h6>
                                                </label><br>
                                                <input required type="radio" name="payment" value="MANDIRI" style="transform: scale(1.5); margin: 10px;">
                                                <label for="payment2">
                                                    <h6>MANDIRI</h6>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment mt-20">
                                        <button name="placeorder" type="submit" class="btn theme-btn">Place order</button>
                                        <div class="or-divide"><span>or</span></div>
                                        <a href="cart.php" class="btn theme-btn-2 w-100">Back to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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