<?php
 session_start();
 if (!$_SESSION['username']) {
   header('Location:index.php');
 }

require("../config/database.php");


if (isset($_POST['add'])) {
    $name = $_POST['pname'];
    $brand = $_POST['pbrand'];
    $price = $_POST['pprice'];
    $category = $_POST['pcategory'];
    $ammount = $_POST['pamount'];
    $discount = $_POST['pdiscount'];
    $description = $_POST['pdescription'];
    $delivery = $_POST['delivery'];



    $final_price = $price - ($price * ($discount / 100));

    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if (in_array($img_ext, $extensions) === true) {
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($img_type, $types) === true) {
                $time = time();
                $new_img_name = $time;
                if (move_uploaded_file($tmp_name, "../productImages/" . $new_img_name)) {
                    echo $new_img_name;

                    $query = "INSERT INTO products (fp_name, brand, fp_price, price, fp_category, fp_amount, image, discount, description, delivery) 
                        VALUES ('$name', '$brand', '$final_price', '$price', '$category', '$ammount', '$new_img_name', '$discount', '$description', '$delivery')";

                    $insert_query = mysqli_query($conn, $query);

                    if ($insert_query) {
                        echo "<script>alert('The Product has been added successfully')</script>";
                        echo "<script>window.open('add_product.php', '_self')</script>";
                    } else {
                        echo "insertion Failed !!";
                    }
                } else {
                    echo "Did not moved";
                }
            } else {
                echo "Something went wrong.";
            }
        } else {
            echo "Please upload an image file - jpeg, png, jpg";
        }
    } else {
        echo "Please upload an image file - jpeg, png, jpg";
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
    .add-product {
        width: 100%;
        max-width: 600px;
        padding: 10px;
        margin: auto;
        background-color: #94E4EF;
        border-radius: 15px;
    }

    input[type='submit'] {
        max-width: 400px;
        margin-left: 110px;
    }
</style>

<body>
    <div class="container add-product mt-5">
        <h2 class="text-center text-secondary mb-3">Add Product</h2>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pname" placeholder="Enter Product name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Brand</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pbrand" placeholder="Enter Product Brand">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="pprice" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-select" name="pcategory" aria-label="Default select example" required>
                        <option selected>Choose the Category</option>
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
                <label for="inputPassword3" class="col-sm-2 col-form-label">Amount</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="pamount" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Photo</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" accept="image/x-png,image/gif,image/jpeg,image/jpg" name="image" required>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Discount</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="discount allowed" name="pdiscount" aria-label="Username" required>
                </div> <span style="width:40px; margin-left:-4px;" class="input-group-text">%</span>

            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" placeholder="Leave a Descriptiion here" name="pdescription" id="floatingTextarea" required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Delivery</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox1" name="delivery" value="100" checked>
                        <label class="form-check-label" for="inlineCheckbox1">Delivery Charge Included</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2" name="delivery" value="Free Delivery">
                        <label class="form-check-label" for="inlineCheckbox2">Free Delivery</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <input type="submit" class="btn btn-primary text-center" value="Add" name="add">

            </div>


        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>