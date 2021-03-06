<?php
  session_start();
  if (!$_SESSION['username']) {
    header('Location:index.php');
  }

  require("../config/database.php");

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Order Details</title>
</head>
<style>
    .detail span{
        font-size: 1.5em;
    }
</style>

<body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">KinBech Store</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-span="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-span="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    <a class="nav-link px-3" href="#"><?php echo $_SESSION['username'] ?></a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-info text-light" href="orders.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file" aria-hidden="true"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customers.php">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers" aria-hidden="true"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-span="Add a new report">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-info" style="font-size: 40px;">Products Ordered</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $grandTotal = 0;


                        $res = $_GET['opid'];
                        $query = mysqli_query($conn, "SELECT * FROM ordered_product WHERE customer_id='$res'");
                        if (mysqli_num_rows($query) > 0) {

                            while ($rowss = mysqli_fetch_assoc($query)) {
                                $kop = $rowss['product_id'];
                                $i = 2;

                                $data = mysqli_query($conn, "SELECT * FROM products WHERE fp_id='$kop'");
                                $cart_item=mysqli_num_rows($data);
                                if (mysqli_num_rows($data) > 0) {
                                    $p_id = array();
                                    while ($rose = mysqli_fetch_assoc($data)) {
                                        $i = $i + 1;
                                        $total = $rose['fp_price'] * $rowss['quants'];
                                        $grandTotal = $grandTotal + $total;
                    ?>

                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0 text-primary "><?php echo $rose['fp_name'] ?></h6>
                                                <small class="text-muted"><?php echo $rowss['quants']." " ?>Pieces</small><br>
                                                <small class="text-muted"><?php echo "Rs. ". $rose['fp_price']." " ?>Each</small><br>
                                                <small class="text-muted"><?php echo $rose['fp_category'] ?></small><br>
                                                <small class="text-muted"><?php echo $rose['brand'] ?></small>
                                            </div>
                                            <span class="text-secondary">Rs. <?php echo $total ?></span>
                                        </li>
                            <?php

                                    }
                                }
                            }

                            ?>
                    <?php
                        }
                    
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Rupee)</span>
                        <strong><?php echo $grandTotal ?></strong>
                    </li>
                </ul>

            </div>

            
            <div class="col-md-7 col-lg-8 detail">
                <h1 class="mb-5 text-primary fw-bold">Order Details</h1>
                <form class="needs-validation">
                    <div class="row g-3">
                    <?php
                $sql2= mysqli_query($conn, "SELECT * FROM orders WHERE customerId='$res'");
                if (mysqli_num_rows($sql2)) {
                    $item=mysqli_fetch_assoc($sql2);
                    $userid=$item['customerId'];
                    $delivery= $item['payment'];

                    $sql3=mysqli_query($conn,"SELECT * FROM users WHERE user_id='$userid'");
                    $username=mysqli_fetch_assoc($sql3);
                
            ?>
                    <div class="col-sm-4">
                            <span for="firstName" class="form-span">Order From:</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $username['fname'] ?></span>

                        </div>

                        <div class="col-sm-4">
                            <span for="lastName" class="form-span">Buyer's Full Name</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $item['fname']." ".$item['lname'] ?></span>

                        </div>

                        <div class="col-sm-4">
                            <span for="firstName" class="form-span">Buyer's Address:</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $item['address'] ?></span>

                        </div>

                        <div class="col-sm-4">
                            <span for="lastName" class="form-span">Buyer's Phone</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $item['contact'] ?></span>

                        </div>

                        <div class="col-sm-4">
                            <span for="firstName" class="form-span">Buyer's email:</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $item['email'] ?></span>

                        </div>

                        <div class="col-sm-4">
                            <span for="lastName" class="form-span">Buyer's Gender</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $username['gender'] ?></span>

                        </div>

                        <div class="col-sm-4">
                            <span for="firstName" class="form-span">Payment Method::</span>

                        </div>

                        <div class="col-sm-6">
                            <span for="firstName" class="form-span fw-bold"><?php echo $delivery ?></span>

                        </div>
                        <?php
                }
                else {
                    echo "No Data Found";
                }
                ?>
                    </div>


                    <hr class="my-4">

                    <h3 class="mb-5 text-success text-underline">See Invoice Preview</h3>

                    <hr class="my-4">

                    <div class="d-flex">
                    <a class="w-50 btn btn-success fw-bold btn-lg mx-2" type="submit">Confirm Order</a>
                    <a href="cancellation_order.php?opid=<?php echo $res ?>" class="w-50 btn btn-danger btn-lg fw-bold mx-2" type="submit">Cancel Order</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
  </div>
</div>


    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  

</body>

</html>