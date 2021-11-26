<?php
    require("../config/database.php");
    $id=$_GET['id'];

    $sql1=mysqli_query($conn,"SELECT * FROM carts WHERE cart_id='$id'");
        if (mysqli_num_rows($sql1)>0) {
            $rows=mysqli_fetch_assoc($sql1);
            $pid=$rows['product_id'];
            $quantity= $rows['quantum'];
        }
    $sql=mysqli_query($conn, "DELETE FROM carts WHERE cart_id='$id'");
    if ($sql) {
        

            $sql2=mysqli_query($conn,"SELECT fp_amount FROM products WHERE fp_id='$pid'");
            if (mysqli_num_rows($sql2)>0) {
                $row=mysqli_fetch_assoc($sql2);
                $amt=$row['fp_amount'];
                $remains=$amt+$quantity;

                $sql3= mysqli_query($conn,"UPDATE products SET fp_amount='$remains' WHERE fp_id=$pid");
                if ($sql3) {
                    header('Location: carts.php');
                }
                else {
                    echo "<script>alert('There  was problem removing items in carts')</script>";
                    header('Location: cart.php?id=$pid');
                }
            }
            else {
                echo "<script>alert('There  was problem removing items in carts')</script>";
                header('Location: ../classes/cart.php?id=$pid');
            }
        
        //header('Location: carts.php');
    }
    else {
        echo "<script>alert('There was problem removing item from cart.')</script>";
        header('Location: carts.php');
    }
