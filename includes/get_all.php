<?php
  require("../config/database.php");
$query2="";
  if (isset($_POST['ctgry'])) {
      echo $_POST['ctgry'];
    $query2=  "SELECT * FROM products WHERE category=".$_POST['ctgry']." LIMIT " .$_POST["start"]. ", ".$_POST["limit"]."";
  }
  else {
    $query2=  "SELECT * FROM products LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
  }
  if(isset($_POST["limit"], $_POST["start"]))
    {

        $sql2= mysqli_query($conn, $query2);
        $result2=array();
        while($row2 = mysqli_fetch_assoc($sql2) ){
            $result2[]=$row2;
        }

        foreach ($result2 as $key2 => $resData2) {
            echo '
                <a href="classes/productdetails.php?id='.$resData2['fp_id'].'"'.'>
                    <div class="card mx-2 hovers">
                        <img src="productImages/'.$resData2['image'].'"'.' class="card-img-top"  height="190px" >
                        <div class="card-body">
                            <h3 style="font-weight:bold; color:#0d6efd" class="card-title">'.$resData2['fp_name'].'</h3>
                            <span class="card-title text-success" style="font-weight:bold; font-size:20px;">Rs. '.$resData2['fp_price'].'</span>
                            <p class="text-muted"><span style=" text-decoration: line-through; " class="card-text">'.$resData2['price'].'</span> <span>- '.$resData2['discount'].' %</span></p>
                        </div>
                    </div>
                </a>';
        }
     } 
?>