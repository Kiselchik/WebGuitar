<?php
session_start();
include '../general/data.php';


unset($_SESSION['infoUser']);
$from = $_GET['from'];
$to = $_GET['to'];
$quantity = $_GET['quantity'];

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$q_rating="SELECT item, (sum(order_item.price-contract.one_price)*order_item.quantity) as price, date_format(o_date, '%d.%m.%y')
FROM item 
INNER JOIN order_item ON item.item_id = order_item.item_id 
INNER JOIN contract ON order_item.item_id = contract.item_id
INNER JOIN user_order ON order_item.order_id=user_order.order_id
WHERE o_date >= '$from' and o_date <= '$to'
GROUP BY item
ORDER BY price
DESC LIMIT  $quantity";

$r_rating=mysqli_query($link, $q_rating);
$rating=array();
if($r_rating){
	while($tmp = $r_rating->fetch_assoc()){
    $rating[]=$tmp;
   $_SESSION['rating']=$rating;

  }	

 header("Location: /owner/vladelets_lk.php");

}
else{
	 echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";

}
?>