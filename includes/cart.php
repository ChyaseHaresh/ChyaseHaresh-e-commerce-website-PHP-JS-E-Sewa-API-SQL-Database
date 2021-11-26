<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
}
$uid=$_SESSION['id'];
$pid=$_GET['id'];
$quantity=$_GET['quantity'];
require_once("../config/database.php");
echo $id." ".$quantity;
$flag=true;
$quer=mysqli_query($conn, "SELECT product_id FROM carts WHERE customer_id='$uid'");
if (mysqli_num_rows($quer)>0) {
    while ($row=mysqli_fetch_assoc($quer)) {
         if ($row['product_id']==$pid) {
              $flag=false;
         }
    }
}
if ($flag==true) {
    # code...
    $query="INSERT INTO carts(customer_id, product_id, quantum) VALUES('$uid', '$pid', '$quantity')";
    $sql= mysqli_query($conn, $query);
    if ($sql) {

        $sql2=mysqli_query($conn,"SELECT fp_amount FROM products WHERE fp_id='$pid'");
        if (mysqli_num_rows($sql2)>0) {
            $row=mysqli_fetch_assoc($sql2);
            $amt=$row['fp_amount'];
            $remains=$amt-$quantity;

            $sql3= mysqli_query($conn,"UPDATE products SET fp_amount='$remains' WHERE fp_id=$pid");
            if ($sql3) {
                header('Location: carts.php');
            }
            else {
                echo "<script>alert('There  was problem adding items in carts')</script>";
                header('Location: cart.php?id=$pid');
            }
        }
        else {
            echo "<script>alert('There  was problem adding items in carts')</script>";
            header('Location: ../classes/cart.php?id=$pid');
        }
    }
    else {
        echo "<script>alert('There  was problem adding items in carts')</script>";
        header('Location: ../classes/cart.php?id=$pid');
    }
}
else {
    echo "<script>alert('The item is already in the cart')</script>";
    header('Location: carts.php');
}

?>