<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin-login.php");
}

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
                <li class="active">
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
                <li>
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
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="card-title">List Orders</h2>
                    <h6 class="card-category">All Orders in Patris Official Shop</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead style="background-color:#F0628C;">
                            <tr class="text-white text-center">
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Tanggal Order</th>
                                <th>Status Order</th>
                                <th>Tanggal Diterima</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * from orders o, customer c, payment p where o.customer_id=c.customer_id and o.payment_id=p.payment_id;";
                            $query = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($query)) { ?>
                                <td><?php echo $data['order_id']; ?></td>
                                <td><?php echo $data['customer_name']; ?></td>
                                <td><?php echo $data['order_date']; ?></td>
                                <td><?php echo $data['order_status'] ?></td>
                                <td><?php echo $data['order_received']; ?></td>
                                <td><?php echo $data['payment_date']; ?></td>
                                <?php if (!$data['payment_date'] && $data['payment_proof']) { ?>
                                    <td class="text-danger text-center">Payment Proof Uploaded.<br>Please Confirm!!</td>
                                <?php } else { ?>
                                    <td><?php echo $data['payment_status']; ?></td>
                                <?php } ?>
                                <td class="text-center"><a href="admin-orderdetail.php?id=<?php echo $data['order_id']; ?>" class="btn btn-sm btn-danger">Detail</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chartjs.min.js"></script>
    <script src="js/admin.js" type="text/javascript"></script>
</body>

</html>