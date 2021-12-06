<?php
require 'connect.php';

$order_cost = mysqli_query($conn, "select order_cost from orders where order_status='Shipped'");
$order_date = mysqli_query($conn, "select order_date from orders where order_status='Shipped'");

$sql = "SELECT*from product";
$query = mysqli_query($conn, $sql);

$sql2 = "SELECT*from orders";
$query2 = mysqli_query($conn, $sql2);

$sql3 = "SELECT*from customer";
$query3 = mysqli_query($conn, $sql3);

$sql4 = "SELECT avg(review_rating) as rate from review";
$query4 = mysqli_query($conn, $sql4);
$result = mysqli_fetch_array($query4)
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Patris Official Shop Admin
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
  <style>
    .dashboard-color {
      background-color: coral;
    }
  </style>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar dashboard-color" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="./dashboard.php" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="img/logo.png">
          </div>
        </a>
        <a href="./dashboard.php" class="simple-text logo-normal">
          Dashboard
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./dashboard.php">
              <i>
                <img src="https://img.icons8.com/material-outlined/24/fa314a/dashboard-layout.png" /></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./productAdmin.php">
              <i><img src="https://img.icons8.com/ios-filled/50/fa314a/women-shoe-side-view.png" /></i>
              <p>Produk</p>
            </a>
          </li>
          <li>
            <a href="./pesananAdmin.php">
              <i><img src="https://img.icons8.com/ios-filled/50/fa314a/order-history.png" /></i>
              <p>Pesanan</p>
            </a>
          </li>
          <li>
            <a href="ulasanAdmin.php">
              <i>
                <img
                  src="https://img.icons8.com/external-bearicons-glyph-bearicons/64/fa314a/external-positive-review-reputation-bearicons-glyph-bearicons.png" />
              </i>
              <p>Ulasan</p>
            </a>
          </li>
          <li class="active">
            <a href="./tables.php">
              <i><img src="https://img.icons8.com/ios-filled/64/fa314a/combo-chart.png" /></i>
              <p>Statistik Penjualan</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Patris Official Shop ~ Admin</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li>
                <a class="nav-brand text-danger" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
  
      <section class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i><img src="https://img.icons8.com/ios-filled/50/000000/new-product.png"/></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Produk</p>
                      <p class="card-title" style="margin-top: 30px; margin-bottom: 30px"><?php echo mysqli_num_rows($query)?></p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i><img src="https://img.icons8.com/ios-filled/50/000000/shopaholic.png"/></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Orders</p>
                      <p class="card-title" style="margin-top: 30px; margin-bottom: 30px"><?php echo mysqli_num_rows($query2)?><p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i><img src="https://img.icons8.com/external-glyph-geotatah/50/000000/external-buyer-cashless-society-glyph-glyph-geotatah.png"/></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Account Customer</p>
                      <p class="card-title"style="margin-top: 25px; margin-bottom: 12px"><?php echo mysqli_num_rows($query3)?><p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i><img src="https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/50/000000/external-rating-support-vitaliy-gorbachev-fill-vitaly-gorbachev.png"/></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Rating Produk</p>
                      <p class="card-title" style="margin-top: 25px; margin-bottom: 12px"><?php echo number_format($result['rate'],1)?><p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header" style="margin-left: auto; margin-right: auto">
                    <h2 class="card-title">Statistik Penjualan</h2>
                </div>
                <!-- /.card-header -->
                <div class="chart">
                    <canvas id="LineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    </div> 
    </div>
  </div>
  <!--chart-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.1/chart.min.js"></script>

  <script>
  var ctx = document.getElementById("LineChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php while ($b = mysqli_fetch_array($order_date)) { echo '"' . $b['order_date'] . '",';}?>],
                    datasets: [{
                            label: 'Penjualan',
                            data: [<?php while ($p = mysqli_fetch_array($order_cost)) { echo '"' . $p['order_cost'] . '",';}?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });
        </script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function () {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>
