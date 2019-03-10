<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");

include_once "config/database.php";
include_once "classes/reservationClass.php";
include_once "classes/computerClass.php";
include_once "config/functions.php";

$database = new Database();
$db = $database->getConnection();

$guest = new Computer($db);

$reservation = new Reservation($db);

$times = $reservation->create_time_range('h+1hour','23:00', '1 hour');
$times2 = $reservation->create_time_range('h+2hour','23:00', '1 hour');
//$time1=strtotime('00:00:10');
//$time2=strtotime('3:00:00');

if(isset($_POST['btnReserve'])){
	$reservation->computerID=$_POST['computerID'];
	$reservation->timeFrom = $_POST['timeFrom'];
	$reservation->timeTo = $_POST['timeTo'];
	if($reservation->reserve()){
		$_SESSION['success']='Computer reserved!';
		header("location: memberHome.php");
	}
	else{
		echo "ERROR!";
	}
}

echo $reservation->value;
if(isset($_POST['computerID'])){
	//$reservation = new Reservation($db);
	$reservation->computerID = $_POST['computerID'];
	$computer = new Computer($db);
	$computer->computerID = $_POST['computerID'];
	
	$computerID = $_POST['computerID'];

	$com = $computer->readOne();
	$stmt = $reservation->readOne();
	$title="Guest";

	echo "<div class='bg-info col text-white' style='padding:1px;border-radius:5px;'><center><h6>".$_POST['computerNo']."</h6</center></div>";
	echo "<h5>Reserved slots</h5>
	<table class='table table-striped table-bordered table-sm'>
			<thead>
				<tr>
					<th>From</th>
					<th>To</th>
				</tr>
			</thead>
			<tbody>";

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row); ?>
		
		<tr>
			<td><?php echo date('h:iA',strtotime($row['timeFrom']));?></td>
			<td><?php echo date('h:iA',strtotime($row['timeTo']));?></td>
		</tr> <?php } ?>
	</tbody>
</table>
<?php } ?>

<hr>
<div class="">
	<div class="form-check">

		<?php if(isset($_SESSION['modalMsg'])) : ?>
          <div class="alert alert-info">
            <h5><?php echo $_SESSION['modalMsg'];
                      unset($_SESSION['modalMsg']);
              ?>
            </h5>
          </div>
        <?php endif ?>
        <?php echo modalErrors();?>

  		<h5>
  		<input class="form-check-input" type="checkbox" value="" id="reserveTick">
  		<label class="form-check-label" for="defaultCheck1">
    		Reserve this computer
  		</label>
  	</h5>
	</div>
<form id="reserveForm" method="POST" action="reservationModal.php">

	<div class="jumbotron bg-dark" id="selectTimeRange" style="display: none;margin:0 auto;padding:5px;">
		<h5 class="text-white">Please select time</h5>
		<div class="form-row">
			<input type="hidden" name="computerID" value="<?php echo $computerID;?>">
			<div class="input-group mb-3 col col-sm-5">
  				<div class="input-group-prepend">
  					<label class="input-group-text bg-info text-white" for="inputGroupSelect01">From</label>
  				</div>
  				<select name="timeFrom" class="form-control" id="timeFrom" required oninvalid="this.setCustomValidity('Please enter a start time')" oninput="setCustomValidity('')">
  					<option></option>
    				<?php foreach($times as $key=>$val){?>
    				<option value="<?php echo $val;?>"><?php echo $val;?></option>
    				<?php }?>
  				</select>
			</div>
			<div class="input-group mb-3 col col-sm-4">
  				<div class="input-group-prepend" id="timeTo">
    				<label class="input-group-text bg-info text-white" for="inputGroupSelect01">To</label>
  				</div>
  				<select name="timeTo" class="form-control form-control" required oninvalid="this.setCustomValidity('Please enter an end time')" oninput="setCustomValidity('')">
  					<option></option>
    				<?php foreach($times2 as $key=>$val2){?>
    				<option value="<?php echo $val2;?>"><?php echo $val2; ?></option>
    				<?php }?>
  				</select>
			</div>
			<div class="form-group col-sm-2"><button class="btn btn-info" type="submit" name="btnReserve">Reserve</button></div>
		</div>
	</div>
</form>
</div>

<script>

$('#reserveTick').change(function(){
	$('#selectTimeRange').toggle();
});

</script>