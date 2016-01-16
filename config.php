<?
//Настройки блога
$blog = "Название блога";
$url = "Адрес блога";
$login = "Логин администратора";
$pass = "Пароль администртора";
//Настройки подключения
$host = "Сервер БД";
$user = "Пользователь БД";
$pass = "Пароль пользователя БД";
$db = "Имя БД";
//Подключение к БД
$DBC = mysql_connect($host,$user, $pass)
 or die("Could not connect: " . mysql_error());
mysql_select_db($db);
?>
