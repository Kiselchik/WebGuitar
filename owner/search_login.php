<?php
session_start();
include '../general/data.php';
$login = $_POST['login_search'];
$_SESSION['login_search']=$login;

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$query = "SELECT f_name, s_name, m_name, tel, mail, date_reg FROM buyer INNER JOIN user ON buyer.user_id = user.id WHERE user.login = '$login'";

$query2="SELECT role_name FROM role INNER JOIN buyer ON role.role_id=buyer.role_id WHERE buyer.user_id = (SELECT id FROM user WHERE login = '$login') ";

$result = mysqli_query($link,$query );
$result2 = mysqli_query($link,$query2 );
$infoUser = array();


if($result){
while($tmp = $result->fetch_assoc()){
    $infoUser[]=$tmp;
    $_SESSION['infoUser']=$infoUser;

  }	}


  if($result2){
  	$userRole = $result2->fetch_assoc();
  	$_SESSION['userRole']=$userRole;
  }
  

	else{
		echo "error";
	}

	header("Location:  /owner/vladelets_lk.php");


?>