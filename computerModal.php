<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");

include_once "config/database.php";
include_once "classes/reservationClass.php";
include_once "classes/computerClass.php";

$database = new Database();
$db = $database->getConnection();

$guest = new Computer($db);

$time1=strtotime('1:00:00');
$time2=strtotime('3:00:00');

if(isset($_POST['btnEndSession'])){
	
	$id=$_POST['comID'];
	$timeLeft='00:00:00';
	$status = "Vacant";
	
	echo $guest->timer;

	$query = "UPDATE computer SET timeLeft=?,status=? WHERE computerID=?";
	$stmt = $db->prepare($query);
	$stmt->bindParam(1,$timeLeft);
	$stmt->bindParam(2,$status);
	$stmt->bindParam(3,$id);
	if($stmt->execute()){
		header("location: main.php");
	}
	else{
		echo "ERROR!";
	}
}
if(isset($_POST['btnNinety'])){
	$amount=30;
	$time = DateTime::createFromFormat('h:i:s', '01:30:00');
	$guest->timer = date_format($time,'h:i:s');
	$guest->amount=$amount;
	$guest->computerID=$_POST['comID'];

	if($guest->guestTimeIn()){
		header("location: main.php");
	}
	else{
		echo "Problem Adding Guest time!";
		header("refresh:2; url=main.php");
	}
}
else if(isset($_POST['btnSixty'])){
	$amount=20;
	$time = DateTime::createFromFormat('h:i:s', '01:00:00');
	$guest->timer = date_format($time,'h:i:s');
	$guest->amount=$amount;
	$guest->computerID=$_POST['comID'];

	if($guest->guestTimeIn()){
		header("location: main.php");
	}
	else{
		echo "Problem Adding Guest time!";
	}
}
else if(isset($_POST['btnThirty'])){
	$guest->amount=10;
	$time = DateTime::createFromFormat('H:i:s', '00:30:00');
	$guest->timer = date_format($time,'H:i:s');
	$guest->computerID = $_POST['comID'];
        
    if($guest->guestTimeIn()){
    	header("location: main.php");
    }
	else{
		echo "Problem Adding Guest time!";
	}
}

if(isset($_POST['computerID'])){
	$reservation = new Reservation($db);
	$reservation->computerID = $_POST['computerID'];
	$computer = new Computer($db);
	$computer->computerID = $_POST['computerID'];
	
	$id = $_POST['computerID'];

	$com = $computer->readOne();
	$stmt = $reservation->readReservation();
	//$title="Guest";

	echo "<div class='bg-dark co text-white' style='padding:1px;border-radius:5px;'><center><h6>".$_POST['computerNo']."</h6></center></div>";
	echo "<br>";
	echo "
	<table class='table table-striped table-sm'>
			<thead>
				<tr>
					<th>Reserved by</th>
					<th>From</th>
					<th>To</th>
				</tr>
			</thead>
			<tbody>";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row); ?>

<tr>
	<td>
		<?php echo "{$firstName} {$lastName}";?>
	</td>
	<td>
		<?php echo date('h',strtotime($row['timeFrom']));?>
	</td>
	<td>
		<?php echo date('h',strtotime($row['timeTo']));?>
	</td>
</tr>
<?php }
			echo "</tbody>
		</table>";
		
?>
<hr>
<br>
<br>


<div class="jumbotron bg-dark" style="margin:0 auto;padding:0px;">
	<div class="container bg-info text-white" style="padding:1px;">
		<center>
			<h5></h5>
		</center>
	</div>
	<div class="form-row">&nbsp</div>
	<div class="container">
		<form action="computerModal.php" method="post">
			<input name="comID" type="hidden" value="<?php echo $id;?>">
			<?php $rows=$com->fetch(PDO::FETCH_ASSOC);
			$msg="End session of selected PC?";
				if($rows['status']=="Vacant" OR $rows['status']=="Guest"){ 
					if($rows['status']=="Guest"){ ?>
			<div class='alert alert-warning border-light' id='guestTime'>
				<strong>Time left:
					<?php echo $rows['timeLeft'];?>
				</strong>
				<button class='btn btn-outline-danger btn-sm float-right' name='btnEndSession' onclick='return confirm("End PC Session?")'>
					<i class="fas fa-square"></i> End Session</button>
			</div>
			<?php }
					else{
						echo "<div class='alert alert-primary border-light'><strong>Vacant</strong></div>";
					} ?>

			<div class="form-row">
				<div class="form-group col">
					<button type="submit" name="btnNinety" class="btn btn-outline-info btn-block" onclick="return confirm('Add time?')">+90 Min</button>
				</div>
				<div class="form-group col">
					<button type="submit" name="btnSixty" class="btn btn-outline-info btn-block" onclick="return confirm('Add time?')">+60 Min</button>
				</div>
				<div class="form-group col">
					<button name="btnThirty" class="btn btn-outline-info btn-block" type="submit" onclick="return confirm('Add time?')">+30 Min</button>
				</div>
			</div>
			<?php }
			else if($rows['status']=='Member'){
					echo "<div class='alert alert-success'><strong>Member Use</strong></div><br>";
				}
			else{
					echo "<div class='alert alert-danger'><strong>Under Repair</strong></div><br>";
			} ?>
		</form>
	</div>
</div>

<?php }