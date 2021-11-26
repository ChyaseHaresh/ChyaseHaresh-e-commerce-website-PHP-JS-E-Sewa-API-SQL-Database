<?php 
    session_start();
    include_once "../config/database.php";
    $email = mysqli_real_escape_string($conn, $_POST['uname']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $ids=$_POST['id'];

    if(!empty($email) && !empty($password)){
        
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if($user_pass === $enc_pass){
                $usr = $row['fname'];
                $_SESSION['id']= $row['user_id'];
                $usrname= explode(' ', $usr);
                $_SESSION['user']= current($usrname);
                echo "success";
               // echo $ids;
               
            }else{
                echo "Email or Password is Incorrect!";
            }
        }else{
            echo "$email - This email not Exist!";
        }
    }else{
        echo "All input fields are required!";
    }
?>