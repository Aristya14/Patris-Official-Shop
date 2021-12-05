<?php
include 'connect.php';

error_reporting(0);

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $user = $_SESSION['username'];

    $sql = "SELECT * FROM customer WHERE customer_username ='$user'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Something went wrong. Please try again!')</script>";
    }
}

if (isset($_POST['submit'])) {

    if ($_POST['pass']) {
        $password = md5($_POST['pass']);
    } else {
        $password = $row['customer_password'];
    }

    $name = $_POST['fullname'];
    $sex = $_POST['sex'];
    $birth = $_POST['birth'];
    $phone = $_POST['phone'];

    $sql2 = "UPDATE customer set customer_name='$name', customer_sex='$sex', customer_password='$password', customer_birth='$birth', customer_telp='$phone' where customer_username ='$user'";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
        header("Location: account.php");
    } else {
        echo "<script>alert('Something is wrong.')</script>";
    }
}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Patris Official Shop</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/meanmenu.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <section class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-content" style="flex-direction: column;">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb p-0 m-0">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active" aria-current="page">My Account</li>
                                </ol>
                            </nav>
                            <h2 class="login-title mt-40">My Account</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="login-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="basic-login">
                            <h3 class="text-center mb-60">My Account</h3>
                            <form method="POST">
                                <label for="email">Email Address</label>
                                <input id="email" name="email" type="email" value="<?php echo $row['customer_email']; ?>" disabled />
                                <label for="name">Username</label>
                                <input id="name" name="name" type="text" value="<?php echo $row['customer_username']; ?>" disabled />
                                <label for="pass">Password <span>**</span></label>
                                <input id="pass" name="pass" type="password" placeholder="Enter New Password..." />
                                <label for="fullame">Name <span>**</span></label>
                                <input id="fullname" name="fullname" type="text" value="<?php echo $row['customer_name']; ?>" />
                                <label for="sex">Sex <span>**</span></label>
                                <select name="sex" id="sex" style="margin-bottom:20px;">
                                    <option value="Man" <?php if ($row['customer_sex'] == "Man") echo "selected"; ?>>Man</option>
                                    <option value="Woman" <?php if ($row['customer_sex'] == "Woman") echo "selected"; ?>>Woman</option>
                                </select>
                                <label for="birth">Birthdate <span>**</span></label>
                                <input id="birth" name="birth" type="date" value="<?php echo $row['customer_birth']; ?>" />
                                <label for="phone">Phone Number <span>**</span></label>
                                <input id="phone" name="phone" type="text" value="<?php echo $row['customer_telp']; ?>" />
                                <div class="mt-10"></div>
                                <button name="submit" class="btn theme-btn-2 w-100">Update My Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include 'footer.php'; ?>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/one-page-nav-min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.meanmenu.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/fontawesome.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

</html>