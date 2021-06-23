<?php
session_start();
include 'general/data.php';



//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$employee_id = $_SESSION['user_id'];
$status_id = $_GET['change'];

//echo $status_id;;



foreach ($_SESSION['infoOrder'] as $key => $info) {
$order_id=$info['order_id'];

//echo $order_id;


$q_change = "UPDATE order_status SET status_id = '$status_id', employee_id='$employee_id' WHERE order_id = '$order_id'";

$q_date="UPDATE order_status SET date_time=NOW() WHERE order_id = '$order_id'";

$r_change = mysqli_query($link,$q_change );
$r_date = mysqli_query($link, $q_date);


if($r_change && $r_date){

//searchOrder();
//echo "ПОЛУЧИЛОСЬ!";
header("Location:  seller/search_order.php");

}
else {
echo mysqli_error($link);
echo mysqli_errno($link);
}}
?>