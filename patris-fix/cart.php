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
$sql = "SELECT * FROM cart c, product p where c.product_id=p.product_id and customer_id='$userid'";
$result = mysqli_query($conn, $sql);
$num = $result->num_rows;

if ($num) {
    $sql2 = "SELECT sum(c.quantity*p.product_price) as sumprice FROM cart c, product p where c.product_id=p.product_id and customer_id='$userid'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
}

if (isset($_POST['deletecart'])) {
    $pid = $_POST['pid'];

    $sql3 = "DELETE FROM cart where customer_id = '$userid' and product_id = '$pid'";
    $result3 = mysqli_query($conn, $sql3);
    if ($result3) {
        header("Location: cart.php");
    } else {
        echo "<script>alert('Something is wrong.')</script>";
    }
}

if (isset($_POST['updateqty'])) {
    $qty = $_POST['updateqty'];
    $pid2 = $_POST['pid2'];
    $stock = $_POST['stock'];
    $pname = $_POST['pname'];

    if ($qty > $stock) {
        echo "<script>alert('" . $pname . " only have " . $stock . " on stock')</script>";
    } else {

        $sql4 = "UPDATE cart set quantity = '$qty' where customer_id = '$userid' and product_id = '$pid2'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4) {
            header("Location: cart.php");
        } else {
            echo "<script>alert('Something is wrong.')</script>";
        }
    }
}

if (isset($_POST['updateprov'])) {
    $prov = explode('|', $_POST['updateprov']);
    $provid = $prov[0];
    $provname = $prov[1];
    $_SESSION['provid'] = $provid;
    $_SESSION['provname'] = $provname;
}

if (isset($_POST['updatecity'])) {
    $city = explode('|', $_POST['updatecity']);
    $cityid = $city[0];
    $cityname = $city[1];
    $_SESSION['cityid'] = $cityid;
    $_SESSION['cityname'] = $cityname;
}

if (isset($_POST['ship'])) {
    $ship = $_POST['ship'];
    $cour = $_POST['cour'];
    $serv = $_POST['serv'];
    $_SESSION['courier'] = $cour;
    $_SESSION['service'] = $serv;
    $_SESSION['shipprice'] = $ship;
}

if (isset($_POST['proceed'])) {
    if ($_SESSION['shipprice']) {
        $sql5 = "SELECT * from product p, cart c where c.product_id=p.product_id and customer_id='$userid' and c.quantity>p.product_stock";
        $result5 = mysqli_query($conn, $sql5);
        if ($result5->num_rows) {
            while ($row5 = mysqli_fetch_assoc($result5)){
                echo "<script>alert('" . $row5['product_name'] . " only have " . $row5['product_stock'] . " on stock')</script>";
            }
        } else {
            header("Location: checkout.php");
        }
    } else {
        echo "<script>alert('Please Choose Shipping First !!')</script>";
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
    <section class="cart-body mb-90 gray-border-top pt-35">
        <div class="has-breadcrumb-content">
            <div class="container container-1430">
                <div class="breadcrumb-content" style="flex-direction: column;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 m-0">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                    <h2 class="cart-title mt-40 mb-40"><?php if ($num) {
                                                            echo "Cart";
                                                        } else {
                                                            echo "You have no items in your cart";
                                                        } ?></h2>
                </div>
                <?php if ($num) { ?>
                    <div class="cart-body-content">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="product-content">
                                    <div class="table-responsive">
                                        <table class="table table-2">
                                            <thead>
                                                <tr>
                                                    <th class="remove-porduct"></th>
                                                    <th class="product-image"></th>
                                                    <th class="product-title">Product</th>
                                                    <th>Price</th>
                                                    <th class="quantity">Quantity</th>
                                                    <th class="total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td>
                                                            <div class="table-data">
                                                                <form method="POST">
                                                                    <input id="pid" name="pid" type="hidden" value="<?php echo $row['product_id']; ?>">
                                                                    <button name="deletecart" class="close-btn"><i class="fal fa-times"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="table-data">
                                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['product_image']); ?>" width="80" alt="">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="table-data product-desc">
                                                                <h6><a href="single-product.php?id=<?php echo $row['product_id']; ?>" class="title"><?php echo $row['product_name']; ?></a>
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="table-data">
                                                                <span class="price">Rp.
                                                                    <?php echo number_format($row['product_price']); ?></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="table-data">
                                                                <form method="POST">
                                                                    <input id="pname" name="pname" type="hidden" value="<?php echo $row['product_name']; ?>">
                                                                    <input id="stock" name="stock" type="hidden" value="<?php echo $row['product_stock']; ?>">
                                                                    <input id="pid2" name="pid2" type="hidden" value="<?php echo $row['product_id']; ?>">
                                                                    <input name="updateqty" onchange="this.form.submit()" type="number" value="<?php echo $row['quantity']; ?>" min="1" max="<?php echo $row['product_stock']; ?>" style="margin-right: 20px; width: 119px;">
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="table-data">
                                                                <span class="total">Rp.
                                                                    <?php echo number_format($row['product_price'] * $row['quantity']); ?></span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="cart-widget">
                                    <h4 class="title">Cart Totals</h4>

                                    <table class="table table-2">
                                        <tbody>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>Rp. <?php echo number_format($row2['sumprice']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>
                                                    <div>
                                                        <label class="control-label">Total Weights</label>
                                                        <div class="form-group">
                                                            <?php echo $rowsumq['sumquantity'] * 500; ?> Grams
                                                        </div>
                                                        <label class="control-label">Province</label>
                                                        <div class="form-group">
                                                            <form method="post">
                                                                <select name="updateprov" onchange="this.form.submit()" class="form-control" required>
                                                                    <option value="<?php echo $_SESSION['provname']; ?>">
                                                                        <?php echo $_SESSION['provname']; ?></option>
                                                                    <?php
                                                                    $curl = curl_init();
                                                                    curl_setopt_array($curl, array(
                                                                        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
                                                                        CURLOPT_RETURNTRANSFER => true,
                                                                        CURLOPT_ENCODING => "",
                                                                        CURLOPT_MAXREDIRS => 10,
                                                                        CURLOPT_TIMEOUT => 30,
                                                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                        CURLOPT_CUSTOMREQUEST => "GET",
                                                                        CURLOPT_HTTPHEADER => array(
                                                                            "key: 33b4623ebaec869103303a234d1a6ddb"
                                                                        ),
                                                                    ));
                                                                    $response = curl_exec($curl);
                                                                    $err = curl_error($curl);
                                                                    curl_close($curl);
                                                                    $datap = json_decode($response, true);

                                                                    foreach ($datap['rajaongkir']['results'] as $datap1) {
                                                                        echo "<option value='" . $datap1['province_id'] . "|" . $datap1['province'] . "'>" . $datap1['province'] . "</option>";
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </form>
                                                        </div>
                                                        <label class="control-label">City</label>
                                                        <div class="form-group">
                                                            <form method="post">
                                                                <select name="updatecity" onchange="this.form.submit()" class="form-control" required>
                                                                    <option value="<?php echo $_SESSION['cityname']; ?>">
                                                                        <?php echo $_SESSION['cityname']; ?></option>
                                                                    <?php
                                                                    if (isset($_SESSION['provid'])) {
                                                                        $curl = curl_init();
                                                                        curl_setopt_array($curl, array(
                                                                            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=" . $_SESSION['provid'] . "",
                                                                            CURLOPT_RETURNTRANSFER => true,
                                                                            CURLOPT_ENCODING => "",
                                                                            CURLOPT_MAXREDIRS => 10,
                                                                            CURLOPT_TIMEOUT => 30,
                                                                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                            CURLOPT_CUSTOMREQUEST => "GET",
                                                                            CURLOPT_HTTPHEADER => array(
                                                                                "key: 33b4623ebaec869103303a234d1a6ddb"
                                                                            ),
                                                                        ));
                                                                        $response = curl_exec($curl);
                                                                        $err = curl_error($curl);
                                                                        curl_close($curl);
                                                                        $datac = json_decode($response, true);

                                                                        foreach ($datac['rajaongkir']['results'] as $datac1) {
                                                                            echo "<option value='" . $datac1['city_id'] . "|" . $datac1['city_name'] . "'>" . $datac1['city_name'] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <?php
                                                        if (isset($_SESSION['cityid'])) {
                                                            $curl = curl_init();

                                                            curl_setopt_array($curl, array(
                                                                CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
                                                                CURLOPT_RETURNTRANSFER => true,
                                                                CURLOPT_ENCODING => "",
                                                                CURLOPT_MAXREDIRS => 10,
                                                                CURLOPT_TIMEOUT => 30,
                                                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                CURLOPT_CUSTOMREQUEST => "POST",
                                                                CURLOPT_POSTFIELDS => "origin=133&destination=" . $_SESSION['cityid'] . "&weight=" . $rowsumq['sumquantity'] * 500 . "&courier=jne",
                                                                CURLOPT_HTTPHEADER => array(
                                                                    "content-type: application/x-www-form-urlencoded",
                                                                    "key: 33b4623ebaec869103303a234d1a6ddb"
                                                                ),
                                                            ));

                                                            $response = curl_exec($curl);
                                                            $err = curl_error($curl);
                                                            curl_close($curl);
                                                            $jne = json_decode($response, true);
                                                            $datao = $jne['rajaongkir']['results'][0]['costs'];

                                                        ?>
                                                            <table>
                                                                <tbody>
                                                                    <form method="post">
                                                                        <?php
                                                                        foreach ($datao as $val1) {
                                                                            echo "<tr>";
                                                                            echo "<td> <input name='cour' type='hidden' value='" . strtoupper($jne['rajaongkir']['results'][0]['code']) . "'>" . strtoupper($jne['rajaongkir']['results'][0]['code']) . "</td>";
                                                                            echo "<td> <input name='serv' type='hidden' value='" . $val1['service'] . "'>" . $val1['service'] . "</td>";

                                                                            foreach ($val1['cost'] as $val2) {
                                                                                echo "<td align='right'>Rp " . number_format($val2['value']) . "</td>";
                                                                                echo "<td>" . $val2['etd'] . " Days</td>";
                                                                                if ($_SESSION['shipprice'] == $val2['value']) {
                                                                                    echo "<td><input type='radio' name='ship' onchange='this.form.submit()' value='" . $val2['value'] . "' checked></td>";
                                                                                } else {
                                                                                    echo "<td><input type='radio' name='ship' onchange='this.form.submit()' value='" . $val2['value'] . "' ></td>";
                                                                                }
                                                                            }

                                                                            echo "</tr>";
                                                                        }
                                                                        ?>
                                                                    </form>
                                                                </tbody>
                                                            </table>
                                                        <?php } else {
                                                            echo "Please select province and city";
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td><strong class="red-color">Rp.
                                                        <?php echo number_format($row2['sumprice'] + $_SESSION['shipprice']) ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <form method="post">
                                        <button name="proceed" class="mt-40 generic-btn red-hover-btn w-100 d-block text-uppercase">Proceed to
                                            checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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