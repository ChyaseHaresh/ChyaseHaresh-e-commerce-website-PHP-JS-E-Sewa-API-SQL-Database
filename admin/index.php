<?php
  require("../config/database.php");
  session_start();
  $err="";

  if (isset($_POST['login'])) {
    $usr=$_POST['username'];
    $pass=$_POST['password'];

    $query="SELECT * FROM admins WHERE username='$usr'";
    $sql= mysqli_query($conn,$query);

    if(mysqli_num_rows($sql) > 0){

      $row= mysqli_fetch_assoc($sql);
      if ($row['password']==$pass) {
          $_SESSION['username']=$row['username'];
          header('Location: dashboard.php');
      }
    }
    else {
      $err+="The username and password do ot match !";
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

    <title>Admin-Login</title>
  </head>
  
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .form-signin {
    width: 100%;
    max-width: 400px;
    padding: 1px;
    margin: auto;
}
main {
    display: block;
}
.text-center {
    text-align: center!important;
}
body{
      background-color:#E8F5F7;
    }
    form{
        padding:22px;
        background-color:#94E4EF;
        border-radius:20px;
        box-shadow: 10px 10px 19px grey;

    }
    </style>

  <body  class="text-center">
  <main class="form-signin mt-5">
  <form action="index.php" method="post">
    <img class="mb-4" src="avatar.png" alt="" width="80" height="80">
    <h1 class="h3 mb-3 fw-normal">Admin Signin</h1>
    <span class="text-warning"><?php echo $err ?></span>
    <div class="form-floating mb-2">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="ace121">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating mb-2">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <button class="w-100 btn btn-lg btn-secondary" type="submit" name="login">Login</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

   
  </body>
</html>