<?php

if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];
}

$sqlcat = "SELECT * FROM category";
$resultcat = mysqli_query($conn, $sqlcat);

$sqlcart = "SELECT * FROM customer cs, cart c, product p where cs.customer_id=c.customer_id and c.product_id=p.product_id and cs.customer_username='$user'";
$resultcart = mysqli_query($conn, $sqlcart);
$numcart = $resultcart->num_rows;

if ($numcart) {
    $sqlsump = "SELECT sum(c.quantity*p.product_price) as sumprice FROM customer cs, cart c, product p where cs.customer_id=c.customer_id and c.product_id=p.product_id and cs.customer_username='$user'";
    $resultsump = mysqli_query($conn, $sqlsump);
    $rowsump = mysqli_fetch_assoc($resultsump);

    $sqlsumq = "SELECT sum(c.quantity) as sumquantity FROM customer cs, cart c, product p where cs.customer_id=c.customer_id and c.product_id=p.product_id and cs.customer_username='$user'";
    $resultsumq = mysqli_query($conn, $sqlsumq);
    $rowsumq = mysqli_fetch_assoc($resultsumq);
}


if (isset($_POST['submitsearch'])) {
    $search = $_POST['search'];
    header("Location: shop.php?search=" . $search);
}

?>

<header class="header pt-30 pb-30  header-sticky header-static" style="padding-top: 30px; padding-bottom: 15px; top: 0px;">
    <div class="container-fluid">
        <div class="header-nav position-relative">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-6 hidden-md position-static">
                    <div class="header-nav">
                        <nav>
                            <ul>
                                <li><a <?php if (strpos($_SERVER['REQUEST_URI'], "index") !== false) {
                                            echo 'class="active"';
                                        } ?> href="index.php"><span style="font-size: 15px; margin-right: 20px;margin-left: 15px;">Home</span></a>
                                </li>
                                <li><a <?php if (strpos($_SERVER['REQUEST_URI'], "shop.php") !== false) {
                                            echo 'class="active"';
                                        } ?> href="shop.php"><span style="font-size: 15px;margin-right: 20px;">Shop<i class="fal fa-angle-down"></i></span></a>
                                    <ul class="submenu">
                                        <li><a href="shop.php">All Categories</a></li>
                                        <?php while ($rowcat = mysqli_fetch_assoc($resultcat))
                                            echo '<li><a href="shop.php?cat=' . $rowcat['category_id'] . '">' . $rowcat['category_name'] . '</a></li>';
                                        ?>
                                    </ul>
                                </li>
                                <li><a <?php if (strpos($_SERVER['REQUEST_URI'], "contact") !== false) {
                                            echo 'class="active"';
                                        } ?> href="contact.php"><span style="font-size: 15px;margin-right: 20px;">Contact</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-3">
                    <div class="logo">
                        <a href="index.php"><img src="img/logo2.png" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-3 col-6 col-md-6 col-sm-6 col-9">
                    <div class="header-right" style="font-size: 15px; margin-right: 20px;margin-left: 15px;">
                        <ul class="text-right">
                            <li>
                                <a href="javascript:void(0)"><i class="fal fa-search"></i></a>
                                <div id="search-popup">
                                    <div class="close-search-popup">
                                        <i class="fal fa-times"></i>
                                    </div>
                                    <div class="search-popup-inner mt-135">
                                        <div class="search-title text-center">
                                            <h2>Search</h2>
                                        </div>
                                        <div class="search-content pt-55">
                                            <div class="search-form mt-35">
                                                <form method="POST">
                                                    <input id="search" name="search" type="text" placeholder="Search Products...">
                                                    <button name="submitsearch"><i class="fal fa-search"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="cart.php"><i class="fal fa-shopping-bag"><span><?php if ($numcart) echo $rowsumq['sumquantity'];
                                                                                        else echo "0"; ?></span></i></a>
                                <div class="minicart">
                                    <?php if ($numcart) { ?>
                                        <div class="minicart-body">
                                            <div class="minicart-content">
                                                <ul class="text-left">
                                                    <?php while ($rowcart = mysqli_fetch_assoc($resultcart)) { ?>
                                                        <li>
                                                            <div class="minicart-img">
                                                                <a href="single-product.php?id=<?php echo $rowcart['product_id']; ?>" class="p-0">
                                                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($rowcart['product_image']); ?>" class="w-100" alt="">
                                                                </a>
                                                            </div>
                                                            <div class="minicart-desc">
                                                                <a href="single-product.php?id=<?php echo $rowcart['product_id']; ?>" class="p-0">
                                                                    <?php echo $rowcart['product_name']; ?>
                                                                </a><br>
                                                                <strong><?php echo $rowcart['quantity']; ?> × Rp.
                                                                    <?php echo number_format($rowcart['product_price']); ?></strong>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="minicart-checkout">
                                        <div class="minicart-checkout-heading mt-8 mb-25 overflow-hidden">
                                            <?php if ($numcart) { ?>
                                                <strong class="float-left">Subtotal:</strong>
                                                <span class="price float-right">Rp. <?php echo number_format($rowsump['sumprice']) ?></span>
                                            <?php } else { ?>
                                                <strong class="float-left">You have no items in your cart</strong>
                                            <?php } ?>
                                        </div>
                                        <div class="minicart-checkout-links">
                                            <a href="cart.php" class="generic-btn black-hover-btn text-uppercase w-100 mb-20">View cart</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="
                                 <?php
                                    if (isset($_SESSION['username'])) {
                                        echo "account.php";
                                    } else {
                                        echo "login.php";
                                    }
                                    ?>
                                 " class="account">

                                    <i class="fal fa-user-friends"></i>
                                    <article class="account-registar d-inline-block">
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                            echo $user;
                                        } else {
                                            echo "Login/Sign Up";
                                        }
                                        ?>

                                    </article>

                                </a>
                                <?php if (isset($_SESSION['username'])) echo '
                                    <ul class="submenu bold-content text-right">
                                    <li><a href="account.php">My Account</a></li>
                                    <li><a href="order.php">My Order</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                    '; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu visible-sm">
            <div id="mobile-menu">
                <ul>
                    <li><a class="pl-3" href="javascript:void(0)" href="index.php">Home</a></li>
                    <li><a class="pl-3" href="javascript:void(0)" href="shop.php">Shop</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>