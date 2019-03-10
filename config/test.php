<?php
session_start();

public $conn;
private $dbName="gets";
private $host="localhost";
private $password = "";
private $username = "root";

public function getConnection(){
	$this->conn = null;
	try{
		// $this->conn = new PDO("mysql:host='localhost';dbname='gets','root'");
		$this->conn = new PDO(`mysql:host=localhost;dbname=gets,root`);
		$this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->$username, $this->password);
	}
	catch(PDOException $exception){
		echo "Database Connection Error! ".$exception->getMessage();
	}
	return $this->conn;
}


?>