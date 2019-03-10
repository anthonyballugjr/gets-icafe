<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");
    

$modalErrors = array();
class Services{
	// database connection and table name
    private $conn;
    private $table_name = "services";
    private $table_name2 = "serviceSale";
 
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
    public $description;
    public $amount;



    function __construct($db){
        $this->conn = $db;
    }

    function readAll(){
        $query = "SELECT * FROM services WHERE servicePrice!=0 ORDER BY serviceCategory ASC";
 
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
 
    return $stmt;
    }

    function readActive(){
        $query = "SELECT * FROM services WHERE isArchived=0 ORDER BY serviceCategory";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function activateService(){
        $query = "UPDATE services SET isArchived=? WHERE serviceID=".$this->serviceID;


        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->isArchived);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function deactivateService(){
        $query = "UPDATE services SET isArchived=? WHERE serviceID=".$this->serviceID;

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->isArchived);

        if($stmt->execute()){
            $_SESSION['success']="Service Deactivated!";
            
            return true;
        }
        else{
            return false;
        }
    }

    function addService(){
        $query ="INSERT INTO services SET serviceName=?, serviceCategory=?, servicePrice=?, isArchived=?";

        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->serviceName);
        $stmt->bindParam(2,$this->serviceCategory);
        $stmt->bindParam(3,$this->servicePrice);
        $stmt->bindParam(4,$this->isArchived);
        
            if($stmt->execute()){
            return true;
            }
            else{
                return false;
            }
        
    }

    function updateService(){
        $query = "UPDATE services SET serviceName=?, servicePrice=?, serviceCategory=? WHERE serviceID=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->serviceName);
        $stmt->bindParam(2,$this->servicePrice);
        $stmt->bindParam(3,$this->serviceCategory);
        $stmt->bindParam(4,$this->serviceID);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}//End of class
?>