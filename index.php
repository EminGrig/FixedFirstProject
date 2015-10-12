<?php

$conn_error = "couldn't connect";
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = 'alarm';
$mysql_db = "hello";
$current_week_day=date("l");
$weekNames=array();
//$day_of_week=$current_week;
//$result = $db->query( );
try{
    $db = new PDO('mysql:host=' . $mysql_host . ';dbname=' . $mysql_db, $mysql_user, $mysql_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException  $e ){
    echo $e->getMessage();
}

$query = $db->prepare("SELECT name FROM names where day_of_week = :Week_day");
$query->execute(array(':Week_day' => $current_week_day));
$row = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($row as $obj ){
    array_push($weekNames,$obj['name']);
}
$Names = implode(',',$weekNames);
echo "Hello ", $Names;