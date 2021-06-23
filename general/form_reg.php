<?php
include 'data.php';
//присвоение переменным полученных значений
$name=$_POST['f_name'];
$sname=$_POST['s_name'];
$mname=$_POST['m_name'];
$mail=$_POST['mail'];
$tel=$_POST['tel'];
$login = $_POST['login'];
$password= $_POST['password'];
//хэширование пароля
$hash= password_hash($password, PASSWORD_DEFAULT);
//соединение с БД
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);
//запрос
$q_to_user = "INSERT INTO user(id, login, password, mail) VALUES ( (SELECT MAX(user_id) FROM buyer WHERE f_name = '$name' and s_name = '$sname'and m_name='$mname'and tel='$tel') ,'$login', '$hash', '$mail')";
$q_to_buyer = "INSERT INTO buyer(f_name, s_name, m_name, tel, role_id) VALUES ( '$name', '$sname', '$mname', '$tel', 2)";


$q_check= "SELECT password, id FROM user WHERE login = '$login'";
$r_check= mysqli_query($link,$q_check);
if($r_check){

	while ($row = mysqli_fetch_assoc($r_check)) {
	$pass=$row["password"];
	 $userID=$row["id"];
	 	$_SESSION['user_id']=$userID;
	 	}
if($pass==null  && $userID==null){
$r_to_buyer = mysqli_query($link,$q_to_buyer );
$r_to_user = mysqli_query($link,$q_to_user );
if($r_to_user && $r_to_buyer){
$msg="Регистрация прошла успешно";
header("Location: /index.php?msg=$msg");
exit();
	}

else{
$msg="error";
header("Location: /index.php?msg=$msg");
die();  }
session_destroy();
}
else{
	$msg="Учтеная запись с такими данными уже существует";
header("Location: /index.php?msg=$msg");
die(); 
session_destroy();
}
}


//соединение и запрос

//При удачном соединении и выполнении запроса
//на странице выводится сообщение о успешной регистрации
//Иначе сообщение о том, что учетная запись с такими данными существует

