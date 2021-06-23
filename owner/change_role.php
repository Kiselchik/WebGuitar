<?php
session_start();
include '../general/data.php';

$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$login=$_SESSION['login_search'];
//запрос
$toprod = "UPDATE buyer SET role_id = 3 WHERE user_id = (SELECT id FROM user WHERE login = '$login')";
$tobuyer = "UPDATE buyer SET role_id = 2 WHERE user_id = (SELECT id FROM user WHERE login = '$login')";



$r_tobuyer = mysqli_query($link,$tobuyer );
$r_toprod = mysqli_query($link,$toprod );

if(is_array($_SESSION['userRole'])){
foreach ($_SESSION['userRole'] as $key => &$role) {

if($role=="СЛк"){
$r_toprod = mysqli_query($link,$toprod );
$role = "Продавец";

}
elseif ($role == "Продавец") {
$r_tobuyer = mysqli_query($link,$tobuyer );
$role = "СЛк";
}


}}
else{
if($_SESSION['userRole']=="СЛк"){
$r_toprod = mysqli_query($link,$toprod );
$_SESSION['userRole']="Продавец";

}
elseif ($_SESSION['userRole'] == "Продавец") {
$r_tobuyer = mysqli_query($link,$tobuyer );
$_SESSION['userRole'] ="СЛк";
}


}

header("Location:  /owner/vladelets_lk.php");







	

