<?php

include("../includes/header.php");

?>
  <style>
      body{
      background-color:#E8F5F7;
    } 
      h1{
      font-weight:bold;
      color: #fff;
      margin: 10px;
    }
    .khoi{
        padding:22px;
        background-color:#94E4EF;
        border-radius:20px;
        box-shadow: 10px 10px 19px grey;

    }
    input{
        border:1px solid blue;
    }
  </style>
  <div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
     <div class="p-3 mt-2 bg-warning khoi">
            
        <main class="form-signin mt-5 signup">
        <h1 class="mb-3 fw-bold">Please Signup</h1>
        <form action="#" method="post">
            <div class="error-text"></div>
            <span class="text-warning"><?php //echo $err ?></span>
            <div class="form-floating mb-2 ">
            <input type="text" class="form-control" name="fname" placeholder="Haresh Chaudhary">
            <label for="floatingInput">Full Name</label>
            </div>
            <div class="form-floating mb-2 row-cols-md-2">
            <input type="email" class="form-control" name="email" placeholder="example@hotmail.com">
            <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating mb-2">
            <input type="password" class="form-control" name="password" placeholder="Create Password">
            <label for="floatingPassword">Create Password</label>
            </div>

            <div class="form-floating mb-2">
            <input type="text" class="form-control" name="address" placeholder="Lagankhel, Nepal">
            <label for="floatingInput">Address</label>
            </div>
            <div class="form-floating mb-2">
            <input type="text" class="form-control" name="contact" placeholder="+977 98********">
            <label for="floatingInput">Contact Number</label>
            </div>
            <label for="gender"></label>
            <div class="form-check">
        <input class="form-check-input" type="radio" value="Male" name="flexRadioDefault">
        <label class="form-check-label" for="flexRadioDefault1">
            Male
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" value="Female" name="flexRadioDefault"checked>
        <label class="form-check-label" for="flexRadioDefault2">
            Female
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="radio" value="Other" name="flexRadioDefault">
        <label class="form-check-label" for="flexRadioDefault1">
            Other
        </label>
        </div>

        <div class="button">
        <input class="w-100 btn btn-lg btn-secondary " type="submit" value="Login">
        </div>
        </form>
        </main>
     </div>
    </div>
    <div class="col">
        <div class="p-3 border bg-primary mt-5 py-5 khoi">
            <main class="form-signin mt-5 text-center">
                <form action="../includes/login.php" method="post">
                    <img class="mb-4" src="../admin/avatar.png" alt="" width="80" height="80">
                    <h1 class="mb-3 text-light">Please Signin</h1>
                    <span class="text-warning error-text"></span>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="uname" placeholder="example@hotmail.com">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="pass" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="login">
                    <input class="w-50 mt-3 btn btn-lg btn-light" type="submit" name="login" value="Login">
                    </div>
                </form>
            </main>
        </div>
    </div>
  </div>
</div>

<script src="../javascript/signup.js"></script>

<?php
require('../includes/footer.php');
?>
