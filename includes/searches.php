<?php
    session_start();
    include_once "../config/database.php";

    //$outgoing_id = $_SESSION['unique_id'];
    $term=$_POST['searchTerm'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM products WHERE fp_name LIKE '%{$searchTerm}%' OR fp_category LIKE '%{$searchTerm}%'";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        $row=mysqli_fetch_assoc($query);
        $product=$row['fp_name'];
        $output.= '<a href="classes/productdetails.php?id='.$row['fp_id'].'" class="list-group-item list-group-item-action fw-bold seachList">'.$product.'</a>';
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>
