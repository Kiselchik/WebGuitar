<?php
session_start();

include '../general/data.php';
$user_id = $_SESSION['user_id'];
//соединение
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
$q_order_id="SELECT order_id FROM user_order WHERE user_id = '$user_id'";
$r_order_id = mysqli_query($link,$q_order_id );
$Order = array();
if($r_order_id ){
while($tmp = $r_order_id->fetch_assoc()){
    $Order[]=$tmp;
    $_SESSION['Order']=$Order;
  }	}
$q_users_order= "SELECT order_status.order_id,
 (SELECT s_type FROM status WHERE status_id = order_status.status_id )as status, 
 (SELECT item FROM item where item_id = order_item.item_id) as item ,
order_item.quantity,
 order_item.quantity*order_item.price as order_price
FROM order_status 
INNER JOIN order_item 
ON  order_status.order_id = order_item.order_id
WHERE order_status.order_id IN (SELECT order_id FROM user_order WHERE user_id = '$user_id')";

 $r_users_order = mysqli_query($link,$q_users_order );


$infoOrder = array();
if($r_users_order ){
while($tmp = $r_users_order->fetch_assoc()){
    $infoOrder[]=$tmp;
    $_SESSION['infoOrder']=$infoOrder;

  }	}
  else{
  	 echo "error";
}

  header("Location: /buyer/buyer_lk.php");
