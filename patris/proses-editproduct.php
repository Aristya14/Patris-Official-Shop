<?php
include 'connect.php';
// menyimpan data kedalam variabel
// $id_mahasiswa   = $_POST['id_mahasiswa'];
// $nim            = $_POST['nim'];
// $nama           = $_POST['nama'];
// $jurusan        = $_POST['jurusan'];
// $jenis_kelamin  = $_POST['jenis_kelamin'];
// $alamat         = $_POST['alamat'];
if(isset($_POST['simpan'])){
    $id = $_POST['product_id'];
    $nama = $_POST['product_name'];
    $foto = $_POST['product_image'];
    $deskripsi = $_POST['product_desc'];
    $stock = $_POST['product_stock'];
    $category = $_POST['product_category'];
    $price = $_POST['product_price'];
    $size = $_POST['product_size'];
    $weight = $_POST['product_weight'];

// query SQL untuk insert data
$query="UPDATE product SET 
    product_name='$nama',product_image='$foto',product_desc='$deskripsi',product_stock='$stock',
    product_category='$category',product_price='$price',product_size='$size',product_weight='$weight' 
    where product_id='$id'";
mysqli_query($conn, $query);
// mengalihkan ke halaman index.php
header("location:productAdmin.php");
}
?>