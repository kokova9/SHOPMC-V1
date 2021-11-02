<?php
  require('../system/connectdb.php');
  session_start();
  if(isset($_SESSION['user'])){
  $user = $_SESSION['user'];}
  $id = @$_GET['id'];

  $query = mysqli_query($con,"SELECT * FROM user_list where username = '$user'");
  $result = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BACKEND SHOPMC SYSTEM V.1</title>

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
            <li><a class="dropdown-item disabled" href="#">ถอนเงินได้ตั้งแต่ 19.00</a></li>
          </ul>
        </li>
        <?php if(isset($_SESSION['user'])) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="../useredit.php" tabindex="-1" aria-disabled="true">แก้ไขข้อมูล</a>
        </li>
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
        <a class="btn btn-outline-success" type="button" id="loginSystem" href="../system/checklogin.php"><?php 
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
    if($result['role'] === 'seller' || $result['role'] === 'admin') {
?>

<!-- itembox -->
<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">BACKEND SHOPMC SYSTEM V.1</h1>
        <p class="lead text-muted">ระบบหลังบ้านจัดการร้านค้าออนไลน์</p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Backend</li>
      </ol>
    </nav>
<div class="row">
       
<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="list-group">
         <a href="index.php" class="list-group-item list-group-item-action">เพิ่มสินค้าลงขาย</a>
         <a href="edit.php" class="list-group-item list-group-item-action">แก้ไขสินค้าที่ลงขาย</a>
         <a href="#" class="list-group-item list-group-item-action">จำนวนเงินที่ได้</a>
         <a href="buying.php" class="list-group-item list-group-item-action">จัดการคำสั่งซื้อ</a>
         <?php 
         if($result['role'] == 'admin') {
         ?>
         <a href="allowuser.php" class="list-group-item list-group-item-action">คำขอลงทะเบียนร้านค้า</a>
         <a href="addcode.php" class="list-group-item list-group-item-action">เพิ่มคูปองส่วนลดสินค้า</a>
         <a href="code.php" class="list-group-item list-group-item-action">จัดการคูปองส่วนลด</a>
         <a href="user.php?page=1" class="list-group-item list-group-item-action active">จัดการสมาชิก</a>
         <?php
         }
         ?>
      </div>
    </div>
  
    <?php if(!isset($id)) { ?>
    
  <div class="col-9">
    <div class="row d-flex justify-content-center" style="text-align:center;">
       
       <table>
       <tr>
       <td>User</td>
       <td>Point</td>
       <td>Role</td>
       <td></td>
       </tr>
  <?php 
        $perpage = 8;
        if (isset($_GET['page'])) {
        $page = $_GET['page'];
        } else {
        $page = 1;
        }
        
        $start = ($page - 1) * $perpage;
        
        $sql = "select * from user_list limit {$start} , {$perpage}";
        $query = mysqli_query($con, $sql);
        $query2 = mysqli_query($con,'SELECT * FROM user_list');
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / 8);
        while($result = mysqli_fetch_array($query)) {
    ?>
        
       <tr>
       <td><?=$result['username']?></td>
       <td><input type="number" name="point" value="<?=$result['points']?>" disabled></td>
       <td><?=$result['role']?></td>
       <td><a type="button" class="btn btn-warning" href="user.php?id=<?=$result['id']?>">Edit</a></td>
       </tr>
<?php
}
        
?>

       </table>

       <nav class="d-flex justify-content-center" style="margin-top:70px;">
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
<div class="btn-group me-2" role="group" aria-label="First group">
  <?php for($i=1;$i<=$total_page;$i++){ 
  if($page == $i) {
  ?>
    <a href="user.php?page=<?php echo $i; ?>" class="text-decoration-none btn btn-primary disabled" style="color:white;"><?php echo $i; ?></a>
  </div>
  <div class="btn-group me-2" role="group" aria-label="First group">
  <?php }else{ ?>
    <a href="user.php?page=<?php echo $i; ?>" class="text-decoration-none btn btn-primary" style="color:white;"><?php echo $i; ?></a>
 </div>
 <?php 
  }
  } 
  ?>
  
 </nav>

</div>
          
    <?php
    
  }else{
    $query = mysqli_query($con,"SELECT * FROM user_list WHERE id = '$id'");
    $result = mysqli_fetch_array($query);
?>
  <form class="px-4 py-3" method="POST" action="system/edituser.php?id=<?=$result['id']?>">
  <?php
  ?>
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Username</label>
      <input type="text" class="form-control" id="exampleDropdownFormEmail1" placeholder="Itemname" name="username" value="<?=$result['username']?>" disabled>
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">Points</label>
      <input type="text" class="form-control" id="exampleDropdownFormPassword1" placeholder="Picturelink" name="points" value="<?=$result['points']?>">
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">Role : </label>
      <select name="role" id="role">
        <option value="user">User</option>
        <option value="seller">Seller</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <button type="submit" class="btn btn-warning" name="useredit">Edit user</button>
  </form>
    <?php } ?>
  <h4 class="text-center" style="margin-bottom:20px;color:red;"><?php 
  if(isset($_SESSION['add_suc'])) {
  echo $_SESSION['add_suc']; 
  unset($_SESSION['add_suc']); }
  ?></h4>
  </div>
  </div>
</div>

</div>
    </div>
  </div>

</main>

<?php
    }else{
      echo "<script>window.location.href = '../index.php'</script>";
    }
?>

<!-- footer copyright -->
<footer class="text-muted py-5 text-center">
  <div class="container">
    <p class="mb-1">© Copyright 2021 Website By SHOPMC All Rights Reserved.</p>
    <p class="mb-0">If you want to buy this website <a href="https://www.facebook.com/profile.php?id=100003888862118" class="text-decoration-none">visit the homepage.</a></p>
  </div>
</footer>
    
</body>
</html>