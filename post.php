<?
//Debug
error_reporting(-1) ; // включить все виды ошибок, включая  E_STRICT
ini_set('display_errors', 'On');  // вывести на экран помимо логов
//Проверка Get-запроса
if (!isset($_GET['id'])) {
  header("Location: index.php");
}
//Загружаем настройки
require_once('config.php');
//Подключение к БД
$DBC = mysql_connect($host,$user, $pass);
mysql_select_db($db);
//Проверяем, есть ли запись
$hmp = mysql_result(mysql_query("SELECT COUNT( * ) FROM  `post` WHERE `id`=".$_GET['id']),0);
if ($hmp==0) {
  header("Location: index.php");
} else {
  $id=$_GET['id'];
}
//Загружаем информацию о записи
$query = mysql_query("SELECT * FROM `post` WHERE `id`=".$id);
$id =  mysql_result($query,0,'id');
$title =  mysql_result($query,0,'title');
$text =  mysql_result($query,0,'text');
$date = mysql_result($query,0,'date');
?>
<!DOCTYPE html>
<html>
<head>
  <?echo "<title>".$blog." / post</title>";?>
  <link rel="stylesheet" href="../style.css">
  <meta charset="UTF-8">
  <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
</head>
<body>
<div id="main">
  <div id="logo">&lt;? <?echo '<a href="'.$url.'">'.$blog.'</a>'?> ?&gt;</div>
  <hr>
  <div id="content">
<?
echo '<div class="post">';
echo '<div class="title">'.$title.'</div>';
echo  '<div class="date">'.$date.'</div>';
echo  '<div class="text">'.$text.'</div>';
echo '</div>';
//Загружаем форму комментариев
require_once('comments.php');
?>
  </div>
</body>
</html>
<?
//Отключаемся от БД
mysql_close($DBC);
?>