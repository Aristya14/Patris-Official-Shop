<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin-login.php");
}

if (!isset($_GET['id'])) {
    header('Location: admin-product.php');
} else {
    $id = $_GET['id'];

    $sql = "SELECT * FROM product WHERE product_id=$id";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) != 1) {
        echo "<script>alert('Something is wrong.')</script>";
    }
}


if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $nama = $_POST['product_name'];
    $deskripsi = $_POST['product_desc'];
    $stock = $_POST['product_stock'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $size = $_POST['product_size'];

    if (is_uploaded_file($_FILES['product_image']['tmp_name'])) {
        $file_tmp = $_FILES['product_image']['tmp_name'];
        $foto = file_get_contents($file_tmp);

        $stmt = mysqli_prepare($conn, "UPDATE product SET 
        product_name= ? ,product_image= ? ,product_desc= ? ,product_stock= ? ,
        product_category= ? ,product_price= ? ,product_size= ? 
        where product_id='$id'");

        mysqli_stmt_bind_param($stmt, "sssssss", $nama, $foto, $deskripsi, $stock, $category, $price, $size);
        if (!mysqli_stmt_execute($stmt))
            echo "<script>alert('Something is wrong.')</script>";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE product SET 
        product_name= ? ,product_desc= ? ,product_stock= ? ,
        product_category= ? ,product_price= ? ,product_size= ? 
        where product_id='$id'");

        mysqli_stmt_bind_param($stmt, "ssssss", $nama, $deskripsi, $stock, $category, $price, $size);
        if (!mysqli_stmt_execute($stmt))
            echo "<script>alert('Something is wrong.')</script>";
    }
    header("location: admin-product.php");
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
                    <h2 class="card-title">Edit Product</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-5">
                                    <label for="product_name">
                                        <h5 class="font-weight-bold text-dark m-0">Product Name</h5>
                                    </label>
                                    <input type="text" name="product_name" value="<?php echo $data['product_name'] ?>" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_image">
                                        <h5 class="font-weight-bold text-dark m-0">Product Image</h5>
                                    </label>
                                    <input type="file" name="product_image" class="form-control-file" />
                                </div>
                                <div class="mb-5">
                                    <label for="product_desc">
                                        <h5 class="font-weight-bold text-dark m-0">Description</h5>
                                    </label>
                                    <input type="text" name="product_desc" value="<?php echo $data['product_desc'] ?>" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_stock">
                                        <h5 class="font-weight-bold text-dark m-0">Stock Product</h5>
                                    </label>
                                    <input type="text" name="product_stock" value="<?php echo $data['product_stock'] ?>" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-5">
                                    <label for="product_category">
                                        <h5 class="font-weight-bold text-dark m-0">Category</h5>
                                    </label>
                                    <select name="product_category" class="form-control" required>
                                        <?php
                                        $sql2 = "SELECT * FROM category";
                                        $query2 = mysqli_query($conn, $sql2);
                                        while ($data2 = mysqli_fetch_assoc($query2)) {
                                            if ($data['product_category'] == $data2['category_id'])
                                                echo '<option value="' . $data2['category_id'] . '" selected>' . $data2['category_name'] . '</option>';
                                            else
                                                echo '<option value="' . $data2['category_id'] . '">' . $data2['category_name'] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="mb-5">
                                    <label for="product_price">
                                        <h5 class="font-weight-bold text-dark m-0">Price (Rupiah)</h5>
                                    </label>
                                    <input type="text" name="product_price" value="<?php echo $data['product_price'] ?>" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <label for="product_size">
                                        <h5 class="font-weight-bold text-dark m-0">Size</h5>
                                    </label>
                                    <input type="text" name="product_size" value="<?php echo $data['product_size'] ?>" class="form-control" required />
                                </div>
                                <div class="mb-5">
                                    <button name="submit" class="btn btn-danger w-100">Edit Product</button>
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