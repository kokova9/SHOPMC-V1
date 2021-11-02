<?php
session_start();
require('../../system/connectdb.php');
$id = @$_GET['id'];

$user = $_SESSION['user'];

$error = array();

if (isset($_POST['edit_item'])) {
    $itemname = mysqli_real_escape_string($con, $_POST['itemname']);
    $picturelink = mysqli_real_escape_string($con, $_POST['picturelink']);
    $detail = mysqli_real_escape_string($con, $_POST['detail']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $user = $_SESSION['user'];
    $video = 'asd';

    if(count($error) == 0) {
            $query = "SELECT * FROM item_list WHERE id = $id";
            $result = mysqli_query($con, $query);

        if(isset($result)) {
            $sql = "UPDATE item_list SET name = '$itemname' , img = '$picturelink' , detail = '$detail' , price = $price , stock = $stock WHERE id = $id";
            mysqli_query($con, $sql);
            $_SESSION['edit_suc'] = 'Edit item '.$itemname.' Successful.';
            header('location: ../edit.php');
        }else{
            $_SESSION['edit_suc'] = 'Item '.$itemname." can't edit!";
            header('location: ../edit.php');
        }
    }
    }else{
    header('location: ../edit.php');
    }
?>