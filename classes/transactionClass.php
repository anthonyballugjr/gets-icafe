<?php
date_default_timezone_set('Asia/Manila');
$today = date("Y-m-d");
$modalErrors = array();

class Transaction{
	// database connection and table name
    private $conn;
    private $table_name = "transaction";
 
    // object properties
    public $memberID;
    //

    function __construct($db){
        $this->conn = $db;
    }

    function readTransaction(){
        global $today;
        $query = "SELECT * FROM accounts INNER JOIN transaction ON accounts.accountID=transaction.accountID WHERE accounts.accountID=? AND dateStamp=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->memberID);
        $stmt->bindParam(2,$today);
        $stmt->execute();

        return $stmt;
    }

}//End of class
?>