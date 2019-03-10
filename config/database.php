<?php

session_start();

class Database{

private $host = "localhost";
private $db_name = "getsdb";
private $username = "root";
private $password = "";
public $conn;


public function getConnection(){
    $this->conn = null;
    try{
        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "database connected";
    }
    catch(PDOException $exception){
        echo "Database Connection Error!".$exception->getMessage();
    }
    return $this->conn;


}
}