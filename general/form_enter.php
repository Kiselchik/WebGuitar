<?php
//Объявление переменных
session_start();

include 'data.php';


$login = $_POST['login2'];
$password= $_POST['password2'];


//соединение
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

//запорс
$q_pass= "SELECT password, id FROM user WHERE login = '$login'";



//соединение и запорс
$r_pass=mysqli_query($link,$q_pass);


//если соединение и запорс выполнены удачно
//пока существуют записи, соответствующие запросу (должна быть одна строка)
//переменной $pass присваивается значение поля password
//Далее, если введенный пароль совпадает с паролем из БД
//Выводится сообщение уведомляющее о входе в учетную запись
//Иначе сообщение об ошибке
if($r_pass) {
while ($row = mysqli_fetch_assoc($r_pass)) {
	$pass=$row["password"];
	 	$userID=$row["id"];
	 	$_SESSION['user_id']=$userID;
	 	}

		if(password_verify($password, $pass)){
		$_SESSION['login']=$login;
		$msg="вошли";
		//echo $msg;

		$q_role="SELECT role_id FROM buyer WHERE user_id='$userID'";
$r_role=mysqli_query($link,$q_role);
if($r_role){
	while ($row = mysqli_fetch_assoc($r_role)) {
	 	$role=$row;
	 	//print_r($role);
	 	//echo "попытка вывести роль";

	 	}


	 		if($role['role_id']==2){
	 			$msg=2;
	 				 $_SESSION['role']=$msg;

	 			//echo "ЭТО ПРОДАВЕЦ";
	 			header("Location: /index.php?");
	 		}


	 		if($role['role_id']==3){
	 			$msg=3;
	 				 $_SESSION['role']=$msg;

	 			//echo "ЭТО ПРОДАВЕЦ";
	 			header("Location: /index.php?");
	 		}
	 		if($role['role_id']==4){
	 			$msg=4;
	 				 $_SESSION['role']=$msg;

	 			//echo "ЭТО ВЛАДЕЛЕЦ";
	 			header("Location: /index.php?");
	 		}	
}

	//	header("Location: index.php?msg=$msg");
		//$_SESSION['user_id'] = $userID;
	}

else {

$msg="Неврный логин или пароль";
echo $msg;
header("Location: /index.php?msg=$msg");
}



}