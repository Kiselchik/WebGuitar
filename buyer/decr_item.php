<?php
session_start();

  
if(isset($_GET['idItem'])){
    $item = $_GET['idItem'];

}
else{
	echo "error";
}


foreach ($_SESSION['idNumber'] as $key => &$search) {
	

	if($search['id']==$item){
		$search['number']--;
	}

}


header("Location: /buyer/box.php");
?>