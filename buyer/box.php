<?php 
session_start();
define('BASE_PATH',$_SERVER["DOCUMENT_ROOT"]);
require BASE_PATH.'/general/menu.php';
?>
<h1>КОРЗИНА </h1>
<style type="text/css">
  
  a{
    font-size: 20px;
  }

</style>
<?php
include BASE_PATH.'/general/data.php';
//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
  
if(isset($_GET['idBox'])){
    $item = $_GET['idBox'];}


  $result = "SELECT item_id, item, i_price FROM item WHERE item_id = '$item' "; 


    $query = mysqli_query($link,$result );
$product = array();

$idNumber =array();[
$id => 0,
$number => 1,
];
 

if(!$_SESSION['items']){

  while($tmp = $query->fetch_assoc()){
    $one=1;
    $product[]=$tmp;
    $idNumber['id']=$item;
    $idNumber['number']=$one;


    $_SESSION['items'][0]=$product;
     $_SESSION['idNumber'][0]=$idNumber;



    
}}
else{
       $check=false;

foreach ($_SESSION['idNumber'] as $key => $addId) {
    if($addId['id']==$item){
        echo "такой товар уже есть в корзине";
        $check=true;    

    }}

if(!$check){
    while($tmp = $query->fetch_assoc()){
    $one=1;
    $product[]=$tmp;
     $idNumber['id']=$item;
    $idNumber['number']=$one;

  //  $id[]=$item;
  //  $number[]=$one;
    array_push($_SESSION['items'], $product);
    array_push($_SESSION['idNumber'], $idNumber);
   // array_push($_SESSION['id'], $id);
  //  array_push($_SESSION['number'], $number);


   
}}


}

            //print_r($_SESSION['items']);
           // echo "<br>";
                   //     print_r($_SESSION['idNumber']);


//session_destroy();



if(isset($_SESSION['items'])){
	
	 foreach($_SESSION['items'] AS  $key => $product) {?>
}


  <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                             

                          
                                <div class="caption">
                                    <?php 

                                 // echo $product[0]['item_id'];
                                    echo '<br><br>Товар: '.$product[0]['item'].'<br>';
                                    echo 'Цена: '.$product[0]['i_price'].'р.<br>'; 

                                    



foreach ($_SESSION['idNumber'] as $key => $number) {
if($number['id']==$product[0]['item_id']){
  $sumprice=$number['number']*($sumprice+$product[0]['i_price']);
echo 'Количество: '.$number['number'].'шт.<br>';}
                                   }                                   
                                    ?>
                                   
                               
                                    
                               
                                </div>
                               <a  href = "/buyer/add_item.php?idItem=<?php echo $product[0]['item_id'];?>" > 
                             <p>+</>
                           </a>
                            <a href = "/buyer/decr_item.php?idItem=<?php echo $product[0]['item_id'];?>" > 
                             <p>-</>
                           </a>
                           <a href = "/buyer/del_item.php?idItem=<?php echo $product[0]['item_id'];?>" > 
                             <p>Удалить</>
                           </a>
                            </div>
                        </div>

                    <?php }

echo 'Всего: '.$sumprice.'р.';
                    $_SESSION['sumprice']=$sumprice;


                    ?>

    <a href = "/buyer/made_order.php" >
    <p>Заказать</p>
</a>
<?php
                  }

                    else{
                      echo "Корзина пуста :(";
                    }


if($_GET['empty']){
  echo $_GET['empty'];
  unset($_GET['empty']);
}
?>

<dev>


</dev>
