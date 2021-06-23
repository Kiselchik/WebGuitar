<?php
session_start();
include '../general/data.php';

$from = $_GET['from'];
$to = $_GET['to'];
$gr= $_GET['graph'];
$_SESSION['graph']=$gr;
//соединение с БД
//echo $from;
//echo $to;
$link = mysqli_connect($db_host, $db_user,$db_password,$db_base);

$q_money="SELECT SUM((order_item.price-contract.one_price)*order_item.quantity) as profit FROM order_item INNER JOIN contract ON order_item.item_id = contract.item_id INNER JOIN  user_order ON order_item.order_id = user_order.order_id WHERE o_date >='$from' AND o_date <='$to'";
$r_money=mysqli_query($link, $q_money);
if($r_money){
	while($tmp = $r_money->fetch_assoc()){
    $profit=$tmp;
   $_SESSION['profit']=$profit;

  }	

  //print_r($_SESSION['profit']);
}

if(isset($_SESSION['graph'])){

include '../general/lib/jpgraph-4.2.10/src/jpgraph.php' ;
include '../general/lib/jpgraph-4.2.10/src/jpgraph_line.php' ;

$q_xy="SELECT date_format(o_date, '%m.%y') as o_date,SUM((order_item.price-contract.one_price)*order_item.quantity)/1000 as profit FROM order_item INNER JOIN contract ON order_item.item_id = contract.item_id INNER JOIN  user_order ON order_item.order_id = user_order.order_id 
WHERE o_date >='$from' AND o_date <='$to'
GROUP BY date_format(o_date, '%y.%m') ASC";
$r_xy=mysqli_query($link, $q_xy);

if($r_xy){
	while($tmp = $r_xy->fetch_assoc()){
		$data[]=$tmp['o_date'];
		$ydata[]=$tmp['profit'];
   //$_SESSION['profit']=$profit;

  }	
}


//размеры графика
$graph = new Graph(600, 400);
//тип графика
$graph->SetScale('textlin');
//использованные оси
$lineplot = new LinePlot($ydata);
//добавление кривой
$graph->Add($lineplot);
//цвет кривой
$lineplot->SetColor("#FF1493");
//имя графика
$graph->title->Set('Прибыль');
//настройка шрифтов
$graph->title->SetFont(FF_VERDANA, FS_ITALIC);
$graph->xaxis->title->SetFont(FF_VERDANA, FS_ITALIC);
$graph->yaxis->title->SetFont(FF_VERDANA, FS_ITALIC);
//название осей
$graph->xaxis->title->Set('Дата');
$graph->yaxis->title->Set('Деньги, т');
//стиль линии
$graph->xgrid->SetLineStyle("solid");
//отступы
$graph->SetMargin(105,55,55,55);
//цвет осей
$graph->xaxis->SetColor('#СС0000');
$graph->yaxis->SetColor('#СС0000');
//подпись оси Х
$graph->xaxis->SetTickLabels($data);
//толщина кривой
$lineplot->SetWeight(3);
//тип маркера
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
//над каждым маркером показать значение
$lineplot->value->Show();
//удаление графика, если он уже был создан
unlink("../img/graph.jpg");
//сохранение графика
$graph->Stroke("../img/graph.jpg");

unset($_GET['graph']);
}

 header("Location: /owner/vladelets_lk.php");

?>
