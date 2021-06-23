<?php 
session_start();
?>
<html>
<head>
<title>MAGAZINCHIK</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="/css/style2.css"  rel="stylesheet">
<link href="/css/style.css"  rel="stylesheet">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<meta name="pomenyat">

</head>
<body>





<div  class="menu">

<ul >
  <div id="menu">
      <li >  <a href="/index.php">Главная</a></li>
      <li>  <a href="/general/catalog.php">Магазин</a></li>

      <?php
if(!isset($_SESSION['role'])){
 
  echo '<li id="btn_modal_window" ><a>Регистрация</a></li>';
  echo ' <li id="btn_modal_window2" > <a>Вход</a></li> ';
}
else{
 if($_SESSION['role']==2){
  echo '<li><a href="/buyer/buyer_lk.php">ЛК покупателя</a></li>';
    echo '<li><a href="/buyer/box.php">Корзина</a></li>';
} 
if($_SESSION['role']==3){
  echo '<li><a href="/seller/prodavets_lk.php">ЛК Продавца</a></li>';
}
if($_SESSION['role']==4){
  echo '<li><a href="/owner/vladelets_lk.php">ЛК Владельца</a></li>';
}

echo '<li><a href = "/general/exit_profile.php" >Выход</a></li>';

}
?>   
<ul>
</div>




<div class="row">

  <div id="my_modal" class="modal">

    <div class="col-md-3">
      <span class="close_modal_window">×</span>
      <p>Регистрация</p>


<form action="/general/form_reg.php" method="POST">

  
  <div class="form-group" >
    <label for="mail">Почта</label>
    <input type="email" class="form-control" id="mail" name="mail" placeholder="example@cat.com"required>
  </div>


  <div class="form-group">
    <label for="login">Логин</label>
    <input type="text" class="form-control" name="login" placeholder="MyLogin1"   required  pattern="[a-z A-Z 0-9]{6,15}">
    <p class="text-muted">Логин должен содержать не менее 6 и не более 15 латинских символов и цифр</p>
  </div>


   <div class="form-group">
    <label for="password">Пароль</label>
    <input type="password" class="form-control" name="password" id="password"  required pattern="[a-z A-Z 0-9]{6,15}">
    <p class="text-muted">Пароль должен содержать не менее 6 и не более 15 латинских символов и цифр</p>
  </div>
  <div class="form-group">
    <label for="passwordCheck">Проверка пароля</label>
    <input type="password" class="form-control" onkeyup="valid(event)" name="passwordCheck" id="passwordCheck"  required pattern="[a-z A-Z 0-9]{6,15}">
    <p class="text-muted">Введите пароль</p>
  </div>


 <div class="form-group">
    <label for="s_name">Фамилия</label>
    <input type="text" class="form-control" name="s_name" placeholder="Черепах"required pattern="[А-Я][а-я]{2,15}"> 
	<p class="text-muted">Запись вашей фамилии должна начинаться с прописной буквы</p>

   <div class="form-group">
    <label for="f_name">Имя</label>
    <input type="text" class="form-control"  name="f_name" placeholder="Черепаха" required pattern="[А-Я][а-я]{2,15}">
    <p class="text-muted">Запись вашего имени должна начинаться с прописной буквы</p>
  </div>
  

  </div>
   <div class="form-group">
    <label for="m_name">Отчество</label>
    <input type="text" class="form-control" name="m_name" placeholder="Черепаховна"required pattern="[А-Я][а-я]{2,15}">
    <p class="text-muted">Запись вашего отчества должна начинаться с прописной буквы</p>
  </div>

   <div class="form-group">
    <label for="tel">Телефон</label>
    <input type="text" class="form-control" name="tel" placeholder="+7ХХХХХХХХХХ" required pattern="+7[0-9]{10}">
  </div>

  <button   id="sendrg" type= "submit">Отправить</button>


</form>

</div>
</div>
</div>






<div class="row">

  <div id="my_modal2" class="modal2">

    <div class="col-md-3">
      <span class="close_modal_window2">×</span>
      <p>Вход</p>
  


<form  id="login" action="/general/form_enter.php" method="POST">

  <div class="form-group" >
    <label for="login2">Логин</label>
    <input type="text" class="form-control" id="login2" name="login2" required>
  </div>

  <div class="form-group" >
    <label for="password2">Пароль</label>
    <input type="password" class="form-control" id="password2" name="password2" required>
  </div>

 <button   id="sendrG" type= "submit">Отправить</button>
</form>





</div>
</div>
</div>
   


  </div>
     <div id = "search_item">

<form id ="search" method="GET" action="/general/search_item.php" >
 <div class="form-group">
    <label for="search"> </label>
    <input type="text" class="form-control" name="search"   >
  </div>

</form>
</div>


<script>
 var modal2 = document.getElementById("my_modal2");
 var btn2 = document.getElementById("btn_modal_window2");
 var span2 = document.getElementsByClassName("close_modal_window2")[0];

 btn2.onclick = function () {
    modal2.style.display = "block";
 }

 span2.onclick = function () {
    modal2.style.display = "none";
 }

 window.onclick = function (event) {
    if (event.target == modal2) {
        modal2.style.display = "none";

    }
}

</script>
<script>
 var modal = document.getElementById("my_modal");
 var btn = document.getElementById("btn_modal_window");
 var span = document.getElementsByClassName("close_modal_window")[0];


 btn.onclick = function () {
    modal.style.display = "block";

 }

 span.onclick = function () {
    modal.style.display = "none";
 }

 window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
<script type="text/javascript">
function valid(event){
var pas = document.getElementById('password').value 
var cpas = document.getElementById('passwordCheck').value
for(i=0;i < cpas.length; i++)
{

 if(pas[i] != cpas[i] && event.keyCode != 8)
 {
   alert('Пароли не совпадают');
   break;
 }
}
}
</script>

</biv>


</body>
</html>