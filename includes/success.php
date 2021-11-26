<?php
require("header.php");
$refId=$_GET['refid'];

if (!isset($refId)) {
    header('Location: ../index.html');
}

?>


<div>
    <h1 class="text-success  d-flex justify-content-center" style="font-size: 60px; padding-top:100px;">
        THE ORDER HAS BEEN MADE SUCCESSFULLY 😄😄
    </h1>
    <h1 class="text-info  d-flex justify-content-center" style="font-size: 40px; padding-top:100px;">
        You will soon be contacted by our team for the further details.
    </h1>

    <h1 class="text-primary  d-flex justify-content-center" style="font-size: 50px; padding-top:100px;">
        Thank You for Choosing our platform. 😁❤...
    </h1>
</div>

<?php
$sql= mysqli_query($conn, "DELETE FROM temporary WHERE customer_id='$id'");

$sql2= mysqli_query($conn, "UPDATE orders SET payment='E-Sewa', status='1' WHERE customerId='$id'");


require("footer.php")
?>