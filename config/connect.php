<?php
error_reporting(0);
class Database{
    private $host = "localhost";
    private $db_name = "social14_nv3";
    private $username = "social14_nv3";
    private $password = "mister2005";
    public $conn;
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch(PDOException $exception){
            $this->getConnection();
            return $this->conn;
        }
        return $this->conn;
    }
}
$database = new Database();
$db = $database->getConnection();
?>