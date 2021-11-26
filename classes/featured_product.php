<?php

    include ('../config/database.php');

    $query= "SELECT * FROM products";
    $sql= mysqli_query($conn, $query);
    $result=array();
   if ($sql) {
   
    while($row = mysqli_fetch_assoc($sql) ){
	$result[]=$row;
}
# code...
}
else {
echo "you got fucked up..........";
}
?>
<?php
	foreach ($result as $key => $resData) {
	?>
    <div class="col">
    <div class="card">
      <img src="../productImages/<?php $resData['image'] ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h3 style="font-weight:bold; color:#0d6efd" class="card-title"><?php $resData['fp_name'] ?></h3>
        <span class="card-title text-success" style="font-weight:bold; font-size:20px;">Rs. <?php $resData['fp_price'] ?></span>
        <p class="text-muted"><span style=" text-decoration: line-through; " class="card-text"><?php $resData['price'] ?></span> <span>-50%</span></p>
        
      </div>
    </div>
    <?php } ?>


