<?php
session_start();

include '../general/data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
$quantity=$_POST['quan'];
$date=$_POST['date'];
$item=$_POST['item'];
$item_id=$_SESSION['item_id_red'];


$q_change_quantity = "UPDATE contract SET cont_date='$date', quantity='$quantity' WHERE  item_id='$item_id' ";
 $r_change_quantity = mysqli_query($link,$q_change_quantity);	
	

header("Location: /general/item.php");
?>