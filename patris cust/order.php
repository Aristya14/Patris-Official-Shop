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

// 

if (isset($_GET['id'])) {
    $orderid = $_GET['id'];
    $sql2 = "SELECT * from orders o where order_id = '$orderid'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    if ($row2['customer_id'] != $userid) {
        header("Location: order.php");
    }

    $sql = "SELECT * FROM payment py, product p, order_detail od, orders o WHERE py.payment_id=o.payment_id and p.product_id=od.product_id and od.order_id=o.order_id and o.order_id = '$orderid'";
    $result = mysqli_query($conn, $sql);
    $result3 = mysqli_query($conn, $sql);
    $row3 = mysqli_fetch_assoc($result3);

    if (isset($_POST['change'])) {
        $change = $_POST['payment'];
        $payid = $_POST['payid'];

        $sql4 = "UPDATE payment set payment_methode='$change' where payment_id = '$payid'";
        $result4 = mysqli_query($conn, $sql4);

        if ($result4) {
            header("Refresh:0");
        } else {
            echo "<script>alert('Something is wrong.')</script>";
        }
    }

    if (isset($_POST['upload']) && is_uploaded_file($_FILES['uploadimg']['tmp_name'])) {
        $file_tmp = $_FILES['uploadimg']['tmp_name'];
        $foto = file_get_contents($file_tmp);
        $payid = $_POST['payid'];

        $stmt = mysqli_prepare($conn, "UPDATE payment set payment_proof = ? where payment_id = '$payid'");
        mysqli_stmt_bind_param($stmt, "s", $foto,);
        $result5 = mysqli_stmt_execute($stmt);

        if ($result5) {
            header("Refresh:0");
        } else {
            echo "<script>alert('Something is wrong.')</script>";
        }
    }

    if (isset($_POST['received'])) {
        $date = date("Y-m-d");
        $sql6 = "UPDATE orders set order_status='Shipped', order_received='$date' where order_id = '$orderid'";
        if (!mysqli_query($conn, $sql6)) {
            echo "<script>alert('Something is wrong.')</script>";
        } else {
            header("Refresh:0");
        }
    }

    if (isset($_POST['review'])) {
        $pid = $_GET['pid'];
        $orderid = $_GET['id'];
        $rating = $_POST['rating'];
        $desc = $_POST['desc'];
        $sql7 = "INSERT INTO review(product_id, order_id, review_rating, review_desc) 
        VALUES ('$pid','$orderid','$rating','$desc')";
        if (!mysqli_query($conn, $sql7)) {
            echo "<script>alert('Something is wrong.')</script>";
        } else {
            header("Location: order.php?id=" .  $_GET['id']);
        }
    }

    $sql8 = "SELECT product_id from review where order_id = '$orderid'";
    $result8 = mysqli_query($conn, $sql8);
    if (!$result8) {
        echo "<script>alert('Something is wrong.')</script>";
    } else {
        $revpid=mysqli_fetch_all($result8, MYSQLI_NUM);
    }
} else {
    $sql = "SELECT * from orders o, payment p where o.payment_id=p.payment_id  and customer_id = '$userid'";
    $result = mysqli_query($conn, $sql);
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
    <div class="modal fade" id="uploadpayment">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload Payment</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="payid" value="<?php echo $row3['payment_id'] ?>">
                        <input type="file" name="uploadimg">
                    </div>
                    <div class="modal-footer">
                        <button name="upload" class="generic-btn red-hover-btn">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="changepayment">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Payment</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="payid" value="<?php echo $row3['payment_id'] ?>">
                        <input type="radio" name="payment" value="BCA" <?php if (!strcmp($row3['payment_methode'], "BCA")) echo 'checked'; ?>>
                        <label for="payment1">BCA</label><br>
                        <input type="radio" name="payment" value="MANDIRI" <?php if (!strcmp($row3['payment_methode'], "MANDIRI")) echo 'checked'; ?>>
                        <label for="payment2">MANDIRI</label>
                    </div>
                    <div class=" modal-footer">
                        <button name="change" class="generic-btn red-hover-btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmreceived">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Finish Order</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>By clicking continue, order status will be changed to Shipped and order will be finished.</p>
                        <p>Product guarantee is 3 days since received.</p>
                        <p>Any complain can be send through our WhatsApp on Contact Page.</p>
                    </div>
                    <div class="modal-footer">
                        <button name="received" class="generic-btn red-hover-btn">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" data-bs-backdrop="static" <?php if (isset($_GET['pid'])) {
                                                        echo 'style="display:block; background-color:white;"';
                                                    } ?>>
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Give Review for <?php echo $_GET['pname']; ?></h5>
                        <a href="order.php?id=<?php echo $_GET['id'] ?>"><button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button></a>
                    </div>
                    <div class="modal-body basic-login">
                        <label for="rating"><strong>Rating (1-5)</strong></label>
                        <input type="number" name="rating" min="1" max="5" value="5">
                        <label for="desc"><strong>Review</strong></label>
                        <textarea name="desc" cols="32" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button name="review" class="generic-btn red-hover-btn">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <main>
        <section class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content" style="flex-direction: column;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                                </ol>
                            </nav>
                            <?php if (isset($_GET['id'])) { ?>
                                <h2 class="login-title mt-40 mb-20">Order Id: <?php echo $orderid ?></h2>
                                <a href="order.php"><button class="generic-btn red-hover-btn">Back to My Orders</button></a>
                            <?php } else { ?>
                                <h2 class="login-title mt-40">My Orders</h2>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="login-area pt-50 pb-50">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if (isset($_GET['id'])) { ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6>Order Date: <span class="red-color"><?php echo $row3['order_date'] ?></span></h6>
                                    <h6>Order Status: <span class="red-color"><?php echo $row3['order_status'] ?></span></h6>
                                    <h6>Received Date: <span class="red-color"><?php echo $row3['order_received'] ?></span></h6>
                                    <h6>Shipment: <span class="red-color"><?php echo $row3['order_ship'] ?></span></h6>
                                    <h6>Receiver: <span class="red-color"><?php echo $row3['order_receiver'] ?></span></h6>
                                    <h6>Address: <span class="red-color"><?php echo $row3['order_address'] ?></span></h6>
                                </div>
                                <div class="col-lg-6">
                                    <h6>Payment Date: <span class="red-color"><?php echo $row3['payment_date'] ?></span></h6>
                                    <h6>Payment Status: <span class="red-color"><?php echo $row3['payment_status'] ?></span></h6>
                                    <h6>Payment Method: <span class="red-color"><?php echo $row3['payment_methode'] ?></span></h6>
                                    <br>
                                    <?php
                                    if (!strcmp($row3['order_status'], "On Shipping")) {
                                        echo '<button data-toggle="modal" data-target="#confirmreceived" class="generic-btn red-hover-btn">Order Received</button>';
                                    }
                                    if (!strcmp($row3['payment_status'], "Not Paid")) {
                                        echo '<h6>PAY TO BANK ACCOUNT BELOW (TRANSFER MISTAKE IS NOT OUR RESPONSIBILITY!!)</h6>';
                                        echo '<h6>Account Number: <span class="red-color">';
                                        if (!strcmp($row3['payment_methode'], "BCA")) {
                                            echo  "5485 1999 07";
                                        } else {
                                            echo  "16 5000 6000 997";
                                        }
                                        echo '</span></h6>';
                                        echo '<h6>Account Name: <span class="red-color">PT PATRIS DIGITAL UTAMA</span></h6>';
                                        echo '<br>';
                                        if ($row3['payment_proof']) {
                                            echo '<h6 class="red-color">Payment Proof Uploaded</h6>';
                                        }
                                        echo '<button data-toggle="modal" data-target="#uploadpayment" class="generic-btn red-hover-btn mr-5">Upload Payment</button>';
                                        echo '<button data-toggle="modal" data-target="#changepayment" class="generic-btn red-hover-btn">Change Payment</button>';
                                    } ?>
                                </div>
                            </div>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th>Product</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td class="product-desc">
                                                    <a href="single-product.php?id=<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></a>
                                                    <?php if (!strcmp($row3['order_status'], "Shipped") && !in_array($row['product_id'], $revpid[0])) {
                                                        echo '<br><a href="order.php?id=' . $row['order_id'] . '&pid=' . $row['product_id'] . '&pname=' . $row['product_name'] . '"><button class="red-hover-btn">Give Review</button></a>';
                                                    } ?>
                                                </td>
                                                <td><?php echo $row['product_size'] ?></td>

                                                <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                                                <td><?php echo $row['quantity'] ?></td>
                                                <td>Rp. <?php echo number_format($row['product_price'] * $row['quantity']) ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th>Total Price</th>
                                            <th>Rp. <?php echo number_format($row3['order_cost']) ?></th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th>Shipment Cost</th>
                                            <th>Rp. <?php echo number_format($row3['order_shipcost']) ?></th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <th class="red-color">Total Payment</th>
                                            <th class="red-color">Rp. <?php echo number_format($row3['order_total']) ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Id</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                            <th>Shipment</th>
                                            <th>Payment Method</th>
                                            <th>Payment Date</th>
                                            <th>Payment Status</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $row['order_id'] ?></td>
                                                <td><?php echo $row['order_date'] ?></td>
                                                <td class="red-color"><?php echo $row['order_status'] ?></td>
                                                <td><?php echo $row['order_ship'] ?></td>
                                                <td><?php echo $row['payment_methode'] ?></td>
                                                <td><?php echo $row['payment_date'] ?></td>
                                                <td class="red-color"><?php echo $row['payment_status'] ?></td>
                                                <td class="red-color">Rp. <?php echo number_format($row['order_total']) ?></td>
                                                <td><a href="order.php?id=<?php echo $row['order_id'] ?>"><button class="generic-btn red-hover-btn">Order Details</button></a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
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