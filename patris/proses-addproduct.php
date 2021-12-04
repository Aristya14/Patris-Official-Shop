<?php

include("connect.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $nama = $_POST['product_name'];
    $foto = $_POST['product_image'];
    $deskripsi = $_POST['product_desc'];
    $stock = $_POST['product_stock'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $size = $_POST['product_size'];
    $weight = $_POST['product_weight'];

    // buat query
    $sql = "INSERT INTO product (product_name, product_image, product_desc, product_stock, product_category, product_price, product_size, product_weight)
            VALUE ('$nama', '$foto', '$deskripsi', '$stock', '$category', '$price', '$size', '$weight')";
    $query = mysqli_query($conn, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: productAdmin.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: productAdmin.php?status=gagal');
    }


} else {
    die("Akses dilarang...");
}

?>