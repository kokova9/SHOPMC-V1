<?php
session_start();
require('../../system/connectdb.php');

$id = @$_GET['id'];
$status = @$_GET['status'];
$userz = @$_GET['users'];

$user = $_SESSION['user'];

$error = array();

if ($status == '1') {

    if(count($error) == 0) {
            $query = "SELECT * FROM verify_store WHERE user_id = $id";
            $result = mysqli_query($con, $query);

        if(isset($result)) {
            $sql = "UPDATE verify_store SET status = 'Verify' WHERE user_id = $id";
            mysqli_query($con, $sql);
            $query = "SELECT * FROM user_list WHERE username = '$userz'";
            $result = mysqli_query($con, $query);
            $sql = "UPDATE user_list SET role = 'seller' WHERE username = '$userz'";
            mysqli_query($con,$sql);
            header('location: ../allowuser.php');
        }else{
            header('location: ../allowuser.php');
        }
    }
}else{
    if(count($error) == 0) {
        $query = "SELECT * FROM verify_store WHERE user_id = $id";
        $result = mysqli_query($con, $query);

    if(isset($result)) {
        $sql = "DELETE FROM verify_store WHERE user_id = $id";
        mysqli_query($con, $sql);
        header('location: ../index.php');
    }else{
        header('location: ../index.php');
    }
}
}
?>