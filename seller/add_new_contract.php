<?php
session_start();
include 'general/data.php';

$quantity=$_POST['quantity'];
$one_price=$_POST['one_price'];
$cont_date=$_POST['cont_date'];

$item_name=$GET['item_name'];
//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);


$q_add_contract="INSERT INTO contract(quantity, item_id, one_price, provider_id, cont_date) VALUES ('$quantity', (SELECT item_id FROM item WHERE item='$item_name'), '$one_price', (SELECT provider_id FROM provider WHERE p_name='$provider_name'), '$cont_date')";

if($r_add_contract=mysqli_query($link,$q_add_contract)){
echo "добавилось";
}
else{
	echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";
}

?>


