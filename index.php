<?
//Debug
error_reporting(-1) ; // включить все виды ошибок, включая  E_STRICT
ini_set('display_errors', 'On');  // вывести на экран помимо логов
//Загружаем настройки и подключаемся к базе
require_once('config.php');
//Узнаем количество записей
$hmp = mysql_result(mysql_query("SELECT COUNT( * ) FROM  `post`"),0);
//Загружаем информацию
$query =  mysql_query("SELECT `title`,`date`,`text` FROM  `post` ORDER BY `id` DESC");
?>
<!DOCTYPE html>
<html>
<head>
  <?echo "<title>".$blog."</title>";?>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
</head>
<body>
<div id="main">
  <div id="logo">&lt;? <?echo '<a href="'.$url.'">'.$blog.'</a>'?> ?&gt;</div>
  <div id="content">
<?
//Выводим записи
for ($i=0; $i<$hmp; $i++) {
$title =  mysql_result($query,$i,'title');
$date =  mysql_result($query,$i,'date');
$text =  mysql_result($query,$i,'text');
echo '<div class="post">';
echo '<div class="title">'.$title.'</div>';
echo  '<div class="date">'.$date.'</div>';
echo  '<div class="text">'.$text.'</div>';
echo '</div>';
}?>
  </div>
</div>
</body>
</html>
<?
//Отключаемся от БД
mysql_close($DBC);
?>