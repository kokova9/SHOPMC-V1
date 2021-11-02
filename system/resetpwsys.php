<?php
session_start();
require('connectdb.php');

$error = array();

if (isset($_POST['res_pw'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $user_check_query = "SELECT * FROM user_list WHERE username = '$username' or email = '$username'";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if(count($error) == 0) {
        $passwordEnc = md5($password);
        $query = "SELECT * FROM user_list WHERE username = '$username' or email = '$username'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) == 1) {
            $_SESSION['res_fin'] = 'User '.$username.' has been reset password.';
            header('location: ../resetpw.php');
        }else{
            $_SESSION['res_fin'] = 'Username or Email incorrect.';
            header('location: ../resetpw.php');
        }
    }
}else{
    header('location: ../resetpw.php');
}
?>