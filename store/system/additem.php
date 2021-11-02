<?php
session_start();
require('../../system/connectdb.php');

$error = array();

if (isset($_POST['add_item'])) {
    $itemname = mysqli_real_escape_string($con, $_POST['itemname']);
    $picturelink = mysqli_real_escape_string($con, $_POST['picturelink']);
    $detail = mysqli_real_escape_string($con, $_POST['detail']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $user = $_SESSION['user'];
    $video = 'asd';


    $user_check_query = "SELECT * FROM item_list WHERE name = '$itemname'";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if(count($error) == 0) {
        $sql = "INSERT INTO item_list (name,img,video,detail,price,stock,useradd) VALUES ('$itemname','$picturelink','$video','$detail',$price,$stock,'$user')";
        mysqli_query($con, $sql);
        $_SESSION['add_suc'] = 'Add item '.$itemname.' Successful.';
        header('location: ../index.php');
    }else{
        $_SESSION['add_suc'] = 'Item '.$itemname." can't add in to store!";
        header('location: ../index.php');
    }
}else{
    header('location: ../index.php');
}
?>