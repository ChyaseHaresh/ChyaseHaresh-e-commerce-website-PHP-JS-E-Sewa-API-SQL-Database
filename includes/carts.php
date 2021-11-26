<?php
require("header.php");
$checkuid=$_SESSION['id'];
$check= mysqli_query($conn, "SELECT * FROM carts WHERE customer_id='$checkuid'");
$numOfItem= mysqli_num_rows($check);

?>

<style>
  h1 {
    font-weight: bold;
    color: #267A85;
    margin: 10px;
  }

  .checkout {
    font-size: 40px;
  }

  .cent {
    text-align: center;
  }
</style>

<div class="container tabule">
  <h1 class="mb-2">Cart Products</h1>

  <table class="table table-dark table-hover">
    <thead class="fw-bold text-primary mb-1">
      <tr>
        <!-- <th scope="col">#</th> -->
        <th scope="col">Product Name</th>
        <th scope="col">Brand Name</th>
        <th scope="col">Category</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Delivery Charge</th>
        <th scope="col">Total</th>
        <th scope="col">Action</th>

      </tr>
    </thead>

    <?php
    $grandTotal = 0;

    if (isset($_SESSION['id'])) {
      $res = $_SESSION['id'];
      $query = mysqli_query($conn, "SELECT * FROM carts WHERE customer_id='$res'");
      if (mysqli_num_rows($query) > 0) {

        while ($rowss = mysqli_fetch_assoc($query)) {
          $kop = $rowss['product_id'];
          $i = 2;

          $data = mysqli_query($conn, "SELECT * FROM products WHERE fp_id='$kop'");
          if (mysqli_num_rows($data) > 0) {
            $p_id = array();
            while ($rose = mysqli_fetch_assoc($data)) {
              $i = $i + 1;
              $d_charge = $rose['delivery_charge'];
              $total = $rose['fp_price'] * $rowss['quantum'] +$d_charge;
              $grandTotal = $grandTotal + $total;
              if ($d_charge == 0) {
                $d_charge = "Free";
              }
    ?>
              <tbody>
                <tr>
                  <!-- <th scope="row"><?php echo $i ?></th> -->
                  <td><img class="mx-3" src="../productImages/<?php echo $rose['image'] ?>" width="110" height="90"><?php echo $rose['fp_name'] ?></td>
                  <td><?php echo $rose['brand'] ?></td>
                  <td><?php echo $rose['fp_category'] ?></td>
                  <td><?php echo $rowss['quantum'] ?></td>
                  <td><?php echo $rose['fp_price'] ?></td>
                  <td class="text-center"><?php echo $d_charge ?></td>
                  <td><?php echo $total ?></td>
                  <?php  ?>
                  <td><a class="text-danger" href="delete.php?id=<?php echo $rowss['cart_id'] ?>"><i class="fas fa-trash"></i></a></td>


                </tr>

              </tbody>
        <?php

            }
          }
        }
        //   
        ?>
        // <?php
            //echo (string)$value;
          }
        } else {
          echo "No products to show";
        }
            ?>
  </table>
  <span class="bg-dark text-info fw-bold p-2 h2 d-flex flex-row-reverse">
    <p class="text-warning mx-5"> <?php echo $grandTotal ?></p>Grand Total Price:
  </span>
  <hr>
  <div class="cent mt-3">
    <a class="btn btn-lg btn-warning text-light fw-bold p-2 h1 checkout " href="../checkout.php" role="button">Checkout</a>

  </div>
  <hr>
</div>
<div class="container message">
  <h2 class="text-info text-center mt-4" style="font-size: 50px;">No Items in the Cart </h2>
</div>

<script>
  let tables=document.querySelector('.tabule');
  let message= document.querySelector('.message');
  let items= "<?php echo $numOfItem ?>";
  if(items<1){
    tables.setAttribute('hidden', true);
  }
  else if(items>0){
    tables.removeAttribute('hidden');
    message.setAttribute('hidden',true);
  }
</script>
<?php
require("footer.php");
?>