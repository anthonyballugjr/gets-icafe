<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");
$modalErrors = array();
class ComputerSale{
	// database connection and table name
    private $conn;
    private $table_name = "computersale";
 
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

    function readSales(){
        global $timestamp;
        $query = "SELECT amount FROM computerSale WHERE dateStamp=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$timestamp);
        $stmt->execute();

        return $stmt;
    }

}//End of class
?>