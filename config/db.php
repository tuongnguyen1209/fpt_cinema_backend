<?php
class db
{
    // private $username = "root";
    // private $password = "";
    // private $host = "localhost";
    // private $database = 'project_cinema';
    // private $conn;
    private $username = "b5a9ccdd772ea3";
    private $password = "df4e10ec";
    private $host = "us-cdbr-east-04.cleardb.com";
    private $database = 'heroku_1cd49e7abd7fcd4';
    private $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->database . "", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Errol" . $e->getMessage();
        }
        return $this->conn;
    }
}
