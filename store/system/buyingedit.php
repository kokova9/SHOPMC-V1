<?php
session_start();
require('../../system/connectdb.php');
$id = @$_GET['id'];

$user = $_SESSION['user'];

$error = array();

if (isset($_POST['edit_buying'])) {
    $tracking = mysqli_real_escape_string($con, $_POST['tracknum']);

    if(count($error) == 0) {
            $query = "SELECT * FROM history_list WHERE id = $id";
            $result = mysqli_query($con, $query);

        if(isset($result)) {
            $sql = "UPDATE history_list SET tracking = '$tracking' WHERE id = $id";
            mysqli_query($con, $sql);
            $_SESSION['edit_suc'] = 'Edit tracking Successful.';
            header('location: ../buying.php');
        }else{
            $_SESSION['edit_suc'] = "Tracking can't edit!";
            header('location: ../buying.php');
        }
    }
    }else{
    header('location: ../edit.php');
    }
?>