<?php
session_start();
require('connectdb.php');

$error = array();
$id = @$_GET['id'];


if (isset($_POST['redeem'])) {
    $coder = mysqli_real_escape_string($con, $_POST['codee']);

    $user_check_query = "SELECT * FROM code_list WHERE code = '$coder'";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_array($query);

    $user_check_query1 = "SELECT * FROM item_list WHERE id = $id";
    $query1 = mysqli_query($con, $user_check_query1);
    $result1 = mysqli_fetch_array($query1);

    if(isset($result)) {
        if($result['ifs'] < $result1['price']) {
            $_SESSION['discount'] = $result['discount'];
            $_SESSION['discountt'] = $result['discount'];
            $_SESSION['code'] = $result['code'];
            $_SESSION['codee'] = $result['code'];
        header('location: ../cart.php?id='.$id.'');
        }else{
            $_SESSION['code_err'] = "Can't use this code.";
            header('location: ../cart.php?id='.$id.'');
        }
        
    }else{
        header('location: ../login.php');
        }
}else{
    header('location: ../login.php');
}
?>