<?php
date_default_timezone_set('Asia/Manila');
$timestamp=date("Y-m-d");
$dateTime=date("Y-m-d h:i:sA");

class  Computer{
	// database connection and table name
    private $conn;
    private $table_name = "computer";
    private $table_name2 = "reservation";
    private $table_name3 = "computersale";
 
    // object properties
    public $computerID;
    public $computerNo;
	public $status;

    public $timer;
    public $amount;
    public $duration;
    

    function __construct($db){
        $this->conn = $db;
    }

    function readAllComputer(){
        $query = "SELECT * FROM computer";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
        return $stmt;
    }

    function readOne(){
        $query = "SELECT * FROM computer WHERE computerID=? LIMIT 0,1";


        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->computerID);
        $stmt->execute();
        return $stmt;

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //extract($row);

        $this->computerNo = $row['computerNo'];
        $this->status = $row['status'];
    }

    function guestTimeIn(){

        $employee=$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName'];
        $status='Guest';
        global $timestamp;
        $status ="Guest";
        $query = "UPDATE computer SET timeLeft=AddTime(timeLeft,?),status=? WHERE computerID=?;
        INSERT INTO computersale SET computerID=?,amount=?,dateStamp=?,employeeOnDuty=?";

        
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->timer);
            $stmt->bindParam(2,$status);
            $stmt->bindParam(3,$this->computerID);
            $stmt->bindParam(4,$this->computerID);
            $stmt->bindParam(5,$this->amount);
            $stmt->bindParam(6,$timestamp);
            $stmt->bindParam(7,$employee);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
    }


}
?>
