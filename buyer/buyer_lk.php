<?php
session_start();
require('../general/menu.php');?>
<h1>Личный кабинет</h1>

<?php
include '../general/data.php';

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
$user_id = $_SESSION['user_id'];
$q_info_user = "SELECT s_name, f_name, m_name, tel, mail, login, date_reg FROM buyer INNER JOIN user ON buyer.user_id=user.id WHERE id='$user_id' ";
$r_info_user = mysqli_query($link, $q_info_user);
$infoUser=array();
if($r_info_user){

	while($tmp = $r_info_user->fetch_assoc()){
    $infoUser[]=$tmp;
  }	

  foreach ($infoUser as $info) {
  	?>
  	<div id="lk_info">
  		<?php
  	echo $info['s_name'].'<br>';
  	echo $info['f_name'].'<br>';
  	echo $info['m_name'].'<br>';
  	echo $info['tel'].'<br>';
  	echo $info['mail'].'<br>';
  	echo $info['login'].'<br>';
  	echo $info['date_reg'].'<br>';
?>
</div>
<div class="col-sm-6 col-lg-3 col-md-6">
                            <div class="thumbnail">


<?php
  }
}


if(isset($_SESSION['infoOrder'])){
		 foreach ($_SESSION['infoOrder'] as $infoOrder) {
if(isset($order)){
if($order == $infoOrder['order_id']){
	?><div id="order">
		<?php
			echo 'Товар: '.$infoOrder['item'].'		';
	 	  	echo 'Количество: '.$infoOrder['quantity'].'		';
	 	  	echo 'Цена: '.$infoOrder['order_price'].'             ';
?>
</div>
<?php
}
else{
		?><div id="orders">

		<?php
echo '<br>'.'Номер заказа: '.$infoOrder['order_id'].'<br>';
	 	  	echo 'Статус: '.$infoOrder['status'].'<br>';
	 	  	echo 'Товар: '.$infoOrder['item'].'		';
	 	  	echo 'Количество: '.$infoOrder['quantity'].'		';
	 	  	echo 'Цена: '.$infoOrder['order_price'].'                ';
?>
</div>
<?php
$order = $infoOrder['order_id'];

}

}
else{
	?><div id="orders">

		<?php
echo '<br>'.'Номер заказа: '.$infoOrder['order_id'].'<br>';
	 	  	echo 'Статус: '.$infoOrder['status'].'<br>';
	 	  	echo 'Товар: '.$infoOrder['item'].'		';
	 	  	echo 'Количество: '.$infoOrder['quantity'].'		';
	 	  	echo 'Цена: '.$infoOrder['order_price'].'                    ';
?>
</div>
<?php
$order = $infoOrder['order_id'];

}

	 		
	 	  

	 	  	



  }

}
?>
</div>
</div>
<?php


 if(isset($_SESSION['answer'])){
foreach ($_SESSION['answer'] as $key => $answer) {
	echo "Заказ сформирован! Номер заказа: ";
echo $answer;
}
unset($_SESSION['answer']);
}


?>
<a id="my_orders" href = "/buyer/users_order.php">Мои заказы</a>