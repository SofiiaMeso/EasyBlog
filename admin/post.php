<?
//Debug
error_reporting(-1) ; // включить все виды ошибок, включая  E_STRICT
ini_set('display_errors', 'On');  // вывести на экран помимо логов
//Проверка входа
session_start();
if (empty($_SESSION['auth'])){
  header("Location: login.php");
}
//Проверка Get-запроса
if (!isset($_GET['id'])) {
  header("Location: index.php");
}
//Загружаем настройки
require_once('../config.php');
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
$text =  htmlspecialchars(mysql_result($query,0,'text'), ENT_QUOTES);
$date = mysql_result($query,0,'date');
?>
<!DOCTYPE html>
<html>
<head>
  <?echo "<title>".$blog." / admin/post</title>";?>
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
echo "<h1>Запись #".$id."</h1>";
echo '<div class="post">';
echo '<div class="title">'.$title.'</div>';
echo  '<div class="date">'.$date.'</div>';
echo  '<div class="text">'.$text.'</div>';
echo '</div>';
?>
    <h1>Изменение</h1>
    <div id="change" class="admin-form">
    <form name="change-form" method="post">
          <span>ID:</span><br><input name="chid" type="text" readonly value="<?echo $id;?>"></input><br>
          <span>Title:</span><br><input name="chtitle" value="<?echo $title;?>" type="text"></input><br>
          <span>Text:</span><br><textarea name="chtext" type="text" maxlength="10000"><?echo $text;?></textarea><br>
          <input class="button" name="change" type="submit" value="Change"></input>
    </form>
    </div>
    <form name="delete-form" method="post">
        <input class="button" name="del" type="submit" onclick="return confirm('Удалить запись?')" value="Удалить"></input>
    </form>
<?
if (isset($_POST['change'])) {
  if (!empty($_POST['chid'])) {
    $query =  mysql_query("UPDATE `post` SET `title`='".$_POST['chtitle']."',`text`='".$_POST['chtext']."' WHERE `id`=".$_POST['chid']);
    echo "<script>alert('Запись изменена!'); document.location.href='".$url."/admin/post.php?id=".$id."';</script>";
  } else {
    echo "<script>alert('Поле не должно быть пустым!');</script>";
  }
}
if (isset($_POST['del'])) {
  mysql_query("DELETE FROM `post` WHERE `id`=".$id);
  echo "<script>alert('Запись удалена!');document.location.href='".$url."/admin';</script>";
}
?>
  </div>
</body>
</html>
<?
//Отключаемся от БД
mysql_close($DBC);
?>