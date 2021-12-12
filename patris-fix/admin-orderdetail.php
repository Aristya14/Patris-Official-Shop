<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin-login.php");
}

$id = $_GET['id'];

$sql = "SELECT * FROM orders o, payment p WHERE p.payment_id=o.payment_id and order_id=$id";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);

$sql2 = "SELECT * FROM order_detail od, product p WHERE od.product_id=p.product_id and order_id=$id";
$query2 = mysqli_query($conn, $sql2);

if (isset($_POST['invalid'])) {
    $pid = $_POST['pid'];
    $sql3 = "UPDATE payment set payment_proof=NULL where payment_id = '$pid'";
    if (!mysqli_query($conn, $sql3)) {
        echo "<script>alert('Something is wrong.')</script>";
    } else {
        header("Refresh:0");
    }
}

if (isset($_POST['confirm'])) {
    $date = date("Y-m-d");
    $pid = $_POST['pid'];
    $sql3 = "UPDATE orders set order_status='On Packing' where order_id = '$id'";
    if (!mysqli_query($conn, $sql3)) {
        echo "<script>alert('Something is wrong.')</script>";
    } else {
        $sql4 = "UPDATE payment set payment_status='Paid', payment_date='$date' where payment_id = '$pid'";
        if (!mysqli_query($conn, $sql4)) {
            echo "<script>alert('Something is wrong.')</script>";
        } else {
            header("Refresh:0");
        }
    }
}

if (isset($_POST['confirmship'])) {
    $pid = $_POST['pid'];
    $tracking = $_POST['tracking'];
    $sql3 = "UPDATE orders set order_status='On Shipping', order_tracking='$tracking' where order_id = '$id'";
    if (!mysqli_query($conn, $sql3)) {
        echo "<script>alert('Something is wrong.')</script>";
    } else {
        header("Refresh:0");
    }
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
    <div class="modal fade" id="confirmreceived">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['payment_proof']) ?>" class="w-100" alt="">
                </div>
                <div class="modal-footer">
                    <form method="POST">
                        <input type="hidden" name="pid" value="<?php echo $row['payment_id'] ?>">
                        <button name="invalid" class="btn btn-secondary">Payment Invalid</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="pid" value="<?php echo $row['payment_id'] ?>">
                        <button name="confirm" class="btn btn-danger">Confirm Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmshipping">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Shipping Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="pid" value="<?php echo $row['payment_id'] ?>">
                        <label for="tracking">Shipping Number:</label>
                        <input class="form-control" type="text" placeholder="Input Shipping Number" name="tracking" required>
                    </div>
                    <div class="modal-footer">
                        <button name="confirmship" class="btn btn-danger">Confirm Shipping</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                <div class="card-header">
                    <h2 class="card-title text-center">Order Detail ID = <?php echo $row['order_id'] ?></h2>
                </div>
                <div class="card-body">
                    <a href="admin-order.php" class="btn btn-danger">Back To Orders</a><br>
                    <?php if (!$row['payment_date'] && $row['payment_proof']) { ?>
                        <a href="" data-toggle="modal" data-target="#confirmreceived" class="btn btn-danger text-right">Confirm Payment</a><br>
                    <?php } else if (!strcmp($row['order_status'], "On Packing")) { ?>
                        <a href="" data-toggle="modal" data-target="#confirmshipping" class="btn btn-danger text-right">Confirm Shipping</a><br>
                    <?php } ?>
                    <div class="row px-3">
                        <table class="table table-bordered w-50">
                            <tbody>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Penerima</th>
                                    <td><?php echo $row['order_receiver'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Provinsi</th>
                                    <td><?php echo $row['order_province'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Kota</th>
                                    <td><?php echo $row['order_city'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Alamat</th>
                                    <td><?php echo $row['order_address'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Tanggal Order</th>
                                    <td><?php echo $row['order_date'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Status Order</th>
                                    <td><?php echo $row['order_status'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Diterima</th>
                                    <td><?php echo $row['order_received'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered w-50">
                            <tbody>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Pembayaran</th>
                                    <td><?php echo $row['payment_methode'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Status</th>
                                    <td><?php echo $row['payment_status'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Tanggal</th>
                                    <td><?php echo $row['payment_date'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Pengiriman</th>
                                    <td><?php echo $row['order_ship'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">No Resi</th>
                                    <td><?php echo $row['order_tracking'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Ongkos Kirim</th>
                                    <td><?php echo $row['order_shipcost'] ?></td>
                                </tr>
                                <tr>
                                    <th class="text-white w-25" style="background-color:#F0628C;">Total Bayar</th>
                                    <td><?php echo $row['order_total'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-bordered">
                        <thead style="background-color:#F0628C;">
                            <tr class="text-white text-center">
                                <th>ID Product</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row2 = mysqli_fetch_assoc($query2)) { ?>
                                <tr>
                                    <td><?php echo $row2['product_id'] ?></td>
                                    <td><?php echo $row2['product_name'] ?></td>
                                    <td><?php echo $row2['product_size'] ?></td>
                                    <td><?php echo $row2['product_price'] ?></td>
                                    <td><?php echo $row2['quantity'] ?></td>
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