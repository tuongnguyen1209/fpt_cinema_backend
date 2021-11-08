<?php
class db{
    private $username = "root";
    private $password = "";
    private $host = "localhost";
    private $database = 'project_cinema';
    private $conn;

    public function connect(){
        $this->conn = null;
        try{
        $this->conn = new PDO("mysql:host=".$this->host."; dbname=".$this->database."",$this->username,$this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
        echo "Errol". $e->getMessage();
        }
        return $this->conn;
    }
}
    

?>
