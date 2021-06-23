<?php
session_start();


include '../general/data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

if(isset($_GET['idItem'])){
    $item = $_GET['idItem'];
}
else{
	echo "error";
}




foreach ($_SESSION['idNumber'] as $key => &$search) {

$id = $search['id'];
$q_residue = "SELECT
(contract.quantity-(SELECT SUM(quantity) 
           FROM order_item 
           INNER JOIN user_order ON order_item.order_id=user_order.order_id WHERE item_id = '$item_red' and user_order.o_date<=contract.cont_date
           ))  as res, quantity FROM contract WHERE item_id = '$id' " ;
  $r_residue = mysqli_query($link,$q_residue );

if($r_residue){

  while($tmp = $r_residue->fetch_assoc()){
    $residue[]=$tmp;
}

}


foreach ($residue as $key => $res) {
if($res['res']>0 ){
  $resurs= $res['res'];
}

elseif($res['res']==null){
  $resurs = $res['quantity'];}

}

	if($search['id']==$item){

		if($search['number']!=$resurs){
		$search['number']++;
	}

else{$empty="Товар на складе закончился";}
}
}
header("Location: /buyer/box.php?empty=$empty");
?>