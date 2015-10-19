<?php

class Database
{
    private static $_instance = null;
    private $_pdo;

    private function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    public function fetchNamesByDay($day)
    {
        $current_week_day = $day; // date("l");
        $weekNames = array();

        $query = $this->_pdo->prepare("SELECT name FROM names where day_of_week = :Week_day");
        $query->execute(array(':Week_day' => $current_week_day));
        $row = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($row as $obj) {
            array_push($weekNames, $obj['name']);
        }
        $Names = implode(',', $weekNames);
        return $Names;
    }
}