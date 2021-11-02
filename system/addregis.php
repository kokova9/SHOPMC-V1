<?php
session_start();
require('connectdb.php');

$username = $_SESSION['user'];

$error = array();

if (isset($_POST['reg_store'])) {
    $piclink = mysqli_real_escape_string($con, $_POST['picturelink']);

    $user_check_query = "SELECT * FROM user_list WHERE username = '$username' OR email = '$email'";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if(count($error) == 0) {
        $passwordEnc = md5($password);
        $sql = "INSERT INTO verify_store (username,img) VALUES ('$username','$piclink')";
        mysqli_query($con, $sql);
        header('location: ../registore.php');
    }else{
        header('location: ../registore.php');
    }
}else{
    header('location: ../registore.php');
}
?>