<?
//Загружаем настройки и подключаемся к базе
require_once('../config.php');
//Узнаем количество записей
$hmp = mysql_result(mysql_query("SELECT COUNT( * ) FROM  `post`"),0);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Blog / admin</title>
  <link rel="stylesheet" href="../style.css">
  <meta charset="UTF-8">
</head>
<body>
<div id="main">
  <div id="logo">&lt;? <a href="#">Blog name</a> ?&gt;</div>
  <div id="content">
    <h1>Добавление записи</h1>
    <div class="admin-form">
    <form id="add-form" name="add-form" method="post">
        <span>Title:</span><br><input name="title" type="text"></input><br>
        <span>Text:</span><br> <textarea name="text" type="text" maxlength="10000"></textarea><br>
        <input id="button" name="add" type="submit" value="OK!"> 
    </form>
    </div>
  <?
  if (isset($_POST['add'])) {
    mysql_query("INSERT INTO `post`(`title`, `date`, `text`) VALUES ('".$_POST['title']."',CURDATE(),'".$_POST['text']."')");
    echo "<div class='alert'>Запись добавлена!</div>";}
  ?>
    <hr>
    <h1>Перечень записей</h1>
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
    echo "<tr><td>".$id."</td><td>".$title."</td></tr>";
  }
  ?>
  </table>
  </div>
  <hr>
  <h1>Удаление записи</h1>
  <div class="admin-form">
  <form id="del-form" name="add-form" method="post">
        <span>ID:</span><br><input name="id" type="text"></input><br>
        <input id="button" name="del" type="submit" value="Delete!"> 
  </form>
  </div>
  <?
  if (isset($_POST['del'])) {
    mysql_query("DELETE FROM `post` WHERE `id`=".$_POST['id']);
    echo "<div class='alert'>Запись удалена!</div>";}
  ?>
  </div>
</div>
</body>
</html>
<?
//Отключаемся от БД
mysql_close($DBC);
?>