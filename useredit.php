<?php
require('system/connectdb.php');
session_start();

if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];
}

$query = mysqli_query($con, "SELECT * FROM user_list where username = '$user'");
$result = mysqli_fetch_array($query);
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
          <a class="nav-link active" href="useredit.php" tabindex="-1" aria-disabled="true">แก้ไขข้อมูล</a>
        </li>

          <?php 
          if($result['role'] === 'user') {
          ?>
          <a class="nav-link" href="registore.php">ลงทะเบียนร้านค้า</a>
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



<?php 
if(isset($_SESSION['user'])) { 
?>
<div class="d-flex justify-content-center">
<div class="container" style="width=100%;margin-top:50px">
  <h1 class="text-center" >Edit System</h1>
  <form class="px-4 py-3" style="margin-top:30px" method="POST" action="system/changepw.php">
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Username</label>
      <input type="username" class="form-control" id="exampleDropdownFormUsername1" placeholder="Username" name="username" value="<?php echo $_SESSION['user'] ?>" disabled>
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password" name="password" required>
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Points</label>
      <input type="number" class="form-control" id="exampleDropdownFormEmail1" name="point" value="<?=$result['points']?>" disabled>
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Money</label>
      <input type="number" class="form-control" id="exampleDropdownFormEmail1" name="point" value="<?=$result['money']?>" disabled>
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Role</label>
      <input type="text" class="form-control" id="exampleDropdownFormEmail1" name="rank" value="<?=$result['role']?>" disabled>
    </div>
    <button type="submit" class="btn btn-warning" name="pwd_user">Edit</button>
  </form>
  <div class="dropdown-divider"></div>
</div>
</div>



<!-- footer website -->
<footer class="footer mt-auto py-3 bg-light text-center">
  <div class="container">
    <span class="text-muted">ดูหนังออนไลน์ฟรี ดูหนังดีๆ ต้องที่นี่ <a href="testphp.php" class="text-decoration-none">BrownMovies</a></span>
  </div>
  <span class="text-muted">Create by MahapolShop.</span>
</footer>

<?php 
} else { 
echo "<script>window.location.href = 'index.php'</script>";
session_destroy();
} 
?>
    </body>
</html>