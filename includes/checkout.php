<?php
include("header.php");

if (!$_SESSION['id']) {
    header('Location:index.php');
}
$totas = $_POST['total'] + 50;

$invoice = $_SESSION['id'] . time();

require("../config/database.php");
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$sesid = $_SESSION['id'];

$sql = mysqli_query($conn, "INSERT INTO `orders` (`customerId`, `fname`, `lname`, `email`, `address`, `contact`, `date`, `payment`, `invoice`, `total`)
VALUES ('$sesid', '$fname', '$lname', '$email', '$address', '$phone', NOW(), 'unknown', '$invoice', '$totas')");
if ($sql) {

    $sql1 = mysqli_query($conn, "SELECT * FROM carts WHERE customer_id='$sesid'");
    if (mysqli_num_rows($sql1) > 0) {
        while ($row = mysqli_fetch_assoc($sql1)) {
            $pid = $row['product_id'];
            $quantity = $row['quantum'];
            $query = mysqli_query($conn, "INSERT INTO `ordered_product` (`customer_id`, `product_id`, `quants`)
            VALUES ('$sesid', '$pid', '$quantity')");

            $query = mysqli_query($conn, "INSERT INTO `temporary` (`customer_id`, `product_id`, `quants`)
            VALUES ('$sesid', '$pid', '$quantity')");
        }
        $sql2 = mysqli_query($conn, "DELETE FROM `carts` WHERE customer_id='$sesid'");
    }
} else {
    echo "<script>
    alert('There  was problem in checking out')
</script>";
    header('Location: ../checkout.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Order Details</title>
</head>
<style>
    .detail span {
        font-size: 1.5em;
    }
</style>

<body>


    <main class="mx-5 my-5">
        <div class="chartjs-size-monitor">
            <div class="chartjs-size-monitor-expand">
                <div class=""></div>
            </div>
            <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-6">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-info" style="font-size: 40px;">Ordered Items</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $grandTotal = 0;
                    $dc_total = 0;


                    $res = $_SESSION['id'];
                    $query = mysqli_query($conn, "SELECT * FROM temporary WHERE customer_id='$res'");
                    if (mysqli_num_rows($query) > 0) {

                        while ($rowss = mysqli_fetch_assoc($query)) {
                            $kop = $rowss['product_id'];
                            $i = 2;

                            $data = mysqli_query($conn, "SELECT * FROM products WHERE fp_id='$kop'");
                            $cart_item = mysqli_num_rows($data);
                            if (mysqli_num_rows($data) > 0) {
                                $p_id = array();
                                while ($rose = mysqli_fetch_assoc($data)) {
                                    $i = $i + 1;
                                    $d_charge = $rose['delivery_charge'];
                                    $total = ($rose['fp_price'] * $rowss['quants']) + $d_charge;
                                    $grandTotal = $grandTotal + $total;
                                    $dc_total = $dc_total + $d_charge;

                                    if ($d_charge == 0) {
                                        $d_charge = "Free";
                                    }
                    ?>

                                    <li style="border: solid 2px lightseagreen;" class="list-group-item d-flex justify-content-between lh-sm mb-1">
                                        <div class="contents d-flex justify-content-between">
                                            <img class="mx-2" src="../productImages/<?php echo $rose['image'] ?>" width="110">
                                            <div class="mx-3">
                                                <h6 class="fw-bold text-primary "><?php echo $rose['fp_name'] ?></h6>
                                                <small class="text-muted"><?php echo $rowss['quants'] . " " ?>Pieces</small><br>
                                                <small class="text-muted"><?php echo "Rs. " . $rose['fp_price'] . " " ?>Each</small><br>
                                                <small class="text-muted"><?php echo $rose['fp_category'] ?></small><br>
                                                <small class="text-muted"><?php echo $rose['brand'] ?></small>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="fw-bold text-secondary">Rs. <?php echo $d_charge ?></span><br>
                                            <span class="fw-bold text-secondary">Rs. <?php echo $total ?></span>
                                        </div>
                                    </li>
                        <?php

                                }
                            }
                        }

                        ?>
                    <?php
                    }

                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="h5 fw-bold">Total (Rupee)</span>
                        <strong class="h5 fw-bold"><?php echo $grandTotal ?></strong>
                    </li>
                </ul>

            </div>


            <div class="col-md-7 col-lg-6 detail my-5 order-md-last align-items-center">
                <h1 class="mb-5 text-primary fw-bold">Payment Methods</h1>
                <div class="d-flex justify-content-between">
                    <div class="">


                        <form action="https://uat.esewa.com.np/epay/main" method="POST">
                            <input value="<?php echo $grandTotal + $dc_total + 50 ?>" name="tAmt" type="hidden">
                            <input value="<?php echo $grandTotal ?>" name="amt" type="hidden">
                            <input value="0" name="txAmt" type="hidden">
                            <input value="50" name="psc" type="hidden">
                            <input value="<?php echo $dc_total ?>" name="pdc" type="hidden">
                            <input value="EPAYTEST" name="scd" type="hidden">
                            <input value="<?php echo $invoice ?>" name="pid" type="hidden">
                            <input value="http://localhost/e-commerce-site/payment_methods/esewa_payment_success.php?q=su" type="hidden" name="su">
                            <input value="http://localhost/e-commerce-site/payment_methods/esewa_payment_failed.php?q=fu" type="hidden" name="fu">
                            <input type="image" src="../images/esewa.png" width="120">
                        </form>

                    </div>
                    <div class=""><input type="image" src="../images/imepay.png" width="120"></div>
                    <div class=""><input type="image" src="../images/khalti.png" width="120"></div>
                    <div class=""><input type="image" src="../images/cards.png" width="120"></div>
                    <div class=""><input type="image" src="../images/cash.png" width="120"></div>
                </div>
            </div>
        </div>
    </main>
    </div>
    </div>


    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>

    <?php include("footer.php") ?>
    <!-- function put_order($invoice)
{

} -->