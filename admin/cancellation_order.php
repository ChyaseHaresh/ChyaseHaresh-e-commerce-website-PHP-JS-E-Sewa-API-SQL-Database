<?php

session_start();
if (!$_SESSION['username']) {
    header('Location:index.php');
}

require("../config/database.php");


$res = $_GET['opid'];
$query = mysqli_query($conn, "SELECT * FROM ordered_product WHERE customer_id='$res'");
if (mysqli_num_rows($query) > 0) {

    while ($rowss = mysqli_fetch_assoc($query)) {
        $kop = $rowss['product_id'];
        echo "first  .";

        $data = mysqli_query($conn, "SELECT quants FROM ordered_product WHERE product_id='$kop'");
        $cart_item = mysqli_num_rows($data);
        if (mysqli_num_rows($data) > 0) {
            $p_id = array();
            while ($rose = mysqli_fetch_assoc($data)) {
                $pp = $rose['quants'];
                echo "Second  .";

                $data23 = mysqli_query($conn, "SELECT fp_amount FROM products WHERE fp_id='$kop'");
                while ($roses = mysqli_fetch_assoc($data23)) {
                    echo "third  .";
                    $khoi = $roses['fp_amount'];
                    $quanti = $khoi + $pp;

                    $sql = mysqli_query($conn, "UPDATE products SET fp_amount='$quanti' WHERE fp_id='$kop'");
                    if ($sql) {
                        echo "fourth  .";

                        $sql2 = mysqli_query($conn, "DELETE FROM ordered_product WHERE customer_id='$res'");
                        if ($sql2) {
                            # code...
                            $sql3 = mysqli_query($conn, "DELETE FROM orders WHERE customer_id='$res'");
                            if ($sql3) {
                                header("Location: orders.php");

                                # code...
                            }
                        }
                    }
                }
            }
        }
    }
}
