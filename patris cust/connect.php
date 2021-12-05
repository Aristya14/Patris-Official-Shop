<?php 
 
$server = "localhost";
$user = "root";
$pass = "";
$database = "patris";
 
$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<script>alert('Error Connecting Database')</script>");
}
else
{
    echo("<script>console.log('Database Connected')</script>");
}
 
?>