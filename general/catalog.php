<?php 
session_start();
require('menu.php');

include 'data.php';

//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

//запрос
$result = "SELECT * FROM item";
$query = mysqli_query($link,$result );
$product = array();
if($query){
  while($tmp = $query->fetch_assoc()){
    $product[]=$tmp;
}
}
?>
<h1>Каталог</h1>
<?php
 if(isset($_SESSION['answer'])){
foreach ($_SESSION['answer'] as $key => $answer) {
  echo "Заказ сформирован! Номер заказа: ";
echo $answer;
}
unset($_SESSION['answer']);
}

?>

<div class="row">
                    <?php foreach($product AS $product) {
				

                    	?>
                        <div class="col-sm-6 col-lg-3 col-md-6">
                            <div class="thumbnail">
                             

                              <a href = "item.php?id=<?php echo $product['item_id'];?>"  > 
                               <img  src="<?php echo $product['img'];?>" alt="" width="200px" height="200px">
                           </a>
                               

                                <div class="caption">
                                    <h4 class="pull-right"><?php echo $product['i_price'];?></h4>
                                   
                                    <h4 class="pull-right"><?php echo $product['item'];?></h4>
                                    
                                    
                               
                                </div>
                            </div>
                        </div>
                          <?php } ?>
                    </div>

