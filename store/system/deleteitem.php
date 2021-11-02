<?php
session_start();
require('../../system/connectdb.php');
$id = @$_GET['id'];

$query = mysqli_query($con,"DELETE FROM item_list WHERE id = $id");
header('location: ../edit.php');
?>