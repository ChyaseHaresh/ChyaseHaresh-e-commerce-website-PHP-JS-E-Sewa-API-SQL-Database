<?php
//$_SESSION['name']= "haresh";  
if (isset($_SESSION['user'])) {
  global $sesan;
  $sesan = $_SESSION['user'];
} else {
  $sesan = "";
}


include_once('../includes/header.php');
require('../config/database.php');
$id = $_GET['id'];
$query = "SELECT * FROM products WHERE fp_id=$id";
$sql = mysqli_query($conn, $query);
if ($sql) {

  while ($row = mysqli_fetch_assoc($sql)) {
    $name = $row['fp_name'];
    $brand = $row['brand'];
    $price = $row['fp_price'];
    $oprice = $row['price'];
    $discount = $row['discount'];
    $image = $row['image'];
    $decript = $row['description'];
    $quantity = $row['fp_amount'];
    $cats = $row['fp_category'];
    $d_charge = $row['delivery_charge'];
    if ($d_charge == 0) {
      $d_charge = "Free";
    }
  }
} else {
  echo "you got fucked up..........";
}
?>

<style>
  .desc {
    font-size: 20px;
    /* color: #fff; */
  }

  body {
    background-color: #E8F5F7;
  }

  .milus {
    font-size: 12px;
    font-weight: bold;

  }

  .number {
    width: 100px;
  }

  .txt {
    font-weight: bold;
  }
</style>
<title>Product Details</title>
<div class="container border-primary $cyan-300">
  <!-- <hr class="featurette-divider"> -->

  <div class="row featurette">
    <div class="col-md-7 order-md-2">
      <h2 class="featurette-heading"><?php echo $name ?></h2>
      <p class="text-sm text-success"><i style="color:red;" class="fas fa-heart"></i> &nbsp; &nbsp;4.5 Ratings</p>
      <p class="text-sm text-success"><span class="text-muted">Brand:</span><span class="text-primary">&nbsp; &nbsp;<a href="#"><?php echo $brand ?></a></span>
      <p class="text-sm text-success"><span class="text-muted">Category:</span><span class="text-primary">&nbsp; &nbsp;<a href="#"><?php echo $cats ?></a></span>

        <br><br>
        <span class="card-title text-success" style="font-weight:bold; font-size:35px;">Rs. <?php echo $price ?></span>
      <p class="text-muted"><span style=" text-decoration: line-through; " class="card-text"><?php echo $oprice ?></span> <span>-<?php echo $discount ?>%</span></p>
      
      <span class="text-info fw-bold" style="font-size: 21px;">Delivery Charge: <span class="text-light bg-success px-2 pb-1"><?php echo $d_charge ?></span></span><br><br>
      <span class="text-secondary txt">Quantity: </span>
      <button class="btn btn-secondary mx-1 mb-1 milus" id="minus">-</button>
      <input type="text" class="number text-center" name="quantity" value="<?php echo $quantity ?>">
      <button class="btn btn-secondary mx-1 mb-1 milus" id="plus">+</button>

      <hr class="featurette-divider">
      <a class="btn btn-primary mx-3 text-bold buy" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Buy Now</a>
      <a class="btn btn-warning mx-2 text-bold" id="cart" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add to Cart</a>
      <br><br>

    </div>
    <div class="col-md-5 order-md-1">
      <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="440" height="300" src="../productimages/<?php echo $image ?>">

    </div>
  </div>



  <hr class="featurette-divider">
  <h2>Description</h2>
  <p class="desc"><?php echo $decript ?> </p>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">To add item to cart you must login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="p-3 round border bg-primary">
          <main class="form-signin mt-5 text-center modals">
            <form action="index.php" method="post">
              <img class="mb-4" src="../admin/avatar.png" alt="" width="80" height="80">
              <h1 class="mb-3 text-light">Please Signin</h1>
              <span style="color:red; font-size:20px;" class="fw-bold error-text"></span>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" name="uname" placeholder="ace121">
                <label for="floatingInput">Email</label>
              </div>
              <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <input type="hidden" name="id" id="herum" value="<?php echo $id ?>">
              <div class="login">
                <input class="w-50 mt-3 btn btn-lg btn-light" type="submit" value="Login">
              </div>
            </form>
          </main>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="../loginSignup/signup.php"><button type="button" class="btn btn-primary">Signup</button></a>
      </div>
    </div>
  </div>
</div>
<!-- <ul class="list-group userslist" style="position: absolute; top:10.5%;left:15%; width:700px" hidden>
</ul> -->
<ul class="list-group userslist" style="position: absolute; top:10.5%;left:15%; width:700px" hidden>
  
</ul>
<input type="hidden" class="temVal">

<script>
  const searchs = document.querySelector(".search input");
  let min = document.querySelector('#minus');
  let box = document.querySelector('.number');
  let max = document.querySelector('#plus');
  let carts = document.querySelector('#cart');
  let buys = document.querySelector('.buy');
  let tempo = document.querySelector('.temVal');


  const maxValue = box.value;
  //tval="";

  window.onload = function() {
    max.setAttribute("disabled", "true");
  }
  min.addEventListener("click", function() {
    let temp = box.value;
    box.value = temp - 1;
    if (box.value < 2) {
      min.setAttribute("disabled", "true");

    }
    if (box.value < maxValue) {
      max.removeAttribute("disabled");
    }

  });

  max.addEventListener("click", function() {
    let temp = box.value;
    box.value = parseInt(temp) + 1;
    if (box.value > maxValue - 1) {

      max.setAttribute("disabled", "true");

    }
    if (box.value > 1) {
      min.removeAttribute("disabled");
    }

  });

  const sessions = '<?php echo $sesan ?>';
  if (sessions != "") {
    console.log(sessions);

    carts.removeAttribute("data-bs-target");
    carts.removeAttribute("data-bs-toggle");
    buys.removeAttribute("data-bs-target");
    buys.removeAttribute("data-bs-toggle");

    carts.onclick = function() {
      let urls = "../includes/cart.php?id=<?php echo $id ?>" + "&quantity=" + box.value;
      carts.setAttribute("href", urls);

    }

    buys.onclick = function() {
      let urls = "../includes/cart.php?id=<?php echo $id ?>" + "&quantity=" + box.value;
      carts.setAttribute("href", urls);

    }
  } else {
    console.log("sessions");

    carts.setAttribute("data-bs-target", "#exampleModal");
    carts.setAttribute("data-bs-toggle", "modal");
    buys.setAttribute("data-bs-target", "#exampleModal");
    buys.setAttribute("data-bs-toggle", "modal");

    carts.removeAttribute("href")

  }
</script>
<script src="../javascript/search.js"></script>
<script src="../javascript/login.js"></script>
<?php
require('../includes/footer.php');
?>