<?php
session_start();
include '../general/data.php';

$name=$_POST['f_name'];
$sname=$_POST['s_name'];
$mname=$_POST['m_name'];
$tel=$_POST['tel'];

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

if(!isset($_SESSION['login'])){
toBuyer();
	$q_user_id="SELECT MAX(user_id) user_id FROM buyer WHERE f_name = '$name' and  s_name = '$sname' and m_name = '$mname' and tel = '$tel'";
	$r_user_id=mysqli_query($link, $q_user_id);
	if($r_user_id){
		while ($row = mysqli_fetch_assoc($r_user_id)) {
			$user_id=$row;
				}
	}
toUserOrder($user_id['user_id']);
toOrderItem($user_id['user_id']);
toOrderStatus($user_id['user_id']);
orderID($user_id['user_id']);

header("Location: /general/catalog.php");
}
else{
	$user_id=$_SESSION['user_id'];
	toUserOrder($user_id);
toOrderItem($user_id);
toOrderStatus($user_id);
orderID($user_id);
header("Location: /buyer/buyer_lk.php");
}


function toBuyer(){
	global $link, $name, $sname, $mname, $tel;
$q_to_buyer = "INSERT INTO buyer(f_name, s_name, m_name, tel) VALUES ('$name', '$sname', '$mname', '$tel') ";

$r_to_buyer = mysqli_query($link,$q_to_buyer);
if(!$r_to_buyer){

echo "form error";
}

}


function toUserOrder($user_id){

global $link;

$q_to_user_order =  "INSERT INTO user_order( user_id) VALUES ('$user_id') ";

$r_to_user_order = mysqli_query($link,$q_to_user_order);
if(!$r_to_user_order){

	echo "цена и юзер сломались <br>";

}
}



function toOrderItem($user_id){
	global $link;

foreach ($_SESSION['items'] as $key => $product) {

	$price = $product[0]['i_price'];

foreach ($_SESSION['idNumber'] as $key => $number) {
if($number['id']==$product[0]['item_id']){
$nmb = $number['number'];
$prod = $product[0]['item_id'];



$q_to_order_item = "INSERT INTO order_item(item_id, order_id, quantity, price) VALUES ('$prod', 
(SELECT MAX(order_id) FROM user_order WHERE user_id = ('$user_id')), '$nmb', '$price')";

$r_to_order_item = mysqli_query($link,$q_to_order_item );
if(!$r_to_order_item){

echo	 mysqli_error($link);
	echo " айдишники сломались <br>";
		echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";
}

}

}}

}



function toOrderStatus($user_id){

global $link;
$q_to_order_status="INSERT INTO order_status(order_id) VALUES ( (SELECT MAX(order_id) FROM user_order WHERE user_id = ('$user_id')))";
$r_to_order_status = mysqli_query($link, $q_to_order_status);
if(!$r_to_order_status){

	echo "Статус провал";
			echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";

}

}

function orderID($user_id){
global $link, $answer;

$q_order_id="SELECT MAX(order_id) ord FROM user_order WHERE user_id='$user_id'";
$r_order_id = mysqli_query($link,$q_order_id);
if($r_order_id){
		while ($row = $r_order_id->fetch_assoc()) {
			$answer=$row;
				}
	$_SESSION['answer']=$answer;
	}
}


?>