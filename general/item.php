<?php 
session_start();

include 'data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
  
if(isset($_GET['id'])){
    $item_red=$_GET['id'];
  $_SESSION['item_id_red']=$item_red;}
    else{
   $item_red = $_SESSION['item_id_red'];
}
 
  $result = "SELECT i_type_id, item_id,img, info, item, i_price FROM item WHERE item_id = '$item_red' "; 
  $q_residue = "SELECT
(contract.quantity-(SELECT SUM(quantity) 
           FROM order_item 
           INNER JOIN user_order ON order_item.order_id=user_order.order_id WHERE item_id = '$item_red' and user_order.o_date<=contract.cont_date
           ))  as res, quantity FROM contract WHERE item_id = '$item_red' " ;
  $r_residue = mysqli_query($link,$q_residue );

    $query = mysqli_query($link,$result );
$product = array();
$residue=array();
if($r_residue){

  while($tmp = $r_residue->fetch_assoc()){
    $residue[]=$tmp;
}

}



if($query){

  while($tmp = $query->fetch_assoc()){
    $product[]=$tmp;
}

}



else{
    echo "error!!!!!";
}


require('menu.php');

?>

    <?php foreach($product AS $product) {       ?>
<div>

<h1> <?php echo $product['item'];?> </h1>
<img src="<?php echo $product['img'];?>"></img>
   <h4><?php echo $product['info'];?></h4>
      <h4><?php echo $product['i_price'].'р';?></h4>
      <h4>Осталось:
<?php
foreach ($residue as $key => $res) {
if($res['res']>0 ){
  echo $res['res'];

 if(!isset($_SESSION['role'])||($_SESSION['role']==2)){
  ?><a href = "/buyer/box.php?idBox=<?php echo $product['item_id'];?>"  > 
                             <h1>Добавить в корзину</h1>
                           </a>

                       </div>
                       <?php
}
}
elseif($res['res']<0){
echo "Товар закончился";

}
elseif($res['res']==null){
  echo $res['quantity'];
  if(!isset($_SESSION['role'])||($_SESSION['role']==2)){
  ?><a href = "/buyer/box.php?idBox=<?php echo $product['item_id'];?>"  > 
                             <h1>Добавить в корзину</h1>
                           </a>

                       </div>
                       <?php
}
}
} }

if($_SESSION['role']==3){
    echo '<br><button id="btn_modal3" >Редактировать</button>';

    echo '<br><button id="btn_modal4" >Поставка</button>';
}



 ?>




<div class="row">

  <div id="my_modal3" class="modal3">

    <div class="col-md-3">
      <span class="close_modal_window3">×</span>
      <p><?php echo $product['item'];?></p>


<form method="POST" action="../seller/change_item.php?item_id=$item" >

  <div class="form-group">
    <label for="item">Наименование товара: </label>
    <input type="text" class="form-control" name="item"   >
  </div>
  
  <div class="form-group">
    <label for="info">Информация: </label>
    <input type="text" class="form-control" name="info"  >
  </div>
    <div class="form-group">
    <label for="img">Изображение: </label>
    <input type="text" class="form-control" name="img"   >
  </div>
    <div class="form-group">
    <label for="i_price">Продажная цена: </label>
    <input type="text" class="form-control" name="i_price" >
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
      <p><?php echo $product['item'];?></p>


<form method="POST" action="../seller/change_quantity.php?item_id=$item" >

  <div class="form-group">
    <label for="date">Дата поставки: </label>
    <input type="text" class="form-control" name="date"   >
  </div>
  
  <div class="form-group">
    <label for="quan">Количество прибывшего товара: </label>
    <input type="text" class="form-control" name="quan"  >
  <button   id="sendrg" type= "submit">Отправить</button>
</form>

</div>
</div>
</div>
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