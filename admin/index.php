<?
//Debug
error_reporting(-1) ; // включить все виды ошибок, включая  E_STRICT
ini_set('display_errors', 'On');  // вывести на экран помимо логов
//Загружаем настройки и подключаемся к базе
require_once('../config.php');
//Узнаем количество записей
$hmp = mysql_result(mysql_query("SELECT COUNT( * ) FROM  `post`"),0);
?>
<!DOCTYPE html>
<html>
<head>
  <?echo "<title>".$blog." / admin</title>";?>
  <link rel="stylesheet" href="../style.css">
  <meta charset="UTF-8">
</head>
<body>
<div id="main">
  <div id="logo">&lt;? <?echo '<a href="'.$url.'">'.$blog.'</a>'?> ?&gt;</div>
  <div id="content">
<!--Форма добавления поста-->
    <h1>Add</h1>
    <div class="admin-form">
    <form name="add-form" method="post">
        <span>Title:</span><br><input name="title" type="text"></input><br>
        <span>Text:</span><br><textarea name="text" type="text" maxlength="10000"></textarea><br>
        <input id="button" name="add" type="submit" value="Add"></input>
    </form>
    </div>
<?
 if (isset($_POST['add'])) {
  if (!empty($_POST['title']) and !empty($_POST['text'])) {
    mysql_query("INSERT INTO `post`(`title`, `date`, `text`) VALUES ('".$_POST['title']."',CURDATE(),'".$_POST['text']."')");
    echo "<script>alert('Запись добавлена!');document.location.href='".$url."';</script>";
  } else {
    echo "<script>alert('Поля не должны быть пустыми!');</script>";
  }
}
?>
<!---->
<!--Список постов-->
  <hr>
    <h1>Post-List</h1>
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
<!---->
<!--Форма загрузки поста-->
    <h1>Load</h1>
    <div class="admin-form">
    <form name="load-form" method="post">
          <span>ID:</span><br><input name="loadid" type="text"></input><br>
          <input id="button" name="load" type="submit" value="Load"></input>
    </form>
    </div>
<?
if (isset($_POST['load'])) {
  if (!empty($_POST['loadid'])) {
    $loaded=$_POST['loadid'];
    $query =  mysql_query("SELECT * FROM  `post` WHERE `id`=".$loaded);
    echo "<b>ID:</b> ".$loaded."  |  <b>Title:</b> ".mysql_result($query,0,'title')."<br><b>Text:</b><br>".htmlspecialchars(mysql_result($query,0,'text'), ENT_QUOTES);
  } else {
    echo "<script>alert('Поле не должно быть пустым!');</script>";
  }
}
?>
  <hr>
<!---->
<!--Форма исправления поста-->
    <h1>Change</h1>
    <div class="admin-form">
    <form name="change-form" method="post">
          <span>ID:</span><br><input name="chid" type="text"></input><br>
          <span>Title:</span><br><input name="chtitle" type="text"></input><br>
          <span>Text:</span><br><textarea name="chtext" type="text" maxlength="10000"></textarea><br>
          <input id="button" name="change" type="submit" value="Change"></input>
    </form>
    </div>
<?
if (isset($_POST['change'])) {
  if (!empty($_POST['chid'])) {
    echo $_POST['chtext'];
    $query =  mysql_query("UPDATE `post` SET `title`='".$_POST['chtitle']."',`text`='".$_POST['chtext']."' WHERE `id`=".$_POST['chid']);
    echo "<script>alert('Запись изменена!'); document.location.href='".$url."';</script>";
  } else {
    echo "<script>alert('Поле не должно быть пустым!');</script>";
  }
}
?>
  <hr>
<!---->
<!--Форма удаления поста-->
    <h1>Delete</h1>
    <div class="admin-form">
    <form name="del-form" method="post">
          <span>ID:</span><br><input name="delid" type="text"></input><br>
          <input id="button" name="del" type="submit" value="Delete"></input>
    </form>
    </div>
<?
if (isset($_POST['del'])) {
  if (!empty($_POST['delid'])) {
    mysql_query("DELETE FROM `post` WHERE `id`=".$_POST['delid']);
    echo "<script>alert('Запись удалена!');document.location.href='".$url."';</script>";
  } else {
    echo "<script>alert('Поле не должно быть пустым!');</script>";
  }
}
?>
<!---->
    </div>
  </div>
</body>
</html>
<?
//Отключаемся от БД
mysql_close($DBC);
?>