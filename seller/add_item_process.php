<?php
session_start();
include 'general/data.php';

$i_type_id=$_POST['i_type_id'];
$item=$_POST['item'];
$info=$_POST['info'];
$i_price=$_POST['i_price'];
$img = $_POST['img'];

$quantity=$_POST['quantity'];
$one_price=$_POST['one_price'];
$cont_date=$_POST['cont_date'];



$provider_name=$_SESSION['name'];
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);


$q_add_item="INSERT INTO item(i_type_id, item, img, info, i_price) VALUES ('$i_type_id', '$item', '$img','$info', '$i_price')";

$q_add_contract="INSERT INTO contract(quantity, item_id, one_price, provider_id, cont_date) VALUES ('$quantity', (SELECT item_id FROM item WHERE item='$item'), '$one_price', (SELECT provider_id FROM provider WHERE p_name='$provider_name'), '$cont_date')";


if(($r_add_item=mysqli_query($link,$q_add_item)) && ($r_add_contract=mysqli_query($link,$q_add_contract))){
	$msg="товар добавлен";
	header("Location: seller/add_new_item.php?answer=$msg");
}
else{
	echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";
}

?>