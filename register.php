<?php
if(isset($_POST['nickname']) && isset($_POST['password']) && isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email'])){
  $nickname=$_POST['nickname'];
  $password=$_POST['password'];
  $surname=$_POST['surname'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  if($nickname !="" && $password !="" && $surname !="" && $name !="" && $email !=""){
    $dsn = "mysql:host=localhost;port=3306;dbname=rubrikatornti;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
      ];
    $pdo = new PDO($dsn, 'root', '', $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних

    $sql="INSERT INTO user (nickname, password, surname_user, name_user, email)
    VALUES('$nickname', '$password', '$surname', '$name', '$email')";
    $pdo->exec($sql);
    echo "<p style='text-align: center'>Новий користувач зареєстрований</p>";
  }
}
?>