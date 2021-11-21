<?php
class db
{

    private $username;
    private $password;
    private $host;
    private $database;
    private $conn;

    public  function __construct()
    {
        if (!$this->checkProduction()) {
            $this->username = "b5a9ccdd772ea3";
            $this->password = "df4e10ec";
            $this->host = "us-cdbr-east-04.cleardb.com";
            $this->database = 'heroku_1cd49e7abd7fcd4';
        } else {
            $this->username = "root";
            $this->password =  "";
            $this->host =  "localhost";
            $this->database = 'project_cinema';
        }
    }


    public function connect()
    {

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->database . "", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (Exception $e) {
            echo "Errol" . $e->getMessage();
        }
        return $this->conn;
    }
    private function checkProduction()
    {
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1')
            return true;
        return false;
    }
}
