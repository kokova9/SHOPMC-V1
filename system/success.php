<?php
require('connectdb.php');
session_start();
$user = $_SESSION['user'];
$code = $_SESSION['codee'];

$id = @$_GET['id'];

if(isset($code)) {

    $query = mysqli_query($con, "SELECT * FROM code_list where code = '$code'");
    $result = mysqli_fetch_array($query);
    $stock = $result['stock'];
    if($result['stock'] > 1) {
        $sql = "UPDATE code_list SET stock = $stock-1 WHERE code = '$code'";
        mysqli_query($con, $sql);
    }else{
    $sql = "DELETE FROM code_list WHERE code = '$code'";
    mysqli_query($con, $sql);
    }
}

$query = mysqli_query($con, "SELECT * FROM user_list where username = '$user'");
$result = mysqli_fetch_array($query);
$points = $result['points'];
if($result['points'] > $_SESSION['discountt']) {
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BrownMovies ชีวิตนี้มีแต่หนัง</title>
        <meta charset="UTF-8">
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
          <a class="nav-link" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../shop.php?page=1">Shop</a>
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
          <a class="nav-link" href="../useredit.php" tabindex="-1" aria-disabled="true">แก้ไขข้อมูล</a>
        </li>

          <?php 
          if($result['role'] === 'user') {
          ?>
          <a class="nav-link" href="../registore.php">ลงทะเบียนร้านค้า</a>
          <?php 
          }
          ?>

        <li class="nav-item">
          <a class="nav-link" href="../history.php" tabindex="-1" aria-disabled="true">History</a>
        </li>

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



<div class="album py-5 bg-light">
    <div class="container">
    
<div class="row d-flex justify-content-center">
       
<?php 
$query = mysqli_query($con,"SELECT * FROM item_list WHERE id = $id");
$result = mysqli_fetch_array($query);
$stock = $result['stock'];

$ownitem = $result['useradd'];

$sql = "UPDATE item_list SET stock = $stock-1 WHERE id = $id";
mysqli_query($con, $sql);
?>
    <h3 class="text-center" style="margin-bottom:30px;">Your order has been received.</h3>
        <div class="col-md-3"> 
          <div class="card mb-4 shadow-sm">
            <img src="<?=$result['img']?>" alt="" width="100%" height="250">
            <div class="card-body">
              <p class="card-text"><?=$result['name']?></p>
              <small class="text-muted"><?=$result['detail']?></small>
              <p class="card-text" style="margin-top:10px;">Seller : <?=$result['useradd']?></p>
              <small class="text-muted">Stock : <?=$result['stock']-1?></small>
              <div class="d-flex justify-content-between align-items-center" style="margin-top:20px">
                <div class="btn-group">
                  <small class="text-muted"><?php echo $result['price']-$_SESSION['discountt']+45?> BAHT</small>
                  
                </div>
                
              </div>
              </div>
            </div>
            <a type="button" class="btn btn-success d-flex justify-content-center" href="../history.php">History</a>
          </div> 
<?php
  $price = $result['price']-$_SESSION['discountt']+45;
  $itemname = $result['name'];
  $lspoints = $points-$price
?>

</div>
    </div>
  </div>

</main>

<?php
    $query = mysqli_query($con,"SELECT * FROM history_list");
    mysqli_query($con,"INSERT INTO history_list (username,item,price,ownitem) VALUES ('$user','$itemname',$price,'$ownitem')");
    $query = mysqli_query($con,"SELECT * FROM user_list");
    mysqli_query($con,"UPDATE user_list SET points = '$lspoints' WHERE username = '$user'");
?>



<!-- footer copyright -->
<footer class="text-muted py-5 text-center">
  <div class="container">
    <p class="mb-1">© Copyright 2021 Website By SHOPMC All Rights Reserved.</p>
    <p class="mb-0">If you want to buy this website <a href="https://www.facebook.com/profile.php?id=100003888862118" class="text-decoration-none">visit the homepage.</a></p>
  </div>
</footer>

<?php
unset($_SESSION['codee']);
unset($_SESSION['discountt']);
?>

    </body>
</html>

<?php
}else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>BrownMovies ชีวิตนี้มีแต่หนัง</title>
        <meta charset="UTF-8">
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
          <a class="nav-link" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../shop.php?page=1">Shop</a>
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
          <a class="nav-link" href="../useredit.php" tabindex="-1" aria-disabled="true">แก้ไขข้อมูล</a>
        </li>

          <?php 
          if($result['role'] === 'user') {
          ?>
          <a class="nav-link" href="../registore.php">ลงทะเบียนร้านค้า</a>
          <?php 
          }
          ?>

        <li class="nav-item">
          <a class="nav-link" href="../history.php" tabindex="-1" aria-disabled="true">History</a>
        </li>

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



<div class="album py-5 bg-light">
    <div class="container">
    
<div class="row d-flex justify-content-center">
       
    <h3 class="text-center">Can't buy this!!</h3>
                
             
</div>
    </div>
  </div>

</main>

<!-- footer copyright -->
<footer class="text-muted py-5 text-center">
  <div class="container">
    <p class="mb-1">© Copyright 2021 Website By SHOPMC All Rights Reserved.</p>
    <p class="mb-0">If you want to buy this website <a href="https://www.facebook.com/profile.php?id=100003888862118" class="text-decoration-none">visit the homepage.</a></p>
  </div>
</footer>

<?php
unset($_SESSION['codee']);
unset($_SESSION['discountt']);
?>

    </body>
</html>
<?php
}
?>
