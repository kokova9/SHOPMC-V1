<?php
session_start();
require('connectdb.php');

$error = array();

if (isset($_POST['log_user'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $user_check_query = "SELECT * FROM user_list WHERE username = '$username' and password = '$password'";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if(count($error) == 0) {
        $passwordEnc = md5($password);
        $query = "SELECT * FROM user_list WHERE username = '$username' and password = '$password'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) == 1) {
            $_SESSION['user'] = $username;
            header('location: ../index.php');
        }else{
            $_SESSION['failed'] = 'Username or Password incorrect.';
            header('location: ../login.php');
        }
    }
}else{
    header('location: ../login.php');
}
?>