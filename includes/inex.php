<?php
session_start();
require("config/database.php");
$cart_item = 0;
if (isset($_SESSION['user'])) {
  global $sesan;
  $sesan = $_SESSION['user'];
  $id = $_SESSION['id'];
  $sql = mysqli_query($conn, "SELECT product_id FROM carts WHERE customer_id='$id'");
  if ($sql) {
    $cart_item = mysqli_num_rows($sql);
  }
} else {
  $sesan = "";
}

$cat = mysqli_query($conn, "SELECT * FROM category");
$result = array();
while ($row = mysqli_fetch_assoc($cat)) {
  $result[] = $row;
}


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <title>Home-KinBech Store</title>
</head>
<style>
  .logout:hover {
    background-color: red;
    color: white;
  }

  .notification {
    font-size: 20px;
    padding: 6px;
    background-color: red;
    border-radius: 50%;
    margin-left: -6px;
    margin-top: -4px;
  }

  .cart:hover {
    cursor: pointer;
  }

  .hoverer:hover {
    background-color: #0d6efd;
    color: white;
  }

  .dorops {
    font-size: 25px;
  }
  .searchList{
      height: 15px;
    }
</style>

<body>
  <header class="py-1 mb-0 border-bottom bg-primary">
    <a href="index.php"><span style="font-size:2em; font-weight:bold; color:white;" class="px-4">KinBech Store</span></a>
    <span style="font-size:1.5em; color:secondary; color:aqua;">Everything at Your Click</span>

    <div class="container-fluid d-grid align-items-center" style="grid-template-columns: 1fr 20fr 1fr;">

      <div class="dropdown">
        <a href="#" class="d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-light mx-2 text-decoration-none dropdown-toggle" id="dropdownNavLink" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> -->
          <div style="font-size:1.5em">
            <span class="fw-bold text-light">Categories</span>
          </div>
        </a>
        <ul class="dropdown-menu border bg-success shadow dorops" aria-labelledby="dropdownNavLink">
          <?php
          foreach ($result as $key => $resData) {
          ?>
            <li><a class="dropdown-item hoverer text-light fw-bold" href="categories.php?id=<?php echo $resData['id'] ?>" aria-current="page"><?php echo $resData['cat_name'] ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <div class="d-flex align-items-center search">
        <form class="w-100 me-3">
          <input style="border-radius:30px;" type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>
        <div class="border-warning">
          <div class="mx-2" style="font-size:2em;">
            <li class="fas fa-shopping-cart cart" onclick="myfunc()"><span class="text-light fw-bold px-2 notification"><?php echo $cart_item ?></span></li>
          </div>


        </div>
        <span style="color:white; font-size:1.6em; padding:2px">&#124;</span>

        <div class="notLoged">
          <a href="loginSignup/signup.php"><span style="font-size:20px;" class="text-warning mx-2 fw-bold">Login</span></a>
        </div>
        <div class="drops">
          <div class="flex-shrink-0 dropdown mx-2 ">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
              <span style="font-size:20px;" class="text-light fw-bold mx-2"><?php echo $sesan ?></span>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item logout" onclick="logoutFunction()">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  
  <script>
    let notShowName = document.querySelector('.notLoged');
    let showName = document.querySelector('.drops');
    const sesa = '<?php echo $sesan ?>';
    console.log(sesa);

    if (sesa != "") {
      notShowName.setAttribute("hidden", "true");
      showName.removeAttribute("hidden");
    } else {
      showName.setAttribute("hidden", "true");
      notShowName.removeAttribute("hidden");
    }

    function logoutFunction() {
      if (confirm("Are you sure you want to logout ??")) {
        window.open('loginSignup/logout.php', '_self');
      }
    }

    function myfunc() {
      location.href = "includes/carts.php";
    }
  </script>
