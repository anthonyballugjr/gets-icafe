<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");
$dateTime = date("Y-m-d h:i:sA");
$modalErrors = array();
class Reservation{
	// database connection and table name
    private $conn;
    private $table_name = "reservation";
 
    // object properties
    public $computerID;
    public $computerNo;
    public $accountID;
    public $dateStamp;
	public $status;

    public $timeTo;
    public $timeFrom;
    public $value;
    

    function __construct($db){
        $this->conn = $db;
    }

    function reserve(){
        global $timestamp;
        $from = $this->timeFrom."00:00";
       $user = $_SESSION['user']['accountID'];


        $query = "INSERT INTO reservation SET computerID=?,accountID=?,timeFrom=?,timeTo=?,dateStamp=?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->computerID);
        $stmt->bindParam(2,$user);
        $stmt->bindParam(3,$this->timeFrom);
        $stmt->bindParam(4,$this->timeTo);
        $stmt->bindParam(5,$timestamp);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function readReservation(){
        global $timestamp;
        $query = "SELECT computerNo, firstName, lastName,timeFrom,timeTo FROM computer INNER JOIN reservation on reservation.computerID = computer.computerID INNER JOIN accounts ON reservation.accountID = accounts.accountID WHERE computer.computerID=? AND reservation.dateStamp=?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->computerID);
        $stmt->bindParam(2,$timestamp);
        $stmt->execute();
        return $stmt;
    }

    function readOne(){
        global $timestamp;
        $query = "SELECT * FROM reservation WHERE computerID=? AND dateStamp=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->computerID);
        $stmt->bindParam(2,$timestamp);
        $stmt->execute();
        return $stmt;
    }

    function create_time_range($start, $end, $interval = '1 hour', $format = '12') {

    $startTime = strtotime($start); 
    $endTime   = strtotime($end);
    $returnTimeFormat = ($format == '12')?'h A':'H';

    $current = time(); 
    $addTime = strtotime('+'.$interval, $current); 
    $diff = $addTime - $current;

    $times = array(); 
    while ($startTime < $endTime) { 
        $times[] = date($returnTimeFormat, $startTime); 
        $startTime += $diff;
        $startTime+1; 
    } 
    $times[] = date($returnTimeFormat, $startTime); 
    return $times; 
} 

}
?>