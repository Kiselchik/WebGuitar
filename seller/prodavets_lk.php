<?php
session_start();

require('../general/menu.php');
//print_r($_SESSION['infoUser']);
 //unset($_SESSION['status']);

?>
<div id="lk">
<a href = "add_new_item.php">Добавить товар</a>
<form action="all_status.php" method="GET">

  <p>Показать статусы</p>
  <div class="form-group" >
<select name ="status">
	<option></option>
	<option value="1">Подтвержден</option>	
	<option value="2">Отменен</option>	
	<option value="3">Выполнен</option>

</select>
  </div>
    <button   id="sendrg" type= "submit">Показать</button>
</form>


<form action="search_order.php" method="POST">

  
  <div id="search_order" class="form-group" >
    <label for="ord">Поиск заказа</label>
    <input type="text" class="form-control" id="tel_search" name="ord" placeholder="Введите номер заказа">
  </div>
    <button   id="sendrg" type= "submit">Поиск</button>

<?php
if(isset($_SESSION['ord'])){
		if(isset($_SESSION['infoUser'])){
									foreach ($_SESSION['infoUser'] as $key => $user) {

									echo "<br>";
										
									echo $user['f_name'].'<br>'; 
									echo $user['s_name'].'<br>'; 
									echo $user['m_name'].'<br>'; 
									echo $user['tel'].'<br>';
									}



									if(isset($_SESSION['infoOrder'])){
																foreach ($_SESSION['infoOrder'] as $key => $order) {
																	
																echo $order['order_id'].'<br>';
																echo $order['s_type'].'<br>';  
																echo 'Сумма: '.$order['price'].'<br>';


																		if($order['s_type']=="Подтвержден"){
																		echo '<a href = "../seller/change_status.php?change=3">Выполнен</a><br>';
																		echo '<a href = "../seller/change_status.php?change=2">Отменен</a>';
																		}
																	/*
																	elseif($order['s_type']="Отменен"){
																		echo '<a href = "change_status.php">Подтвержден</a>';
																		echo '<a href = "change_status">Выполнен</a>';	
																	}
																	elseif($order['s_type']="Выполнен"){
																		echo '<a href = "change_status.php">Подтвержден</a>';
																		echo '<a href = "change_status">Выполнен</a>';	}

																	*/


																	}

																unset($_SESSION['infoUser']);
															//	unset($_SESSION['tel_search']);


									}else{
										echo "<br>";
										echo "Заказов нет";
										}


		}

		else {
			echo '<br><br>Заказа с таким номером не существует';
		}

																//unset($_SESSION['ord']);
																unset($_SESSION['orders']);

}
else{
	echo " ";
}

																unset($_SESSION['ord']);

if(isset($_SESSION['orders'])){

foreach ($_SESSION['orders'] as $key => $orders) {
?>	
<div id="change_status">
<?php
echo '<br>'.$orders['order_id'];

//$ord=$orders['order_id'];?>
<a href="../seller/more_inform.php?ord=<?php echo $orders['order_id'];?>">Подробно</a>
<?php
if($_SESSION['st']==1){
?>
<a href="../seller/change_one_status.php?ord=<?php echo $orders['order_id'];?>&&sts=3">Выполнено</a>
<a href="../seller/change_one_status.php?ord=<?php echo $orders['order_id'];?>&&sts=2">Отменено</a>


<?php
//unset($_SESSION['status']);

}}
}
?>
</div>
<?php

if(isset($_SESSION['one_order'])){
		 foreach ($_SESSION['one_order'] as $infoOrder) {


//$order = $infoOrder['order_id'];
if(isset($order)){
//echo $order;
if($order == $infoOrder['order_id']){
	echo 'Товар: '.$infoOrder['item'].'		';
	 	  	echo 'Количество: '.$infoOrder['quantity'].'		';
	 	  	echo 'Цена: '.$infoOrder['order_price'].'<br>';

}
else{
echo '<br>'.'Номер заказа: '.$infoOrder['order_id'].'<br>';
	 	  	echo 'Статус: '.$infoOrder['status'].'<br>';
	 	  	echo 'Товар: '.$infoOrder['item'].'		';
	 	  	echo 'Количество: '.$infoOrder['quantity'].'		';
	 	  	echo 'Цена: '.$infoOrder['order_price'].'<br>';


}

}
else{
echo '<br>'.'Номер заказа: '.$infoOrder['order_id'].'		';
	 	  	echo 'Статус: '.$infoOrder['status'].'<br>';
	 	  	echo 'Товар: '.$infoOrder['item'].'		';
	 	  	echo 'Количество: '.$infoOrder['quantity'].'		';
	 	  	echo 'Цена: '.$infoOrder['order_price'].'<br>';

$order = $infoOrder['order_id'];
}

	 		
	 	  

	 	  	



  }

unset($_SESSION['one_order']);

}


?>
</div>
</div>
</div>
</div>