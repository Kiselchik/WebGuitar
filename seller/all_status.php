<?php
session_start();
include '../general/data.php';
if(!isset($_SESSION['status'])){
$status = $_GET['status'];
$_SESSION['status']=$status;}
else {
$status=$_SESSION['status'];
}
//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$q_all_status ="SELECT order_id, (SELECT s_type FROM status WHERE status_id = '$status' )as status
FROM order_status WHERE status_id='$status'";
$r_all_status = mysqli_query($link,$q_all_status);
$orders=array();
if ($r_all_status) {
while($tmp = $r_all_status->fetch_assoc()){
    $orders[]=$tmp;
    $_SESSION['orders']=$orders;
     $_SESSION['st']=$status;
}
unset($_SESSION['status']);

header("Location: /seller/prodavets_lk.php");

}
?>