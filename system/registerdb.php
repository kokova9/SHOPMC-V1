<?php
session_start();
require('connectdb.php');

$error = array();

if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $user_check_query = "SELECT * FROM user_list WHERE username = '$username' OR email = '$email'";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if($result) {
        if($result['username'] === $username) {
            array_push($error,'this username has already register');
        }
        if($result['email'] === $email) {
            array_push($error,'this email has already register');
        }
    }

    if(count($error) == 0) {
        $passwordEnc = md5($password);
        $sql = "INSERT INTO user_list (username,password,email) VALUES ('$username','$password','$email')";
        mysqli_query($con, $sql);
        header('location: ../login.php');
    }else{
        $_SESSION['reg_fail'] = 'Username or Email has been registered';
        header('location: ../register.php');
    }
}else{
    header('location: ../register.php');
}
?>