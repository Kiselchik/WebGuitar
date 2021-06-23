<?php
session_start();
include '../general/data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
require('../general/menu.php');
?>
<div class="search_provider">
<form method="POST" action="">
 <div class="form-group">
    <label for="provider">Введите поставщика: </label>
    <input type="text" class="form-control" name="provider" required>
  </div>

  <button   id="sendrg" type= "submit">Отправить</button>
</form>
</div>
<?php
$name=$_POST['provider'];
$_SESSION['name']=$name;
$provider_exixt=0;
$q_search_provider = "SELECT p_name, city, street, house, tel, name, s_name FROM provider WHERE p_name = '$name'" ;
if(isset($name)){

if($r_search_provider = mysqli_query($link, $q_search_provider)){
$info_provider=array();
	 while($tmp = $r_search_provider->fetch_assoc()){
    $info_provider[]=$tmp;
}
if($info_provider!=null){
	foreach ($info_provider as $key => $infp) {
		echo '<br>'.$infp['p_name'].'<br>';	
		echo $infp['city'].'<br>';	  
    echo $infp['street'].'<br>'; 
        echo $infp['house'].'<br>'; 

    echo $infp['tel'].'<br>'; 

    echo $infp['name'].'<br>'; 

    echo $infp['s_name'].'<br>'; 



	}

	$provider_exixt=1;
}
else{
//добавление поставщика
if($provider_exixt==0){

	echo "Поставщика ${name} нет в базе <br>"; ?>
	<div id="search_provider">
    <p>Добавить поставщика</p>
    <form method="POST" action="../general/add_new_provider.php">
 <div class="form-group">
    <label for="p_name">Наименование поставщка: </label>
    <input type="text" class="form-control" name="p_name" required>
  </div>
  <div class="form-group">
    <label for="city">Город: </label>
    <input type="text" class="form-control" name="city" required>
  </div>
  <div class="form-group">
    <label for="street">Улица: </label>
    <input type="text" class="form-control" name="street" required>
  </div>
  <div class="form-group">
    <label for="house">Дом: </label>
    <input type="text" class="form-control" name="house" required>
  </div>
  <div class="form-group">
    <label for="tel">Контактный телефон: </label>
    <input type="tel" class="form-control" name="tel"  required>
  </div>
  <div class="form-group">
    <label for="name">Имя: </label>
    <input type="text" class="form-control" name="name"  required>
  </div>
  <div class="form-group">
    <label for="s_name">Фамилия: </label>
    <input type="text" class="form-control" name="s_name" required>
  </div>

  <button   id="sendrg" type= "submit">Отправить</button>
</form>
</div>

<?php
}
}
}
}

else{
	echo "Введите поставщика";
}


$new_provider=$_GET['new_provider'];
echo $new_provider;
if(($provider_exixt==1)||($new_provider==1)){

?>

<div id="add_contract">
    <a >Добавить товар</a>
    <form method="POST" action="../seller/add_item_process.php">
 <div class="form-group">
    <label for="i_type_id">Тип: </label>
    <input type="text" class="form-control" name="i_type_id" required>
  </div>
  <div class="form-group">
    <label for="item">Наименование товара: </label>
    <input type="text" class="form-control" name="item" required>
  </div>
  <div class="form-group">
    <label for="quantity">Количество поставляемого товара: </label>
    <input type="text" class="form-control" name="quantity" required>
  </div>
  
  <div class="form-group">
    <label for="info">Информация: </label>
    <input type="text" class="form-control" name="info"  required>
  </div>
    <div class="form-group">
    <label for="img">Изображение: </label>
    <input type="text" class="form-control" name="img"  required>
  </div>
    <div class="form-group">
    <label for="i_price">Продажная цена: </label>
    <input type="text" class="form-control" name="i_price"  required>
  </div>
   
  <div class="form-group">
    <label for="one_price">Закупочная: </label>
    <input type="text" class="form-control" name="one_price" required>
  </div>

  <div class="form-group">
    <label for="cont_date">Дата поставки: </label>
    <input type="text" class="form-control" name="cont_date"  required>
  </div>

  <button   id="sendrg" type= "submit">Отправить</button>
</form>
</div>



<?php

}

if(isset($_GET['answer'])){
	echo $_GET['answer'];
}
?>