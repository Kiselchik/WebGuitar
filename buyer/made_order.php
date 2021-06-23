<?php
session_start();
require('../general/menu.php');

include '../general/data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);



	 foreach($_SESSION['items'] AS  $key => $product) {?>
  <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                             

                          
                                <div class="caption">
                                    <?php 

                                //  echo $product[0]['item_id'];
                                    echo '<br><br>Товар: '.$product[0]['item'].'<br>';
                                    echo 'Цена: '.$product[0]['i_price'].'р.<br>'; 


foreach ($_SESSION['idNumber'] as $key => $number) {
if($number['id']==$product[0]['item_id']){
echo 'Количество: '.$number['number'].'<br>';}
                                   } ?>
                                    </div>
                                    </div>
                                    </div>
<?php 
  }
  ?>

<style type="text/css">
  p{
    font-size: 20px;
  }
</style>



  <h3>Cумма к оплате:<?php print_r($_SESSION['sumprice']); ?></h3>


<?php
  


if(!isset($_SESSION['login'])){
?>


<form   action="../buyer/send_order.php" method="POST">

  <div class="form-group" >
    <label for="f_name">Имя</label>
    <input type="text" class="form-control"  name="f_name" required>
  </div>

  <div class="form-group" >
    <label for="s_name">Фамилия</label>
    <input type="text" class="form-control" name="s_name" required>
  </div>
    <div class="form-group" >
    <label for="m_name">Отчество</label>
    <input type="text" class="form-control"  name="m_name" required>
  </div>
  <div class="form-group" >
    <label for="tel">Телефон</label>
    <input type="text" class="form-control"  name="tel" required>
  </div>

 <button   id="sendrG" type= "submit">Отправить</button>
</form>



<?php

}


else {
$userName=array();
$login=$_SESSION['login'];
$query = "SELECT f_name, m_name, tel FROM buyer WHERE user_id = (SELECT id FROM USER WHERE login = '$login' )";
$result = mysqli_query($link,$query);//Вот ваши товары.Подтвердить?

if($result){
	 while($tmp = $result->fetch_assoc()){
$userName[] = $tmp; 
}

?>

<div>

<p>

<?php 

foreach ($userName as $key => $userName) {

 echo $userName['f_name'].'<br>';
echo $userName['m_name'].'<br>';
 echo $userName['tel'].'<br>';
}

?>
</p>

<a href="/buyer/send_order.php">Подтвердить</a>
</div>
<?php
}}


?>

