<?php
$dsn = "mysql:host=localhost;port=3306;dbname=rubrikatornti;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, 'root', '', $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних

$stmt = $pdo->query("SELECT * FROM class");
echo "<table id='Searchtable'>";
echo "<tr><th>Код рубрики</th><th>Назва рубрики</th></tr>";
while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $code = $row['code_class'];
    $name = $row['name_class'];
    echo "<tr>";
    echo "<td onclick=getAllSubcategories(this)>$code</td>";
    echo "<td>$name</td>";
    echo "</tr>";    
}
echo "</table>";
?>