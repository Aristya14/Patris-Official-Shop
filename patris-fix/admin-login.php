<?php

include 'connect.php';

error_reporting(0);

session_start();

if (isset($_SESSION['adminid'])) {
    header("Location: admin-dash.php");
}

if (isset($_POST['submit'])) {

    $email = $_POST['name'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM admin WHERE username = '$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['adminid'] = $row['admin_id'];
        $_SESSION['adminname'] = $row['admin_name'];
        header("Location: admin-dash.php");
    } else {
        echo "<script>alert('Username or Password is wrong. Please try again!')</script>";
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

<body style="background: #f8f9fd;">
    <section style="padding: 9em 0;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="w-100 bg-white rounded d-md-flex shadow-lg">
                        <div style="background-image: url(img/adminlogin.png); background-size: cover;  background-repeat: no-repeat; background-position: center center; width: 50%;"></div>
                        <div class="p-4 p-md-5 mx-auto">
                            <div class="w-100">
                                <h3 class="font-weight-bold mb-1">PATRIS OFFICIAL SHOP</h3>
                                <h3 class="font-weight-bold">ADMIN LOGIN</h3>
                            </div>
                            <form class="signin-form" method="POST">
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input name="name" type="text" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Kata Sandi</label>
                                    <input name="pass" type="password" class="form-control" placeholder="Kata Sandi" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button name="submit" type="submit" class="btn btn-danger rounded submit px-3 w-100">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chartjs.min.js"></script>
    <script src="js/admin.js" type="text/javascript"></script>
</body>

</html>