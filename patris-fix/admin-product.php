<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin-login.php");
}

if (isset($_POST['submit'])) {
    $id = $_POST['removeid'];

    $del = mysqli_query($conn, "delete from product where product_id = '$id'");

    if ($del) {
        mysqli_close($conn);
        header("location: admin-product.php");
        exit;
    } else {
        echo "<script>alert('Something is wrong.')</script>";
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
                <li class="active">
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
                    <div class="text-center">
                        <h2 class="card-title">List Products</h2>
                        <h6 class="card-category">All Products in Patris Official Shop</h6>
                    </div>
                    <div class="text-right">
                        <a href="admin-productadd.php" class="btn btn-danger">Add Product</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead style="background-color:#F0628C;">
                            <tr class="text-white text-center">
                                <th>ID</th>
                                <th>Nama Product</th>
                                <th>Gambar</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Rating</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT p.product_id as ID,p.product_name as nama, p.product_image as foto, p.product_stock as stock, p.product_category as category, p.product_price as price, IfNULL((avg(r.review_rating)),0) as rating FROM review r 
                                        right JOIN  product p on p.product_id=r.product_id GROUP by p.product_id;";
                            $query = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $data['ID']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo '<img src="data:image/jpeg;base64,' . base64_encode($data['foto']) . '"width="150px" alt="">' ?></td>
                                    <td><?php echo $data['stock']; ?></td>
                                    <td><?php echo $data['category']; ?></td>
                                    <td><?php echo $data['price']; ?></td>
                                    <td><?php echo number_format($data['rating'], 1) ?></td>
                                    <td class="text-center">
                                        <a href="admin-productedit.php?id=<?php echo $data['ID']; ?>" class="btn btn-sm btn-danger">Edit</a>
                                        <form method="POST">
                                            <br>
                                            <input type="hidden" name="removeid" value="<?php echo $data['ID']; ?>">
                                            <button name="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
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