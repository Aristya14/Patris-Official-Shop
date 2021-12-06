<?php
include 'connect.php';

if (isset($_POST['simpan'])) {
    $id = $_POST['product_id'];
    $nama = $_POST['product_name'];
    // $foto = $_POST['product_image'];
    $deskripsi = $_POST['product_desc'];
    $stock = $_POST['product_stock'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $size = $_POST['product_size'];
    $file_tmp = $_FILES['product_image']['tmp_name'];
    $foto = file_get_contents($file_tmp);
    echo $foto;
    echo '<img src="data:image/png;base64,' . base64_encode($foto) . '" alt="">';

    // query SQL untuk insert data
    $stmt = mysqli_prepare($conn, "UPDATE product SET 
    product_name= ? ,product_image= ? ,product_desc= ? ,product_stock= ? ,
    product_category= ? ,product_price= ? ,product_size= ? 
    where product_id='$id'");

    mysqli_stmt_bind_param($stmt, "sssssss", $nama, $foto, $deskripsi, $stock, $category, $price, $size);
    mysqli_stmt_execute($stmt);

    // mengalihkan ke halaman index.php
    header("location:productAdmin.php");
}
