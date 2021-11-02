<?php
session_start();
include('connectdb.php');

$user = $_SESSION['user'];

$error = array();

if (isset($_POST['pwd_user'])) {
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = mysqli_query($con, "SELECT * FROM user_list where username = '$user'");

    $passwordEnc = md5($password);
    $sql = "UPDATE user_list SET password = '$password' WHERE username = '$user'";
    mysqli_query($con, $sql);
    header('location: ../index.php');    
}else{
    header('location: ../login.php');
}
?>