<?php
session_start();
require('../../system/connectdb.php');

$error = array();

if (isset($_POST['add_code'])) {
    $code = mysqli_real_escape_string($con, $_POST['code']);
    $discount = mysqli_real_escape_string($con, $_POST['discount']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);
    $minprice = mysqli_real_escape_string($con, $_POST['minprice']);


    $user_check_query = "SELECT * FROM code_list";
    $query = mysqli_query($con, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if(count($error) == 0) {
        $sql = "INSERT INTO code_list (code,discount,stock,ifs) VALUES ('$code',$discount,$stock,$minprice)";
        mysqli_query($con, $sql);
        $_SESSION['add_suc'] = 'Add '.$code.' Successful.';
        header('location: ../addcode.php');
    }else{
        $_SESSION['add_suc'] = $code." can't add in to code!";
        header('location: ../addcode.php');
    }
}else{
    header('location: ../addcode.php');
}
?>