<?php
  require('system/connectdb.php');
  session_start();
  
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
  }

  $pages = @$_GET['page'];

  $query = mysqli_query($con, "SELECT * FROM user_list where username = '$user'");
  $result = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOPMC SYSTEM V.1</title>

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
    </style>

    <!-- bootstap script -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<body>

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
          <a class="nav-link active" href="shop.php?page=1">Shop</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Money System
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Topup</a></li>
            <li><a class="dropdown-item" href="#">Withdraw</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item disabled" href="#">???????????????????????? 19.00 ??????????????????</a></li>
          </ul>
        </li>
        <?php if(isset($_SESSION['user'])) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="useredit.php" tabindex="-1" aria-disabled="true">?????????????????????????????????</a>
        </li>

          <?php 
          if($result['role'] === 'user') {
          ?>
          <a class="nav-link" href="registore.php">????????????????????????????????????????????????</a>
          <?php 
          }
          ?>

        <li class="nav-item">
          <a class="nav-link" href="history.php" tabindex="-1" aria-disabled="true">History</a>
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

<!-- itembox -->
<main>

  <div class="album py-5 bg-light">
    <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Shop</li>
      </ol>
    </nav>
<div class="row">
       
<?php 
$perpage = 8;
if (isset($_GET['page'])) {
$page = $_GET['page'];
} else {
$page = 1;
}

$start = ($page - 1) * $perpage;

$sql = "select * from item_list limit {$start} , {$perpage}";
$query = mysqli_query($con, $sql);
$query2 = mysqli_query($con,'SELECT * FROM item_list');
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / 8);
while($result = mysqli_fetch_array($query)) { 

?>
        <div class="col-md-3">
          <div class="card mb-4 shadow-sm">
            <img src="<?=$result['img']?>" alt="" width="100%" height="250">
            <div class="card-body">
              <p class="card-text" style="height:50px;"><?=$result['name']?></p>
              <!-- <small class="text-muted"><?=$result['detail']?></small> -->
              <p class="card-text" style="margin-top:10px;">Seller : <?=$result['useradd']?></p>
              <small class="text-muted">Stock : <?=$result['stock']?></small>
              <div class="d-flex justify-content-between align-items-center" style="margin-top:20px">
                <div class="btn-group">
                  <?php if($result['stock'] > 0) { ?>
                  <a type="button" class="btn btn-success" href="cart.php?id=<?=$result['id']?>">Buy</a>
                  <?php }else{ ?>
                  <a type="button" class="btn btn-danger disabled" href="cart.php?id=<?=$result['id']?>">Sold out</a>
                  <?php } ?>
                </div>
                <small class="text-muted"><?=$result['price']?> BAHT</small>
              </div>
              </div>
            </div>
          </div> 

          
<?php
}
?>

<nav class="d-flex justify-content-center" style="margin-top:70px;">
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
<div class="btn-group me-2" role="group" aria-label="First group">
  <?php for($i=1;$i<=$total_page;$i++){ 
  if($page == $i) {
  ?>
    <a href="shop.php?page=<?php echo $i; ?>" class="text-decoration-none btn btn-primary disabled" style="color:white;"><?php echo $i; ?></a>
  </div>
  <div class="btn-group me-2" role="group" aria-label="First group">
  <?php }else{ ?>
    <a href="shop.php?page=<?php echo $i; ?>" class="text-decoration-none btn btn-primary" style="color:white;"><?php echo $i; ?></a>
 </div>
 <?php 
  }
  } 
  ?>
  
 </nav>

</div>
    </div>
  </div>

</main>

<!-- footer copyright -->
<footer class="text-muted py-5 text-center">
  <div class="container">
    <p class="mb-1">?? Copyright 2021 Website By SHOPMC All Rights Reserved.</p>
    <p class="mb-0">If you want to buy this website <a href="https://www.facebook.com/profile.php?id=100003888862118" class="text-decoration-none">visit the homepage.</a></p>
  </div>
</footer>
    
</body>
</html>