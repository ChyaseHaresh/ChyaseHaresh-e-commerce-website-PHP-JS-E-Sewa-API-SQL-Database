<?php
session_start();
if (!$_SESSION['username']) {
  header('Location:index.php');
}

    require("../config/database.php");

    $ids=$_GET['id'];
    $sql=mysqli_query($conn, "SELECT * FROM products WHERE fp_id='$ids'");
    if (mysqli_num_rows($sql)>0) {
        $rw=mysqli_fetch_assoc($sql);
        $filename=$rw['image'];
        //$_SESSION['id']=$ids;

        $idss=true;
        
    }
    if (isset($_POST['update'])) {
        $name= $_POST['pname'];
        $brand= $_POST['pbrand'];
        $price= $_POST['pprice'];
        $category= $_POST['pcategory'];
        $ammount= $_POST['pamount'];
        $discount= $_POST['pdiscount'];
        $description= $_POST['pdescription'];
        $delivery= $_POST['delivery'];
        $feature=$_POST['featured'];


       
        $final_price=$price-($price*($discount/100));



        if(isset($_FILES['imaage'])){
            $img_name = $_FILES['imaage']['name'];
            $img_type = $_FILES['imaage']['type'];
            $tmp_name = $_FILES['imaage']['tmp_name'];
            
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"../productImages/".$new_img_name)){
                        
                        $query= "UPDATE products SET fp_name='$name', brand='$brand', price='$price', fp_category='$category', fp_amount='$ammount', image='$new_img_name', discount='$discount', description='$description', delivery='$delivery', featured='$feature' WHERE fp_id='$ids'";

                        $insert_query = mysqli_query($conn,$query);
                            
                            if ($insert_query) {
                                echo "<script>alert('The Product has been updated successfully')</script>";
                                // echo `<script>location.href="edit.php?id=`.$rw['fp_id'].`"></script>`;
                                $idss=true;
                            }else {
                                echo "<script>alert('insertion Failed !!')</script>";
                                // echo `<script>location.href="edit.php?id=`.$rw['fp_id'].`"></script>`;
                                $idss=false;
                            }
                    }
                }
                else {
                    echo "<script>alert('Something went wrong.')</script>";
                    $idss=false;
                }
            }
            else {
                echo "<script>alert('Please upload an image file - jpeg, png, jpg')</script>";
                $idss=false;
            }
        }
        else {
            echo "1st Please upload an image file - jpeg, png, jpg";
            echo '<script>location.reload()</script>';
        
        }

    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Add Products</title>
  </head>
  <style>
      .add-product{
        width: 100%;
    max-width: 600px;
    padding: 10px;
    margin: auto;
    background-color:#94E4EF;
    border-radius:15px;
      }
      input[type='submit']{
          max-width:400px;
          margin-left:110px;
      }
  </style>
  <body>
      <div class="container add-product mt-2">
          <h2 class="text-center text-secondary mb-3">Update Product</h2>
          <div class="text-center text-secondary mb-3">
            <img src="../productImages/<?php echo $filename ?>" alt="" height="150" width="200">
          </div>
        <form action="edit.php" method="post"  enctype="multipart/form-data">

        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Photo</label>
        <div class="col-sm-8">
            <label class="btn btn-secondary" for="formFile">Change Image</label>
          <input class="form-control" type="file" id="formFile"  accept="image/x-png,image/gif,image/jpeg,image/jpg" 
           style="display: none; visibility:none;" onchange="getImage(this.value);">
          <input type="hidden" name="imaage" value="<?php echo $filename ?>" id="hides">
          <span class="imgname"></span>
        </div>
        </div>


        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="pname" value="<?php echo $rw['fp_name'] ?>" required>
        </div>
        </div>
        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Product Brand</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="pbrand" value="<?php echo $rw['brand'] ?>">
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="pprice" value="<?php echo $rw['price'] ?>" required>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <select class="form-select" name="pcategory" aria-label="Default select example" value="<?php echo $rw['fp_category'] ?>" required>
                <option value="Electronic Devices">Electronic Devices</option>
                <option value="Electronic Accessories">Electronic Accessories</option>
                <option value="Home Appliances">Home Appliances</option>
                <option value="Babies & Toys">Babies & Toys</option>
                <option value="Groceries">Groceries</option>
                <option value="Men\'s Wear">Men's Wear</option>
                <option value="Women\'s Wear">Women's Wear</option>
                <option value="Watches & Accessories">Watches & Accessories</option>
                <option value="Sports & Outdoor">Sports & Outdoor</option>
                <option value="Automobiles">Automobiles</option>
            </select>
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label >
        <div class="col-sm-10">
            <input type="number" class="form-control"  name="pamount" value="<?php echo $rw['fp_amount'] ?>" required>
        </div>
        </div>
        

        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Discount</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" value="<?php echo $rw['discount'] ?>" name="pdiscount" aria-label="Username" required>
        </div>  <span style="width:40px; margin-left:-4px;" class="input-group-text">%</span>

        </div>

        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
        <textarea class="form-control" name="pdescription" id="floatingTextarea" required><?php echo $rw['description'] ?></textarea >
        </div>
        </div>

        <div class="row mb-3">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery</label>
        <div class="col-sm-10">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="inlineCheckbox1" name="delivery" value="Delivery Charge Included" checked>
            <label class="form-check-label" for="inlineCheckbox1">Delivery Charge Included</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="inlineCheckbox2" name="delivery" value="Free Delivery" >
            <label class="form-check-label" for="inlineCheckbox2">Free Delivery</label>
        </div>
        </div>
        </div>

        <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="featured" value= 1>
            <label class="form-check-label" for="gridCheck1">
                Mark as fearured product
            </label>
            </div>
        </div>
        </div>

        <div class="row mb-3">
        <input type="submit" class="btn btn-primary text-center" value="Update" name="update">

        </div>

       
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>

function getImage(imagename){
    let spandum= document.querySelector('.imgname');
    let hiden= document.querySelector('#hides');
    var newImage= imagename.replace(/^.*\\/,"");
    spandum.textContent= newImage;
    hiden.value= newImage;
}
// let check= "<?php echo $idss ?>";
// let id= "<?php echo $ids ?>";
// console.log(check);
// console.log(id);
// if(check!=true){
//     location.href="edit.php?id="+id;
// }
</script>
  </body>

</html>