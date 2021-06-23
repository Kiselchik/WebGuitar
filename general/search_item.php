<?php
session_start();
require '/general/menu.php';
?>
<h1>Результаты поиска: </h1>
<?php
include 'data.php';

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$search = $_GET['search'];
$q_search_item = "SELECT item_id,item, img, i_price FROM item WHERE item_id IN (SELECT item_id FROM item WHERE item LIKE '%$search%')";
$r_search_item = mysqli_query($link,$q_search_item);
$search_id=array();

if($r_search_item){

  while($tmp = $r_search_item->fetch_assoc()){
    $search_id[]=$tmp;
}

}




?>
<div class="row">
                    <?php foreach($search_id AS $srch) {
				

                    	?>
                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <div class="thumbnail">
                             

                              <a href = "general/item.php?id=<?php echo $srch['item_id'];?>"  > 
                               <img  src="<?php echo $srch['img'];?>" alt="" width="200px" height="200px">
                           </a>
                               

                                <div class="caption">
                                    <h4 class="pull-right"><?php echo $srcht['i_price'];?></h4>
                                   
                                    <h4 class="pull-right"><?php echo $srch['item'];?></h4>
                                    
                                    
                               
                                </div>
                            </div>
                        </div>
                          <?php } ?>
                    </div>