<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin-login.php");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['product_name'];
    $foto = $_POST['product_image'];
    $deskripsi = $_POST['product_desc'];
    $stock = $_POST['product_stock'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $size = $_POST['product_size'];

    $sql = "INSERT INTO product (product_name, product_image, product_desc, product_stock, product_category, product_price, product_size)
        VALUE ('$nama', '$foto', '$deskripsi', '$stock', '$category', '$price', '$size')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: admin-product.php');
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
                <div class="card-header text-center">
                    <h2 class="card-title">Add Product</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-5">
                                    <label for="product_name">
                                        <h5 class="font-weight-bold text-dark m-0">Product Name</h5>
                                    </label>
                                    <input type="text" name="product_name" placeholder="Name" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_image">
                                        <h5 class="font-weight-bold text-dark m-0">Product Image</h5>
                                    </label>
                                    <input type="file" name="product_image" class="form-control-file" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_desc">
                                        <h5 class="font-weight-bold text-dark m-0">Description</h5>
                                    </label>
                                    <input type="text" name="product_desc" placeholder="Description" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_stock">
                                        <h5 class="font-weight-bold text-dark m-0">Stock Product</h5>
                                    </label>
                                    <input type="text" name="product_stock" placeholder="Stock" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-5">
                                    <label for="product_category">
                                        <h5 class="font-weight-bold text-dark m-0">Category</h5>
                                    </label>
                                    <select name="product_category" class="form-control" required>
                                        <?php
                                        $sql = "SELECT * FROM category";
                                        $query = mysqli_query($conn, $sql);
                                        while ($data = mysqli_fetch_assoc($query))
                                            echo '<option value="' . $data['category_id'] . '">' . $data['category_name'] . '</option>';
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-5">
                                    <label for="product_price">
                                        <h5 class="font-weight-bold text-dark m-0">Price (Rupiah)</h5>
                                    </label>
                                    <input type="text" name="product_price" placeholder="Price" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_size">
                                        <h5 class="font-weight-bold text-dark m-0">Size</h5>
                                    </label>
                                    <input type="text" name="product_size" placeholder="Size" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <button name="submit" class="btn btn-danger w-100">Add Product</button>
                                </div>
                            </div>
                        </div>
                    </form>
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