<?php
include('includes/inex.php');
//require('config/database.php');
$userid = $_SESSION['id'];

// $check= mysqli_query($conn, "SELECT * FROM carts WHERE customer_id='$userid'");
// $numOfItem= mysqli_num_rows($check);

// if ($numOfItem<1) {
//     header('Location: index.php');
// }
$billing = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$userid'");

if (mysqli_num_rows($billing) == 1) {
    $product = mysqli_fetch_assoc($billing);
    $name = explode(' ', $product['fname']);
}


?>
<style>
    body {
        background-color: #E8F5F7;
    }

    .carto {
        border: 3px solid #0d6efd;

    }

    .cartos {
        border: 3px solid lightseagreen;
        margin-top: 5px;
    }

    h1 {
        font-weight: bold;
        color: #267A85;
        margin: 10px;
    }

    .hovers:hover {
        box-shadow: 2px 2px 28px grey;
        cursor: pointer;
    }

    a {
        text-decoration: none;
    }

    .see {
        float: right;
    }

    label {
        font-size: 25px;
        font-weight: bold;
        color: #0d6efd;
    }

    input[type=text],
    input[type=number],
    input[type=email] {
        background-color: #e8f5f7;
        border: 3px solid #0d6efd;
        font-size: 20px;
        color: darkblue;
    }
</style>
<hr class="mb-2">
<div class="container">
    <main>
        <div class="py-3 mb-4 text-center">
            <h1 class="fw-bold text-dark">Checkout form</h1>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill"><?php echo $cart_item ?></span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $grandTotal = 0;
                    $dc_total=0;

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
                                        $total = $rose['fp_price'] * $rowss['quantum'] + $d_charge ;
                                        $grandTotal = $grandTotal + $total;
                                        $dc_total= $dc_total+$d_charge;
                                        if ($d_charge == 0) {
                                            $d_charge = "Free";
                                        }
                    ?>

                                        <li class="list-group-item d-flex justify-content-between lh-sm carto">
                                            <div>
                                                <h6 class="my-0"><?php echo $rose['fp_name'] ?></h6>
                                                <small class="text-muted"><?php echo $rowss['quantum'] ?>..items</small>
                                            </div>
                                            <span class="text-muted">Rs. <?php echo $total ?></span>
                                        </li>
                            <?php

                                    }
                                }
                            }

                            ?>
                    <?php
                        }
                    } else {
                        echo "No products to show";
                    }
                    ?>
                    <li class="list-group-item d-flex justify-content-between cartos">
                        <span>Delivery Charge</span>
                        <span>Rs. <?php echo $dc_total ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between cartos">
                        <strong>Total (Rupee)</strong>
                        <strong>Rs. <?php echo $grandTotal + $dc_total ?></strong>
                    </li>
                </ul>

            </div>
            <div class="col-md-7 col-lg-8">
                <h1 class="mb-3 text-success fw-bold">Billing address</h1>
                <form class="needs-validation" novalidate="" action="includes/checkout.php" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" value="<?php echo $name[0] ?>" name="fname" required>

                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" value="<?php echo $name[1] ?>" name="lname" required>

                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $product['email'] ?>" required>

                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Phone </label>
                            <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $product['contact'] ?>" required>

                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $product['address'] ?>" required>

                        </div>
                    </div>
                    <input type="hidden" name="total" value="<?php echo $grandTotal+$dc_total?>">
                    <input type="hidden" name="c_total" value="<?php echo $dc_total?>">

                    <hr class="my-4">

                    <input class="w-100 btn btn-info btn-lg text-light fw-bold" type="submit" name="checkout" value="PROCEED TO PAYMENT">
                </form>
            </div>
        </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017–2021 KinBech Store</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
</div>
<ul class="list-group userslist" style="position: fixed; top:10.5%;left:15%; width:700px" hidden>

</ul>

<!-- <script>
    let payment = document.querySelector('.payments');
    let paymentDetails = document.querySelector('.card-info');
    let imepay = document.querySelector('.imepay');
    let esewapay = document.querySelector('.esewapay');


    payment.addEventListener('change', function(e) {
        let target = e.target;
        let message;
        switch (target.id) {
            case 'ime':
                imepay.removeAttribute('style');
                paymentDetails.setAttribute('style', 'display: none; visibility:none;');
                esewapay.setAttribute('style', 'display: none; visibility:none;');
                break;
            case 'debit':

                paymentDetails.removeAttribute('style');
                imepay.setAttribute('style', 'display: none; visibility:none;');
                esewapay.setAttribute('style', 'display: none; visibility:none;');
                break;
            case 'esewa':
                esewapay.removeAttribute('style');
                paymentDetails.setAttribute('style', 'display: none; visibility:none;');
                imepay.setAttribute('style', 'display: none; visibility:none;');
                break;
            case 'cash':
                paymentDetails.setAttribute('style', 'display: none; visibility:none;');
                imepay.setAttribute('style', 'display: none; visibility:none;');
                esewapay.setAttribute('style', 'display: none; visibility:none;');

                break;
        }
        console.log(message);
    });
</script> -->
<script src="javascript/inexSearch.js"></script>
<script src="javascript/p-details.js"></script>
<?php
require('includes/footer.php');
?>