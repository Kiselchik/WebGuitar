<?php
session_start();
include '../general/data.php';



//соединение с БД

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$employee_id = $_SESSION['user_id'];
$order_id=$_GET['ord'];
$status_id=$_GET['sts'];

$q_change = "UPDATE order_status SET status_id = '$status_id', employee_id='$employee_id' WHERE order_id = '$order_id'";

$q_date="UPDATE order_status SET date_time=NOW() WHERE order_id = '$order_id'";

$r_change = mysqli_query($link,$q_change );
$r_date = mysqli_query($link, $q_date);


if($r_change){
	header("Location:  /seller/all_status.php");
	//echo "ПОЛУЧИЛОСЬ! 1";
}else{
	echo "нет 1";
	 echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";

}
if( $r_date){
 //echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";
header("Location:  /seller/all_status.php");
//searchOrder();
//echo "ПОЛУЧИЛОСЬ!  2";
//

}
else {
		echo "нет 2";

	 echo mysqli_errno($link) . ": " . mysqli_error($link) . "\n";

//echo mysqli_error($link);
//echo mysqli_errno($link);
}


//echo $status_id;;



//echo $order_id;






?>