<?php

function findPosition($array, $code){
    for($i = 0; $i < count($array); $i++){
        $code1 = $array[$i][0];
        if($code == $code1){
            return $i;
        }
    }
    return -1;
}

function sortArray($array){
    for($i = 0; $i < count($array); $i++){
        for($j = $i+1; $j < count($array); $j++){
            if($array[$i][2] < $array[$j][2]){
                $tmp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $tmp;
            }
        }        
    }
    return $array;
}

$searchUa = 0;
$searchEng = 0;
$resultsAmount = 0;
$resultsAmountEng = 0;
$resultArray=array();
$resultArrayEng=array();
$classesCheck=false;
$subclassesCheck=false;
$groupsCheck=false;
$subgroupsCheck=false;



$dsn = "mysql:host=localhost;port=3306;dbname=rubrikatornti;charset=utf8";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, 'root', '', $options);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних

$dsn1 = "mysql:host=localhost;port=3306;dbname=rubrikatornti_eng;charset=utf8";
$options1 = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo1 = new PDO($dsn1, 'root', '', $options1);
$pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних




if(isset($_POST['searchField']) && $_POST['searchField'] != "") {
    $searchString = $_POST["searchField"];
    $keyWordsArray = array();
    $searchUa = 1;
    while(strpos($searchString, ",")){
        $keyWord = strstr($searchString, ',', true);
        $keyWordsArray[] = $keyWord;
        $searchString = substr($searchString, strpos($searchString, ","));
        $searchString = substr($searchString, strpos($searchString, $searchString[2]));
    }
    $keyWordsArray[] = $searchString; //Розділення вхідної строки на ключові слова 
    if(isset($_POST['Classes'])){
        $classesCheck=$_POST['Classes'];
    }
    if(isset($_POST['Subclasses'])){
        $subclassesCheck=$_POST['Subclasses'];
    }
    if(isset($_POST['Groups'])){
        $groupsCheck=$_POST['Groups'];
    }
    if(isset($_POST['Subgroups'])){
        $subgroupsCheck=$_POST['Subgroups'];
    }   
    for($j = 0; $j < count($keyWordsArray); $j++){
        if($classesCheck){
            $stmt = $pdo->query("SELECT * FROM class WHERE name_class LIKE '%$keyWordsArray[$j]%'");        
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArray, $row['code_class']) == -1){
                    $resultArray[]=array($row['code_class'], $row['name_class'], 1);
                }else{
                    $resultArray[findPosition($resultArray, $row['code_class'])][2]++;
                }
            }
        }
        if($subclassesCheck){
            $stmt = $pdo->query("SELECT * FROM subclass WHERE name_subclass LIKE '%$keyWordsArray[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArray, $row['code_subclass']) == -1){
                    $resultArray[]=array($row['code_subclass'], $row['name_subclass'], 1);
                }else{
                    $resultArray[findPosition($resultArray, $row['code_subclass'])][2]++;
                }
            }
        }
        if($groupsCheck){
            $stmt = $pdo->query("SELECT * FROM `group` WHERE name_group LIKE '%$keyWordsArray[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArray, $row['code_group']) == -1){
                    $resultArray[]=array($row['code_group'], $row['name_group'], 1);
                }else{
                    $resultArray[findPosition($resultArray, $row['code_group'])][2]++;
                }
            }
        }
        if($subgroupsCheck){
            $stmt = $pdo->query("SELECT * FROM subgroup WHERE name_subgroup LIKE '%$keyWordsArray[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArray, $row['code_subgroup']) == -1){
                    $resultArray[]=array($row['code_subgroup'], $row['name_subgroup'], 1);
                }else{
                    $resultArray[findPosition($resultArray, $row['code_subgroup'])][2]++;
                }
            }    
        }
    }
    $resultArray=sortArray($resultArray);
    $resultsAmount = count($resultArray);

}

if(isset($_POST['searchFieldEng']) && $_POST['searchFieldEng'] != "") {
    $searchStringEng = $_POST["searchFieldEng"];
    $keyWordsArrayEng =array();
    $searchEng = 1;
    while(strpos($searchStringEng, ",")){
        $keyWord = strstr($searchStringEng, ',', true);
        $keyWordsArrayEng[] = $keyWord;
        $searchStringEng = substr($searchStringEng, strpos($searchStringEng, ","));
        $searchStringEng = substr($searchStringEng, strpos($searchStringEng, $searchStringEng[2]));
    }
    $keyWordsArrayEng[] = $searchStringEng;
    if(isset($_POST['Classes'])){
        $classesCheck=$_POST['Classes'];
    }
    if(isset($_POST['Subclasses'])){
        $subclassesCheck=$_POST['Subclasses'];
    }
    if(isset($_POST['Groups'])){
        $groupsCheck=$_POST['Groups'];
    }
    if(isset($_POST['Subgroups'])){
        $subgroupsCheck=$_POST['Subgroups'];
    }    
    for($j = 0; $j < count($keyWordsArrayEng); $j++){
        if($classesCheck){
            $stmt = $pdo1->query("SELECT * FROM class WHERE name_class LIKE '%$keyWordsArrayEng[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArrayEng, $row['code_class']) == -1){
                    $resultArrayEng[]=array($row['code_class'], $row['name_class'], 1);
                }else{
                    $resultArrayEng[findPosition($resultArrayEng, $row['code_class'])][2]++;
                }
            }
        }
        if($subclassesCheck){
            $stmt = $pdo1->query("SELECT * FROM subclass WHERE name_subclass LIKE '%$keyWordsArrayEng[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArrayEng, $row['code_subclass']) == -1){
                    $resultArrayEng[]=array($row['code_subclass'], $row['name_subclass'], 1);
                }else{
                    $resultArrayEng[findPosition($resultArrayEng, $row['code_subclass'])][2]++;
                }
            }
        }
        if($groupsCheck){
            $stmt = $pdo1->query("SELECT * FROM `group` WHERE name_group LIKE '%$keyWordsArrayEng[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArrayEng, $row['code_group']) == -1){
                    $resultArrayEng[]=array($row['code_group'], $row['name_group'], 1);
                }else{
                    $resultArrayEng[findPosition($resultArrayEng, $row['code_group'])][2]++;
                }
            }
        }
        if($subgroupsCheck){
            $stmt = $pdo1->query("SELECT * FROM subgroup WHERE name_subgroup LIKE '%$keyWordsArrayEng[$j]%'");
            while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                if(findPosition($resultArrayEng, $row['code_subgroup']) == -1){
                    $resultArrayEng[]=array($row['code_subgroup'], $row['name_subgroup'], 1);
                }else{
                    $resultArrayEng[findPosition($resultArrayEng, $row['code_subgroup'])][2]++;
                }
            }    
        }
    }
    $resultArrayEng=sortArray($resultArrayEng);
    $resultsAmountEng = count($resultArrayEng);
    
}



if($searchEng == 1 || $searchUa == 1){
    for($i = 0; $i < count($resultArrayEng); $i++) {
        $searchIndex = -1;
        for($j = 0; $j < count($resultArray); $j++) {
            $check =strcasecmp($resultArrayEng[$i][0], $resultArray[$j][0]);
            if(strcmp($resultArrayEng[$i][0], $resultArray[$j][0]) == 0) {
                $resultArray[$j][2]+=$resultArrayEng[$i][2];
                $searchIndex = $j;
                break;
            }
        }
        if($searchIndex == -1) {
            $code = $resultArrayEng[$i][0];   
            if(strlen($code) == 2) {
                $stmt = $pdo->query("SELECT * FROM class WHERE code_class = '$code'");
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                    $resultArray[]=array($row['code_class'], $row['name_class'], $resultArrayEng[$i][2]);
                }
            }else
            if(strlen($code) == 5) {
                $stmt = $pdo->query("SELECT * FROM subclass WHERE code_subclass = '$code'");
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                    $resultArray[]=array($row['code_subclass'], $row['name_subclass'], $resultArrayEng[$i][2]);
                }
            }else
            if(strlen($code) == 8) {
                $stmt = $pdo->query("SELECT * FROM `group` WHERE code_group = '$code'");
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                    $resultArray[]=array($row['code_group'], $row['name_group'], $resultArrayEng[$i][2]);
                }
            }
            else{
                $stmt = $pdo->query("SELECT * FROM subgroup WHERE code_subgroup = '$code'");
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                    $resultArray[]=array($row['code_subgroup'], $row['name_subgroup'], $resultArrayEng[$i][2]);
                }
            }
        }
    }
    $resultArray=sortArray($resultArray);
    $resultArrayAmount=count($resultArray);
    echo "Кількість знайдених результатів : $resultArrayAmount. ";
    echo "<table>";
    echo "<tr><th>Код рубрики</th><th>Назва рубрики</th><th>Кількість повторів</th></tr>";
    for($i = 0; $i < count($resultArray); $i++) {
        $str=$resultArray[$i][1];
        $repeatAmmount=$resultArray[$i][2];
        $code=$resultArray[$i][0];
        echo "<tr>";
        echo "<td onclick=getAllSubcategories(this)>$code</td>";
        echo "<td>$str</td>";
        echo "<td>$repeatAmmount</td>";
        echo "</tr>";
    }
    echo "</table>";
}



if(isset($_POST['codeSearchField'])) {
    $searchCode=$_POST['codeSearchField'];

    $dsn = "mysql:host=localhost;port=3306;dbname=rubrikatornti;charset=utf8";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, 'root', '', $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //підключення до бази даних
    $codeSearchResult = "";
    if(strlen($searchCode) == 2) {
        $stmt = $pdo->query("SELECT * FROM class WHERE code_class = '$searchCode'");
        while($row = $stmt->fetch(PDO::FETCH_BOTH)){
            $codeSearchResult=$row['name_class'];
        }
    }else
    if(strlen($searchCode) == 5) {
        $stmt = $pdo->query("SELECT * FROM subclass WHERE code_subclass = '$searchCode'");
        while($row = $stmt->fetch(PDO::FETCH_BOTH)){
            $codeSearchResult=$row['name_subclass'];
        }
    }else
    if(strlen($searchCode) == 8) {
        $stmt = $pdo->query("SELECT * FROM `group` WHERE code_group = '$searchCode'");
        while($row = $stmt->fetch(PDO::FETCH_BOTH)){
            $codeSearchResult=$row['name_group'];
        }
    }
    else{
        $stmt = $pdo->query("SELECT * FROM subgroup WHERE code_subgroup = '$searchCode'");
        while($row = $stmt->fetch(PDO::FETCH_BOTH)){
            $codeSearchResult=$row['name_subgroup'];
        }
    }
    echo "Результат пошуку по коду: $codeSearchResult";
}
?>