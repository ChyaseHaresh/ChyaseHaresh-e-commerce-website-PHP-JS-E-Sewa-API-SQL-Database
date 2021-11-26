<?php
require('includes/inexs.php');
//require('config/database.php');


// $query= "SELECT * FROM products WHERE featured=1 ORDER BY fp_id DESC LIMIT 6";
//     $sql= mysqli_query($conn, $query);
//     $result=array();
// while($row = mysqli_fetch_assoc($sql) ){
// 	$result[]=$row;
// }
if (isset($_GET['category'])) {
  # code...
  $cat_id=$_GET['category'];
}else {
  $cat_id="";
}


?>
<style>
   body{
      background-color:#E8F5F7;
    }
    h1{
      font-weight:bold;
      color:#267A85;
      margin: 10px;
    }
    .hovers:hover{
      box-shadow: 2px 2px 28px grey;
      cursor:pointer;
    }
    a{
      text-decoration:none;
    }
    .see{
      float:right;
    }
    #load_data_message{
      text-align:center;
      font-size:100px;
    }
</style>
<hr class=" mb-5">
<!-- <hr>
<h1 class="mx-4">Featured Products</h1>
<hr>
<div class="mx-4 mt-2">
  
<div class="row row-cols-1 row-cols-md-6 g-4">
 
  <?php
	foreach ($result as $key => $resData) {
	?>
    <a href="classes/productdetails.php?id=<?php echo $resData['fp_id']?>">
      <div class="card mx-2 hovers">
        <img src="productImages/<?php echo $resData['image'] ?>" class="card-img-top"  height="190px" >
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
<hr> -->
<form action="includes/get_all.php" method="post">
<input type="hidden" id="cats" name="catid" value="<?php echo $cat_id ?>">
</form>
<div class="mx-4 mt-2">
  
    <div class="row row-cols-1 row-cols-md-6 g-4" id="load_data">

    </div>

    <div class="mb-4" id="load_data_message"></div>

</div>
<br />
   <br />
   <br />
   <br />
   <br />
   <br />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

$(document).ready(function(){
 
 var ctgry=document.querySelector('#cats').value;
 console.log(ctgry);
 var limit = 12;
 var start = 0;
 var action = 'inactive';
 function load_country_data(limit, start,ctgry)
 {
  $.ajax({
   url:"includes/get_all.php",
   method:"POST",
   data:{limit:limit, start:start},
   cache:false,
   success:function(data)
   {
    $('#load_data').append(data);
    if(data == '')
    {
     $('#load_data_message').html("<button type='button' class='btn btn-info '>End of Products</button>");
     action = 'active';
    }
    else
    {
     $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
     action = "inactive";
    }
   }
  });
 }

 if(action == 'inactive')
 {
  action = 'active';
  load_country_data(limit, start, ctgry);
 }
 $(window).scroll(function(){
  if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
  {
   action = 'active';
   start = start + limit;
   setTimeout(function(){
    load_country_data(limit, start, ctgry);
   }, 1500);
  }
 });
 
});
</script>

<script src="javascript/p-details.js"></script>

