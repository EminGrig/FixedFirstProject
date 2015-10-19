<?php
require_once 'init.php';
require_once 'config.php';
require_once 'db.php';

$DB = Database::getInstance();
echo "Hello ". $DB->fetchNamesByDay(date("l"));

//$Names = implode(',', $weekNames);
//echo "Hello ", $Names;


?>
