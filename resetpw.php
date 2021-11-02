<?php
require('system/connectdb.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</head>
<body style="margin:0;">

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SHOPMC</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shop.php?page=1">Shop</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Money System
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Topup</a></li>
            <li><a class="dropdown-item" href="#">Withdraw</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item disabled" href="#">เงินเข้า 19.00 ทุกวัน</a></li>
          </ul>
        </li>
        <?php if(isset($_SESSION['user'])) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="useredit.php" tabindex="-1" aria-disabled="true">แก้ไขข้อมูล</a>
        </li>

          <?php 
          if($result['role'] === 'user') {
          ?>
          <a class="nav-link" href="registore.php">ลงทะเบียนร้านค้า</a>
          <?php 
          }
          ?>

        <?php 
        }?>
      </ul>
      <form class="d-flex">
      <a class="nav-link disabled" href="" tabindex="-1" aria-disabled="true" id="username"><?php 
      if(isset($_SESSION['user'])) {
        echo $_SESSION['user']; 
        }
        ?></a>
        <a class="btn btn-outline-success" type="button" id="loginSystem" href="system/checklogin.php"><?php 
      if(isset($_SESSION['user'])) {
        echo 'Logout';
        }else{
        echo 'Login';
        }
        ?>
      </a>
      </form>
    </div>
  </div>
</nav>





<div class="d-flex justify-content-center">
<div class="container" style="width=100%;margin-top:50px">
  <h1 class="text-center" >Reset Password</h1>
  <form class="px-4 py-3" style="margin-top:30px" method="POST" action="system/resetpwsys.php">
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Username or Email</label>
      <input type="username" class="form-control" id="exampleDropdownFormEmail1" placeholder="Username or Email" name="username">
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">New Password</label>
      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password" name="password">
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary" name="res_pw">Reset password</button>
  </form>
  <h4 class="text-center" style="margin-bottom:20px;color:red;"><?php 
  if(isset($_SESSION['res_fin'])){
    echo $_SESSION['res_fin'];
    unset($_SESSION['res_fin']); 
  }
  
  ?></h4>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="login.php">Go to Sign in</a>
</div>
</div>
</body>
</html>