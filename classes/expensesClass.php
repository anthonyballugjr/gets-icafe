<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");

class Expenses{
	// database connection and table name
    private $conn;
    private $table_name = "expenses";
 
    // object properties
    public $description;
    public $amount;
    

    function __construct($db){
        $this->conn = $db;
    }

    function readExpenses(){
        global $timestamp;
        $query = "SELECT * FROM expenses WHERE dateStamp=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$timestamp);
        $stmt->execute();

        return $stmt;
    }

    function addToExpense(){
        $employee=$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName'];
        $query = "INSERT INTO expenses SET description=?, amount=?, dateStamp=?,employeeOnDuty=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->description);
        $stmt->bindParam(2,$this->amount);
        $stmt->bindParam(3,$this->dateStamp);
        $stmt->bindParam(4,$employee);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
        
    }
}
?>