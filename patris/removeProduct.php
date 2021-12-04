<?php

include("connect.php");

if( isset($_GET['product_id']) ){

    // ambil id dari query string
    $id = $_GET['product_id'];

    // buat query hapus
    $sql = "DELETE FROM product WHERE product_id=$id";
    $query = mysqli_query($conn, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: productAdmin.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>