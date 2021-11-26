<?php
require('includes/inex.php');
//require('config/database.php');


$query = "SELECT * FROM products WHERE featured=1 ORDER BY fp_id DESC LIMIT 6";
$sql = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($sql)) {
  $result[] = $row;
}
?>
<style>
  body {
    background-color: #E8F5F7;
  }

  h1 {
    font-weight: bold;
    color: #267A85;
    margin: 10px;
  }

  .hovers:hover {
    box-shadow: 2px 2px 28px grey;
    cursor: pointer;
  }

  a {
    text-decoration: none;
  }

  .see {
    float: right;
  }
</style>
<hr class="mb-2">
<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators my-1">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item ">
      <img src="images/AceCosplay.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item active">
      <img src="images/monica.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">

      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<hr>
<h1 class="mx-4">Featured Products</h1>
<hr>
<div class="mx-4 mt-2">

  <div class="row row-cols-1 row-cols-md-6 g-4">

    <?php
    foreach ($result as $key => $resData) {
    ?>
      <a href="classes/productdetails.php?id=<?php echo $resData['fp_id'] ?>">
        <div class="card mx-2 hovers">
          <img src="productImages/<?php echo $resData['image'] ?>" class="card-img-top" height="190px">
          <div class="card-body">
            <h3 style="font-weight:bold; color:#0d6efd" class="card-title"><?php echo $resData['fp_name'] ?></h3>
            <span class="card-title text-success" style="font-weight:bold; font-size:20px;">Rs. <?php echo $resData['fp_price'] ?></span>
            <p class="text-muted"><span style=" text-decoration: line-through; " class="card-text"><?php echo $resData['price'] ?></span> <span>-<?php echo $resData['discount'] ?>%</span></p>

          </div>
        </div>
      </a>
    <?php } ?>
  </div>

  <hr>
  <h1 class="mx-4">Just For You</h1>
  <hr>
  <div class="mx-4 mt-2">

    <div class="row row-cols-1 row-cols-md-6 g-4">

      <?php
      $query2 = "SELECT * FROM products ORDER BY fp_id ASC LIMIT 12";
      $sql2 = mysqli_query($conn, $query2);
      $result2 = array();
      while ($row2 = mysqli_fetch_assoc($sql2)) {
        $result2[] = $row2;
      }

      foreach ($result2 as $key2 => $resData2) {
      ?>
        <a href="classes/productdetails.php?id=<?php echo $resData2['fp_id'] ?>">
          <div class="card mx-2 hovers">
            <img src="productImages/<?php echo $resData2['image'] ?>" class="card-img-top" height="190px">
            <div class="card-body">
              <h3 style="font-weight:bold; color:#0d6efd" class="card-title"><?php echo $resData2['fp_name'] ?></h3>
              <span class="card-title text-success" style="font-weight:bold; font-size:20px;">Rs. <?php echo $resData2['fp_price'] ?></span>
              <p class="text-muted"><span style=" text-decoration: line-through; " class="card-text"><?php echo $resData2['price'] ?></span> <span>-<?php echo $resData2['discount']   ?>%</span></p>

            </div>
          </div>
        </a>
      <?php } ?>
    </div>
    <ul class="list-group userslist" style="position: absolute; top:10.5%;left:15%; width:700px" hidden>
      
    </ul>
    <div class="see">
      <a href="all_product.php">
        <h5 class="mb-2">See More...</h5>
      </a>
    </div>
    
    
    <script src="javascript/inexSearch.js"></script>
    <script src="javascript/p-details.js"></script>
    <?php
    require('includes/footer.php');
    ?>
   