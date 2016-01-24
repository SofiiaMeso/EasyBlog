<?
//Debug
error_reporting(-1) ; // включить все виды ошибок, включая  E_STRICT
ini_set('display_errors', 'On');  // вывести на экран помимо логов
//Проверка входа
session_start();
if (empty($_SESSION['auth'])){
  header("Location: login.php");
}
//Загружаем настройки
require_once('../config.php');
//Подключение к БД
$DBC = mysql_connect($host,$user,$pass)
 or die("Could not connect: " . mysql_error());
mysql_select_db($db);
//Узнаем количество записей
$hmp = mysql_result(mysql_query("SELECT COUNT( * ) FROM  `post`"),0);
?>
<!DOCTYPE html>
<html>
<head>
  <?echo "<title>".$blog." / admin</title>";?>
  <link rel="stylesheet" href="../style.css">
  <meta charset="UTF-8">
  <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript"> 
  
    function hideBtn(){
      $('#upload').hide();
      $('#res').html("Идет загрузка файла");
    }
    
    function handleResponse(mes) {
      $('#upload').show();
        if (mes.errors != null) {
          $('#res').html("Возникли ошибки во время загрузки файла: " + mes.errors);
        } 
        else {
          $('#res').html("Файл " + mes.name + " загружен в каталог /files/"); 
        } 
    }
  </script> 
</head>
<body>
<div id="main">
  <div id="logo">&lt;? <?echo '<a href="'.$url.'">'.$blog.'</a>'?> ?&gt;</div>
  <hr>
  <div id="content">
<!--Форма добавления поста-->
    <div id="add" class="admin-form">
    <h1>Новая запись</h1>
    <form name="add-form" method="post">
        <span>Заголовок:</span><br><input name="title" type="text"></input><br>
        <span>Текст:</span><br><textarea name="text" type="text" maxlength="10000"></textarea><br>
        <input class="button" name="add" type="submit" value="Добавить"></input>
    </form>
    <form action="upload.php" method="post" target="hiddenframe" enctype="multipart/form-data" onsubmit="hideBtn();">
      <input type="file" id="userfile" name="userfile" />
      <input class="button" type="submit" name="upload" id="upload" value="Прикрепить файл" />
    </form>
    <div id="res"></div>
    <iframe id="hiddenframe" name="hiddenframe" style="width:0px; height:0px; border:0px"></iframe>
<?
 if (isset($_POST['add'])) {
  if (!empty($_POST['title']) and !empty($_POST['text'])) {
    mysql_query("INSERT INTO `post`(`title`, `date`, `text`) VALUES ('".$_POST['title']."',CURDATE(),'".$_POST['text']."')");
    echo "<script>alert('Запись добавлена!');document.location.href='".$url."/admin/post.php?id=".mysql_insert_id()."';</script>";
  } else {
    echo "<script>alert('Поля не должны быть пустыми!');</script>";
  }
}
?>
<!---->
<!--Список постов-->
    <h1>Записи</h1>
    <div id="post-list">
    <table>
    <tr><td>ID</td><td>Title</td></tr>
<?
//Загружаем информацию
$query =  mysql_query("SELECT `id`,`title` FROM  `post` ORDER BY `id` DESC");
//Выводим записи
for ($i=0; $i<$hmp; $i++) {
  $id =  mysql_result($query,$i,'id');
  $title =  mysql_result($query,$i,'title');
  echo "<tr><td><a href='".$url."/admin/post.php?id=".$id."'>".$id."</a></td><td>".$title."</td></tr>";
}
?>
    </table>
    </div>
  </div>
</body>
</html>
<?
//Отключаемся от БД
mysql_close($DBC);
?>