<?php
session_start();
include '../general/data.php';
//$bdate=$_POST['b_date'];



//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$order_id = $_GET['ord'];
//echo $order_id;
$q_order="SELECT order_status.order_id,
 (SELECT s_type FROM status WHERE status_id = order_status.status_id )as status, 
 (SELECT item FROM item where item_id = order_item.item_id) as item ,
order_item.quantity,
 order_item.quantity*order_item.price as order_price
FROM order_status 
INNER JOIN order_item 
ON  order_status.order_id = order_item.order_id
WHERE order_status.order_id = '$order_id'";

$r_order=mysqli_query($link,$q_order);
$order=array();

if($r_order){

  while($tmp = $r_order->fetch_assoc()){
    $order[]=$tmp;
    $_SESSION['one_order']=$order;
}header("Location: /seller/prodavets_lk.php");
}
else {
	 echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";
# code...
}
//print_r($_SESSION['one_order']);
?>