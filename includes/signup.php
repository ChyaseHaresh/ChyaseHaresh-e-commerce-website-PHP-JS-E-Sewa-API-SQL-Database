<?php
    session_start();
    include_once "../config/database.php";

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $gender= mysqli_real_escape_string($conn, $_POST['flexRadioDefault']);

    if(!empty($fname) && !empty($contact) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{
                $encrypt_pass = md5($password);
                $insert_query = mysqli_query($conn, "INSERT INTO users (fname, email, password, address, contact, gender)
                VALUES ('{$fname}','{$email}', '{$encrypt_pass}', '{$address}', '{$contact}', '{$gender}')");
                if($insert_query){
                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                    if(mysqli_num_rows($select_sql2) > 0){
                        $result = mysqli_fetch_assoc($select_sql2);
                        $usr = $result['fname'];
                        $_SESSION['id']= $result['user_id'];
                        $usrname= explode(' ', $usr);
                        $_SESSION['user']= current($usrname);
                        echo "success";
                    }else{
                        echo "This email address not Exist!";
                    }
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }

?>