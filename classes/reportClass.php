<?php
class Reports{

	private $table_name="";
	private $conn;	

	public $sumTotal;
	public $dateSelected;

	function __construct($db){
	$this->conn = $db;
	}


	function salesReport(){
		global $monthA,$dayA,$yearA,$monthB,$dayB,$yearB,$dateFrom,$dateTo,$monthx;

		$monthA=$_POST['monthFrom'];
		$dayA=$_POST['dayFrom'];
		$yearA=$_POST['yearFrom'];
		$monthB=$_POST['monthTo'];
		$dayB=$_POST['dayTo'];
		$yearB=$_POST['yearTo'];

		$dateFrom=$yearA."-".$monthA."-".$dayA;
		$dateTo=$yearB."-".$monthB."-".$dayB;

		if(empty($dateTo)){
			$query = "SELECT employeeOnDuty, totalPrice, sum(totalPrice) AS total,DATE(dateStamp) as dateStampx FROM servicesale WHERE dateStamp=? GROUP BY dateStamp";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$dateFrom);
			$stmt->execute();
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->sumTotal = $row['total'];
			return $stmt;
		}
		else{
			$query = "SELECT employeeOnDuty, totalPrice, sum(totalPrice) AS total, DATE(dateStamp) AS dateStampx FROM servicesale  WHERE dateStamp BETWEEN ? AND ? GROUP BY dateStamp";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$dateFrom);
			$stmt->bindParam(2,$dateTo);
			$stmt->execute();

			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->sumTotal = $row['total'];
			return $stmt;
		}
	}

	function expenses(){
		
		global $monthA,$dayA,$yearA,$monthB,$dayB,$yearB,$dateFrom,$dateTo,$searchValue,$monthx;

		$monthA=$_POST['monthFrom'];
		$dayA=$_POST['dayFrom'];
		$yearA=$_POST['yearFrom'];
		$monthB=$_POST['monthTo'];
		$dayB=$_POST['dayTo'];
		$yearB=$_POST['yearTo'];

		$dateFrom=$yearA."-".$monthA."-".$dayA;
		$dateTo=$yearB."-".$monthB."-".$dayB;

		if(empty($dateTo)){
			$query = "SELECT description, employeeOnDuty, SUM(amount) AS total, DATE(dateStamp), AS dateStampx FROM expenses WHERE dateStamp=? GROUP BY dateStamp";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$dateFrom);
			$stmt->execute();

			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->sumTotal = $row['total'];
				
			return $stmt;

		}
		else{
			$query = "SELECT description, employeeOnDuty, SUM(amount) AS total, DATE(dateStamp) AS dateStampx FROM expenses WHERE dateStamp BETWEEN ? AND ?";
			$stmt=$this->conn->prepare($query);
			$stmt->bindParam(1,$dateFrom);
			$stmt->bindParam(2,$dateTo);
			$stmt->execute();

			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			$this->sumTotal = $row['total'];

			return $stmt;
		}
	}
}
