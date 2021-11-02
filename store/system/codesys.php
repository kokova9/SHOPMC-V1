<?php
session_start();
require('../../system/connectdb.php');

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}
    $id = @$_GET['id'];

$error = array();

if (isset($_POST['code_edit'])) {
    $codez = mysqli_real_escape_string($con, $_POST['code']);
    $discount = mysqli_real_escape_string($con, $_POST['discount']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $minprice = mysqli_real_escape_string($con, $_POST['minprice']);

    if(count($error) == 0) {
            $query = "SELECT * FROM code_list WHERE id = $id";
            $result = mysqli_query($con, $query);

        if(isset($result)) {
            $sql = "UPDATE code_list SET code = '$codez' , discount = $discount , stock = $stock , ifs = $minprice WHERE id = $id";
            mysqli_query($con, $sql);
            header('location: ../code.php');
        }else{
            header('location: ../code.php');
        }
    }
    }else{
    header('location: ../code.php');
    }
?>