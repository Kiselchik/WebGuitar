<?php
session_start();
include 'general/data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
$p_name = $_POST['p_name'];
$city = $_POST['city'];
$street = $_POST['street'];
$house = $_POST['house'];
$tel = $_POST['tel'];
$name = $_POST['name'];
$s_name = $_POST['s_name'];
$_SESSION['name']=$p_name;


$q_new_provider = "INSERT INTO provider(p_name, city, street, house, tel, name, s_name) VALUES ('$p_name', '$city', '$street', '$house', '$tel', '$name', '$s_name')";
if(isset($p_name)){

$r_new_provider=mysqli_query($link,$q_new_provider);


if($r_new_provider){
	$new_provider = 1;
	header("Location: seller/add_new_item.php?new_provider=$new_provider");

}
else{
		echo "Ошибка при добалении поставщика";

}
}

else{
	echo "error";
}
?>