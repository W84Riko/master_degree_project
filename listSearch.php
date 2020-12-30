<?php
if(isset($_POST['searchField'])){
    $searchField = $_POST['searchField'];

    $dsn = "mysql:host=localhost;port=3306;dbname=rubrikatornti;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, 'root', '', $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних

    $resultArray=array();
    $stmt = $pdo->query("SELECT * FROM class WHERE name_class LIKE '%$searchField%'");        
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
        $resultArray[]=array($row['code_class'], $row['name_class']);        
    }
    $stmt = $pdo->query("SELECT * FROM subclass WHERE name_subclass LIKE '%$searchField%'");
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
        $resultArray[]=array($row['code_subclass'], $row['name_subclass']);        
    }
    $stmt = $pdo->query("SELECT * FROM `group` WHERE name_group LIKE '%$searchField%'");
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
        $resultArray[]=array($row['code_group'], $row['name_group'], 1);       
    }
    $stmt = $pdo->query("SELECT * FROM subgroup WHERE name_subgroup LIKE '%$searchField%'");
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){        
            $resultArray[]=array($row['code_subgroup'], $row['name_subgroup'], 1);        
    }
    for($i = 0; $i < count($resultArray); $i++) {
        $str=$resultArray[$i][1];
        $code=$resultArray[$i][0];
        echo "<tr>";
        echo "<td onclick=getAllSubcategories(this)>$code</td>";
        echo "<td>$str</td>";
        echo "</tr>";
    }
}
?>