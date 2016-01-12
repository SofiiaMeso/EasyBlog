<?
//Настройки подключения
$host = "DB-host";
$user = "DB-user";
$pass = "DB-pass";
$db = "DB-name";
//Подключение к БД
$DBC = mysql_connect($host,$user, $pass)
 or die("Could not connect: " . mysql_error());
mysql_select_db($db);
?>