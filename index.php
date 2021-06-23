<?php
session_start();

require('general/menu.php');
if(isset($_GET['msg'])){
  echo $_GET['msg'];
}

?>
<style type="text/css">
   body { 
background-image: url(/img/main3.jpg);
   }

   #hello{
   	border-radius: 25px;
   	margin-left: 300px;
   	background: #5C3D3D;
   	width: 500px;
   	height: 300px;
   	align-content: center;
   }
   h1{
padding-left: 15%;
   }
   #catalog_btn{
   	text-decoration-color: red;
   	text-decoration: none; /*убираем подчеркивание текста ссылок*/

   }
  </style>

  <div id="hello">
  <h1>Добро пожаловать</h1>
  <a id="catalog_btn" href="general/catalog.php">Перейти в каталог</a>

  </div>
