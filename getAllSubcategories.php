<?php
$dsn = "mysql:host=localhost;port=3306;dbname=rubrikatornti;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, 'root', '', $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних

$code=$_POST['code'];
$table="";
$subTable="";
$idField="";
$codeField="";
$codeOutputField="";
$nameOutputField="";
if(strlen($code) == 2) { 
    $table="class";
    $subTable= "subclass";
    $idField= "id_class";
    $codeField="code_class";
    $codeOutputField="code_subclass";
    $nameOutputField="name_subclass";
}else
if(strlen($code) == 5) {
    $table="subclass";
    $subTable= "`group`";
    $idField="id_subclass";
    $codeField="code_subclass";
    $codeOutputField="code_group";
    $nameOutputField="name_group";
}else{
    $table="`group`";
    $subTable= "subgroup";
    $idField="id_group";
    $codeField="code_group";
    $codeOutputField="code_subgroup";
    $nameOutputField="name_subgroup";
}
$id=0;
$stmt=$pdo->query("SELECT * FROM $table WHERE $codeField = '$code'");
while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $id=$row[$idField];
}

$stmt = $pdo->query("SELECT * FROM $subTable WHERE $idField = '$id'");
while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $code = $row[$codeOutputField];
    $name = $row[$nameOutputField];
    echo "<tr>";
    echo "<td onclick=getAllSubcategories(this)>$code</td>";
    echo "<td>$name</td>";
    echo "</tr>";  
}
?>