<?php
session_start();
include('../../system/connectdb.php');

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];}
$id = @$_GET['id'];

$error = array();

if (isset($_POST['useredit'])) {
    $points = mysqli_real_escape_string($con, $_POST['points']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $query = mysqli_query($con, "SELECT * FROM user_list where id = '$id'");

    $passwordEnc = md5($password);
    $sql = "UPDATE user_list SET points = '$points' , role = '$role' WHERE id = '$id'";
    mysqli_query($con, $sql);
    header('location: ../user.php');    
}else{
    header('location: ../user.php');
}
?>