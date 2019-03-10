<?php

$page_title = "GETS Internet Cafe";
include_once 'headerMember.php';
include_once 'config/functions.php';
include_once 'config/database.php';
include_once 'classes/reservationClass.php';
include_once 'classes/computerClass.php';

if(!isLoggedIn()){
	$_SESSION['msg'] = "You must login first!";
	header("location: index.php");
}

$database = new Database();
$db = $database->getConnection();

$computers = new Computer($db);
$computer = $computers->readAllComputer();

$reservation = new Reservation($db);
$reserve = $reservation->readReservation();

date_default_timezone_set("Asia/Manila");
$dateStamp = date('Y-m-d');


?>	
<?php if(isset($_SESSION['success'])) : ?>
<div class="alert alert-info">
	<h5><?php echo $_SESSION['success'];
		unset($_SESSION['success']);
		?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
	</h5>
</div>
<?php endif ?>
<?php if(isset($_SESSION['loginMsg'])) : ?>
<div class="alert alert-info">
	<h5><?php echo $_SESSION['loginMsg'];
		unset($_SESSION['loginMsg']);
		?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
	</h5>
</div>
<?php endif ?>

<h6 class="alert alert-danger text-dark" style="border-radius: 50px;"><marquee><strong>NOTE: 30 MINUTES WILL BE CHARGED FROM YOUR BALANCE ONCE YOU RESERVE A COMPUTER</strong></marquee></h6>

<div id="clockdate" class="card float-right">
  <strong>
    <div id="clock" class=" bg-dark text-white" style="padding:5px;border-radius: 10px;"></div>
 </strong>
</div>

<script>
  function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + " : " + min + " : " + sec + " " + ap;
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>

<h5><strong>Computer Terminals</strong></h5>
<hr>
<?php
while($row = $computer->fetch(PDO::FETCH_ASSOC)){
extract($row);   
?>


<div class='container col-sm-1 float-left' style='display:inline-block; border-width:1px; border-style:solid;'>
	<small><strong><?php echo $row['computerNo']; ?></strong></small>
	<small class='mx-auto d-block'><mark><strong><?php echo $row['status']; ?></strong></mark></small><hr>
	<p><?php if($row['status'] == 'Vacant'){ ?>
		
    <a no="<?php echo $row['computerNo'];?>" class="btn btn-info btn-sm reserve_pc text-white" role="button" id="<?php echo $row['computerID'];?>" >Reserve</a>
	<?php }
	else{ ?>
		<a class='btn btn-dark btn-sm disabled' href="#"><?php echo $row['status'];?></a>
	<?php } ?>
	</p>
</div>
<?php }?>

<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel"><?php echo date("F d, Y - l");?></h6>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      <div class="modal-body" id="reservation-body">
        
        
        
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.reserve_pc', function(){
    //$('#reservationModal').modal('show');
        var computerID = $(this).attr("id");
        var computerNo = $(this).attr("no");
        
        //$('#computer-body').html(computerID);
        //$('#computerModal').modal('show')
        $.ajax({
          url:"reservationModal.php",
          method:"POST",
          data:{computerID:computerID, computerNo:computerNo},
          success:function(data){
            $('#reservation-body').html(data);
            $('#reservationModal').modal('show');
        }
        });
   });
 </script>


</div>
<br><br><hr>
