<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php

include("connect.php");
session_start();
// kalau tidak ada id di query string
if (!isset($_GET['id'])) {
    header('Location: productAdmin.php');
}

//ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM product WHERE product_id=$id";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Patris Official Shop Admin
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="produk/logo.png">
    <style>
        .dashboard-color {
            background-color: coral;
        }

        input[type=submit] {
            font-family: sans-serif;
            font-size: 15px;
            background: #F0628C;
            color: white;
            border: #F0628C 3px solid;
            border-radius: 5px;
            padding: 12px 20px;
            margin-top: 10px;
        }

        .tombol {
            margin-top: 60px;
            margin-bottom: 30px;
            margin-right: 20px;
            text-align: right;
        }

        input[type=submit]:hover {
            opacity: 0.9;
        }

        .addproduct {
            margin-top: 80px;
        }

        .logokecil {
            width: auto;
        }

        .judul {
            font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
            text-transform: capitalize;
            font-size: 20px;
        }
    </style>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="demo/demo.css" rel="stylesheet" />
    <link href="css/css.css" rel="stylesheet" />
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

<body class="">
    <div class="wrapper">
        <div class="sidebar dashboard-color" data-color="white" data-active-color="danger">
            <div class="logo">
                <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                    <div class="">
                        <img src="produk/logo.png">
                    </div>
                </a>
                <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                    Dashboard
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="./dashboard.php">
                            <i>
                                <img src="https://img.icons8.com/material-outlined/24/fa314a/dashboard-layout.png" /></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="./icons.php">
                            <i><img src="https://img.icons8.com/ios-filled/50/fa314a/women-shoe-side-view.png" /></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map.php">
                            <i><img src="https://img.icons8.com/ios-filled/50/fa314a/order-history.png" /></i>
                            <p>Pesanan</p>
                        </a>
                    </li>
                    <li>
                        <a href="./notifications.php">
                            <i>
                                <img src="https://img.icons8.com/external-bearicons-glyph-bearicons/64/fa314a/external-positive-review-reputation-bearicons-glyph-bearicons.png" />
                            </i>
                            <p>Ulasan</p>
                        </a>
                    </li>
                    <li>
                        <a href="./tables.php">
                            <i><img src="https://img.icons8.com/ios-filled/64/fa314a/combo-chart.png" /></i>
                            <p>Statistik Penjualan</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="judul" href="javascript:;">Patris Official Shop ~ Admin</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li>
                                <a href="javascript:;">
                                    <img src="https://img.icons8.com/ios-glyphs/40/fa314a/test-account.png" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <section class="checkout-area pb-70">
                <div class="container">
                    <form action="proses-editproduct.php" method="POST">
                        <fieldset>
                            <input type="hidden" name="product_id" value="<?php echo $data['product_id'] ?>" />

                            <div class="row addproduct">
                                <div class="col-lg-6">
                                    <!-- <div class="checkbox-form"> -->
                                    <h3>Edit Data Product</h3>
                                    <!-- <div class="row"> -->
                                    <div class="col-md-12">
                                        <div class="checkout-form-list" style="padding-top:10px;">
                                            <label for="product_name">Product Name <span class="required">*</span></label>
                                            <input type="text" name="product_name" value="<?php echo $data['product_name'] ?>" />
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label for="product_image">Product Image</label>
                                            <input type="file" name="product_image" value="<?php //echo $data['product_image'] 
                                                                                            ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label for="product_desc">Description <span class="required">*</span></label>
                                            <textarea type="text" rows="4" cols="59" name="product_desc"><?php echo $data['product_desc'] ?> </textarea>
                                        </div>
                                    </div>


                                    <!-- </div> -->

                                    <!-- </div> -->
                                </div>
                                <div class="col-lg-6">
                                    <!-- <div class="your-order mb-30 "> -->
                                    <!-- <div class="your-order-table table-responsive"> -->
                                    <div class="col-md-12">
                                        <div class="checkout-form-list" style="padding-top:70px;">
                                            <label for="product_stock">Stock Product <span class="required">*</span></label>
                                            <input type="text" name="product_stock" value="<?php echo $data['product_stock'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label for="product_category">Category <span class="required">*</span></label>
                                            <input type="text" name="product_category" value="<?php echo $data['product_category'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label for="product_price">Price (Rupiah) <span class="required">*</span></label>
                                            <input type="text" name="product_price" value="<?php echo $data['product_price'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label for="product_size">Size <span class="required">*</span></label>
                                            <input type="text" name="product_size" value="<?php echo $data['product_size'] ?>" />
                                        </div>
                                    </div>

                                    <!-- </div> -->
                                    <div class="order-button-payment" style="padding-top:100px;">
                                        <input type="submit" value="simpan" name="simpan" class="btn theme-btn" />
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                </div>
                </fieldset>
                </form>
        </div>
        </section>


    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="../assets/demo/demo.js"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
</body>

</html>