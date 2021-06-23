<?php
session_start();

if(isset($_GET['idItem'])){
    $item = $_GET['idItem'];
  //  echo $item;
}
else{
	echo "error";
}


foreach ($_SESSION['idNumber'] as $key => &$search) {
	
for($i=0; $i<count($search); $i++){
	if($search['id'][$i]==$item){
	unset($_SESSION['idNumber'][$i]) ;
		sort($_SESSION['idNumber']);

//echo $search['id'][$i];
//print_r( $_SESSION['idNumber'][$i]);
	}


}}


foreach ($_SESSION['items'] as $key => &$delItem) {
for($i=0; $i<count($delItem[0]); $i++){
	// $delItem[0]['item_id'][$i];

	if(!$delItem['item_id'][$i]==$item){

		//echo $delItem[0]['item_id'][$i];
		//print_r($_SESSION['items'][$i]) ;
		//echo $item;
		$del=$i;



	}

}
}

//echo $del;

 //mysqli_error($link) . "\n";
unset($_SESSION['items'][$del-1]) ;

//	unset($_SESSION['items'][$del]) ;
	sort($_SESSION['items']);


//print_r($_SESSION['items']) ;
//echo "<br>";
//print_r($_SESSION['idNumber']) ;

header("Location: /buyer/box.php");
?>