<?php
session_start();

require('../general/menu.php');
?>

<button id="btn_modal3" >Прибыль</button>
<button id="btn_modal4" >Рейтинг</button>
<form action="/owner/search_login.php" method="POST">

  <div class="form-group" >
    <label for="login_search">Поиск пользователя</label>
    <input type="text" class="form-control" id="login_search" name="login_search" placeholder="Введите искомый логин">
  </div>
    <button   id="sendrg" type= "submit">Поиск</button>
</form>
<style type="text/css">
  
  #ch{
    width: 15px;
  }
</style>

<?php

if(isset($_SESSION['infoUser'])){
foreach ($_SESSION['infoUser'] as $key => $info) {

echo "<br>";
print_r($_SESSION['login_search']);
	echo "<br>";

echo $info['f_name'].'<br>';
echo $info['s_name'].'<br>'; 
echo $info['m_name'].'<br>'; 
echo $info['tel'].'<br>'; 
}


if(is_array($_SESSION['userRole'] )){
foreach ($_SESSION['userRole'] as $key => $role) {
echo $role;

if($role=="СЛк"){
	echo '<a href="change_role.php">Сделать продавцом</a>';
}
elseif ($role = "Продавец") {
	echo '<a href="change_role.php" >Уволить</a>';
}


}}
else{
	if($_SESSION['userRole'] =="СЛк"){
	echo '<a href="change_role.php">Сделать продавцом</a>';
}
elseif ($_SESSION['userRole'] == "Продавец") {
	echo '<a href="change_role.php" >Уволить</a>';
}

}
}





?>


<div class="row">

  <div id="my_modal3" class="modal3">

    <div class="col-md-3">
      <span class="close_modal_window3">×</span>
<form action="../owner/money.php"  action="POST">
 <div class="form-group">
    <label for="from">ОТ: </label>
    <input type="text" class="form-control" name="from"   >
  </div>
  <div class="form-group">
    <label for="to">ДО: </label>
    <input type="text" class="form-control" name="to"   >
  </div>
  <div class="form-group">
    <label for="graph"> Для построения графика отметьте поле снизу</label>
   <input id="ch" type="checkbox" class="form-control" name="graph"  value ="1"  >
  </div>
  <button   id="sendrg" type= "submit">Отправить</button>
</form>

</div>
</div>
</div>




<div class="row">

  <div id="my_modal4" class="modal4">

    <div class="col-md-3">
      <span class="close_modal_window4">×</span>
<form action="../owner/rating.php"  action="POST">
 <div class="form-group">
    <label for="from">ОТ: </label>
    <input type="text" class="form-control" name="from" required  >
  </div>
  <div class="form-group">
    <label for="to">ДО: </label>
    <input type="text" class="form-control" name="to"  required >
	  </div>

 <div class="form-group">
    <label for="quantity">Количество товаров: </label>
    <input type="text" class="form-control" name="quantity" required  >
  </div>


  <button   id="sendrg" type= "submit">Отправить</button>


</form>

</div>
</div>
</div>
<script>
 var modal4 = document.getElementById("my_modal4");
 var btn = document.getElementById("btn_modal4");
 var span = document.getElementsByClassName("close_modal_window4")[0];


 btn.onclick = function () {
    modal4.style.display = "block";

 }

 span.onclick = function () {
    modal4.style.display = "none";
 }

 window.onclick = function (event) {
    if (event.target == modal) {
        modal4.style.display = "none";
    }
}
</script>



<script>
 var modal3 = document.getElementById("my_modal3");
 var btn = document.getElementById("btn_modal3");
 var span = document.getElementsByClassName("close_modal_window3")[0];


 btn.onclick = function () {
    modal3.style.display = "block";

 }

 span.onclick = function () {
    modal3.style.display = "none";
 }

 window.onclick = function (event) {
    if (event.target == modal) {
        modal3.style.display = "none";
    }
}
</script>


<?php
if(isset($_SESSION['profit'])){
	foreach ($_SESSION['profit'] as $key => $profit) {

    ?>
    <div>

      <?php

      if(isset($_SESSION['graph'])){
        unset($_SESSION['graph']);
?>
      <img src="../img/graph.jpg">

<?php

      }

		echo '<br> Прибыль: '.$profit.'р.';
    ?>

  </div>
  <?php
	}

	unset($_SESSION['profit']);
}

if(isset($_SESSION['rating'])){
	//print_r($_SESSION['profit']);
	foreach ($_SESSION['rating'] as $key => $rating) {
		echo '<br>Товар: '.$rating['item'];
		echo '  Прибыль:'.$rating['price'].'р.';

	}

		unset($_SESSION['rating']);

}
?>

