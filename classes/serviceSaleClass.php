<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");
    

$modalErrors = array();
class ServiceSale{
	// database connection and table name
    private $conn;
    private $table_name = "serviceSale";
 
    // object properties
    public $serviceID;
    public $serviceName;
    public $price;
    public $serviceCategory;

    //add service
    public $quantity;
    public $totalPrice;
    public $isArchived;
    public $dateStamp;
    //

    function __construct($db){
        $this->conn = $db;
    }

    function addToSale(){
        $sql = "SELECT * FROM servicesale WHERE serviceID=? AND dateStamp=?";
        $check = $this->conn->prepare($sql);
        $check->bindParam(1,$this->serviceID);
        $check->bindParam(2,$this->dateStamp);
        $check->execute();

        $count = $check->fetch(PDO::FETCH_ASSOC);
    
        if($count==true){
            $query = "UPDATE servicesale SET quantity=quantity+?,totalPrice=totalPrice+? WHERE serviceID=?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->quantity);
            $stmt->bindParam(2,$this->totalPrice);
            $stmt->bindParam(3,$this->serviceID);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }

        }
        else{
            $employee=$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName'];
            $query = "INSERT INTO servicesale SET serviceID=?, quantity=?, totalPrice=?, dateStamp=?,employeeOnDuty=?";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->serviceID);
            $stmt->bindParam(2,$this->quantity);
            $stmt->bindParam(3,$this->totalPrice);
            $stmt->bindParam(4,$this->dateStamp);
            $stmt->bindParam(5,$employee);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }
    }

    function readCurrentSales(){
        global $timestamp;
        $query = "SELECT serviceName, quantity, totalPrice FROM services INNER JOIN servicesale ON services.serviceID = servicesale.serviceID WHERE dateStamp=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$timestamp);
        $stmt->execute();

        return $stmt;
    }

}//End of class
?>