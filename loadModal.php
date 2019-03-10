<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");

include_once "config/database.php";
include_once "classes/userClass.php";
include_once "config/functions.php";

$database = new Database();
$db = $database->getConnection();

$member = new User($db);

if(isset($_POST['btnLoad'])){
  $member->accountID=$_POST['accountID'];
  $member->balance=$_POST['balance'];
  if($member->loadMember()){
    //$oldBalance=$member->oldBalance;//balanceNow
    $query = "SELECT * FROM transaction WHERE accountID=? ORDER BY transactionID DESC LIMIT 1";
    $stmt= $db->prepare($query);
    $stmt->bindParam(1,$member->accountID);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $latestTransactionID=$row['transactionID'];
    $currentBalance = $row['balanceNew'];

    $employee=$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName'];
    $query = "INSERT INTO transaction SET accountID=?,employeeOnDuty=?,balanceNow=?";
    $stmt = $db->prepare($query);
    $stmt->bindParam(1,$member->accountID);
    $stmt->bindParam(2,$employee);
    $stmt->bindParam(3,$currentBalance);
    //$stmt->bindParam(4,$member->amount);
    if($stmt->execute()){
    	$_SESSION['success']="Member loaded successfuly!";
     header("location: members.php");
    }
    else{
    echo "ERROR!";
    } 
  }
}

if(isset($_POST['accountID'])){
	//echo $_POST['accountID'];
	$load = new User($db);
	$load->accountID = $_POST['accountID'];
	$load->readLoadMember();
	?>

	<form method="post" action="loadModal.php">
            <div class="form-row">
                <input name="accountID" type="hidden" class="form-control" id="loadID" value="<?php echo $load->accountID;?>" readonly>
              <div class="form-group col col-sm-3">
                <label>Member</label>
                <input type="text" class="form-control" id="memberName" value="<?php echo $load->fullName;?>" readonly>
              </div>
              <div class="form-group col col-sm-3">
                <label>Remaining Balance</label>
                <input type="text" class="form-control" id="balance" readonly value="<?php echo $load->balanceNow;?>">
              </div> 
                              
              <div class="form-group col col-sm-3">
                <label>Select Prepaid Load</label>
                <select name="balance" required class="form-control">
                  <option></option>
                  <?php 
                  $time1 = DateTime::createFromFormat('h:i:s', '12:00:00');
                  $load1 = date_format($time1,'h:i:s');
                  $time2 = DateTime::createFromFormat('h:i:s', '06:00:00');
                  $load2 = date_format($time2,'h:i:s');
                  $time3 = DateTime::createFromFormat('h:i:s', '03:00:00');
                  $load3 = date_format($time3,'h:i:s');
                  ?>

                  <option value="<?php echo $load1;?>">200</option>
                  <option value="<?php echo $load2;?>">100</option>
                  <option value="<?php echo $load3;?>">50</option>
                </select>
              </div>
            </div>
            <div class="form-row float-right">
            	<div class="form-group">
            		<button type="submit" name="btnLoad" class="btn btn-primary">Load</button>
            	</div>
            </div>
        </form>

<?php }?>

