<?php
session_start();
include '../general/data.php';


if(!isset($_SESSION['ord'])){
$ord = $_POST['ord'];
$_SESSION['ord']=$ord;
}
else{
	$ord=$_SESSION['ord'];
}

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$q_user = "SELECT f_name, s_name, m_name, tel FROM buyer INNER JOIN user_order ON buyer.user_id = user_order.user_id WHERE user_order.user_id = (
SELECT user_id from user_order where order_id = '$ord') GROUP BY buyer.user_id";
$q_order = "SELECT s_type, (SELECT SUM(price*quantity) FROM order_item WHERE order_id ='$ord') as price FROM status WHERE status_id IN (SELECT status_id FROM order_status WHERE order_id = '$ord') ";
$r_order = mysqli_query($link,$q_order );
$infoOrder = array();
if($r_order){
while($tmp = $r_order->fetch_assoc()){
    $infoOrder[]=$tmp;
    $_SESSION['infoOrder']=$infoOrder;

  } }
$r_user = mysqli_query($link,$q_user );
$infoUser = array();


if($r_user){

  while($tmp = $r_user->fetch_assoc()){
    $infoUser[]=$tmp;
    $_SESSION['infoUser']=$infoUser;

  }	
	header("Location:  /seller/prodavets_lk.php");

}
	else{
		echo "error";
	}







?>