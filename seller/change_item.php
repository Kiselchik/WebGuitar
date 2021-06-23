<?php 
session_start();

include '../general/data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
  
$item=$_POST['item'];
$info=$_POST['info'];
$img=$_POST['img'];
$i_price=$_POST['i_price'];

$item_id=$_SESSION['item_id_red'];


	if($item!=null){
				$q_change_item = "UPDATE item SET item = '$item' WHERE  item_id='$item_id' ";

 $r_change_item = mysqli_query($link,$q_change_item);	}
	if($info!=null){
				$q_change_item = "UPDATE item SET info = '$info' WHERE  item_id='$item_id' ";

 $r_change_item = mysqli_query($link,$q_change_item);	}
 if($img!=null){
				$q_change_item = "UPDATE item SET img = '$img' WHERE  item_id='$item_id' ";

 $r_change_item = mysqli_query($link,$q_change_item);	}
	
	if($i_price!=null){
				$q_change_item = "UPDATE item SET i_price = '$i_price' WHERE  item_id='$item_id' ";

 $r_change_item = mysqli_query($link,$q_change_item);	}
	

header("Location: /general/item.php");


?>