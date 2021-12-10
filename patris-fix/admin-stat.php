<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin-login.php");
}

$order_cost = mysqli_query($conn, "select order_cost from orders where order_status='Shipped'");
$order_date = mysqli_query($conn, "select order_date from orders where order_status='Shipped'");

$sql = "SELECT*from product";
$query = mysqli_query($conn, $sql);

$sql2 = "SELECT*from orders";
$query2 = mysqli_query($conn, $sql2);

$sql3 = "SELECT*from customer";
$query3 = mysqli_query($conn, $sql3);

$sql4 = "SELECT avg(review_rating) as rate from review";
$query4 = mysqli_query($conn, $sql4);
$result = mysqli_fetch_array($query4)

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="img/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Patris Official Shop Admin</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/admin-style.css" rel="stylesheet" />
</head>

<body>
    <div class="sidebar" data-color="white" data-active-color="danger">
        <div class="logo">
            <a href="admin-dash.php" class="simple-text logo-mini">
                <div class="logo-image-small">
                    <img src="img/logo.png" width="100%">
                </div>
            </a>
            <a href="admin-dash.php" class="simple-text">Dashboard</a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="text-center">
                    <a>Hello, <?php echo $_SESSION['adminname'] ?></a>
                </li>
                <li>
                    <a href="admin-dash.php">
                        <i><img src="https://img.icons8.com/material-outlined/24/fa314a/dashboard-layout.png" /></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="admin-product.php">
                        <i><img src="https://img.icons8.com/ios-filled/50/fa314a/women-shoe-side-view.png" /></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li>
                    <a href="admin-order.php">
                        <i><img src="https://img.icons8.com/ios-filled/50/fa314a/order-history.png" /></i>
                        <p>Pesanan</p>
                    </a>
                </li>
                <li>
                    <a href="admin-review.php">
                        <i><img src="https://img.icons8.com/external-bearicons-glyph-bearicons/64/fa314a/external-positive-review-reputation-bearicons-glyph-bearicons.png" /></i>
                        <p>Ulasan</p>
                    </a>
                </li>
                <li class="active">
                    <a href="admin-stat.php">
                        <i><img src="https://img.icons8.com/ios-filled/64/fa314a/combo-chart.png" /></i>
                        <p>Statistik Penjualan</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand font-weight-bold">Patris Official Shop ~ Admin</a>
                </div>
                <div class="navbar-wrapper justify-content-end">
                    <a class="navbar-brand" href="logout.php"><button class="btn btn-sm btn-danger">Log Out</button></a>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="row">
                <div class="col-3">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <img src="https://img.icons8.com/ios-filled/50/000000/new-product.png" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Products</p>
                                        <p><?php echo mysqli_num_rows($query) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <img src="https://img.icons8.com/ios-filled/50/000000/shopaholic.png" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Orders</p>
                                        <p><?php echo mysqli_num_rows($query2) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <img src="https://img.icons8.com/external-glyph-geotatah/50/000000/external-buyer-cashless-society-glyph-glyph-geotatah.png" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Cust Accounts</p>
                                        <p><?php echo mysqli_num_rows($query3) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/50/000000/external-rating-support-vitaliy-gorbachev-fill-vitaly-gorbachev.png" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="numbers">
                                        <p class="card-category">Products Rating</p>
                                        <p><?php echo number_format($result['rate'], 1) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="card-title">Statistik Penjualan</h2>
                </div>
                <div class="card-body ">
                    <canvas id="LineChart" width="350" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chartjs.min.js"></script>
    <script src="js/admin.js" type="text/javascript"></script>
    <script>
        var ctx = document.getElementById("LineChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php while ($b = mysqli_fetch_array($order_date)) {
                                echo '"' . $b['order_date'] . '",';
                            } ?>],
                datasets: [{
                    label: 'Penjualan',
                    data: [<?php while ($p = mysqli_fetch_array($order_cost)) {
                                echo '"' . $p['order_cost'] . '",';
                            } ?>],
                    backgroundColor: [
                        'rgba(240, 98, 140, 0.2)'
                    ],
                    borderColor: [
                        'rgba(240, 98, 140, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>