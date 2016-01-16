<?
//Debug
error_reporting(-1) ; // включить все виды ошибок, включая  E_STRICT
ini_set('display_errors', 'On');  // вывести на экран помимо логов
//Проверка входа
session_start();
if (!empty($_SESSION['auth'])){
  header("Location: index.php");
}
//Загружаем настройки
require_once('../config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <?echo "<title>".$blog." / admin/login</title>";?>
  <link rel="stylesheet" href="../style.css">
  <meta charset="UTF-8">
  <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
</head>
<body>
<div id="main">
  <div id="logo">&lt;? <?echo '<a href="'.$url.'">'.$blog.'</a>'?> ?&gt;</div>
  <hr>
  <div id="content">
    <div class="admin-form">
    <form name="login-form" method="post">
        <span>Login:</span><br><input name="login" type="text"></input><br>
        <span>PassWord:</span><br><input name="passwd" type="password"></input><br>
        <input class="button" name="ok" type="submit" value="Login"></input>
    </form>
    </div>
<?
 if (isset($_POST['ok'])) {
  	if ($_POST['login']==$login and $_POST['passwd']=$pass) {
  		$_SESSION['auth']="logged";
  		echo "<script>alert('Вход выполнен!');document.location.href='".$url."/admin';</script>";
  } else {
    echo "<script>alert('Логин/Пароль неверны!');</script>";
  }
}
?>
	</div>
</body>