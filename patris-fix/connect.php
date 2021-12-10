<?php 
 
$server = "localhost";
$user = "root";
$pass = "";
$database = "patris";

// $server = "localhost";
// $user = "id18080700_admin";
// $pass = "Kpan?MKLc/U5r47@";
// $database = "id18080700_patris";
 
$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<script>alert('Error Connecting Database')</script>");
}
else
{
    echo("<script>console.log('Database Connected')</script>");
}
 
?>