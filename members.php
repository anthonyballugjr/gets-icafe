<?php
$tabTitle="Members";
date_default_timezone_set('Asia/Manila');
$today=date("Y-m-d");


$page_title = "";
include_once 'header.php';
include_once 'config/database.php';
include_once 'config/functions.php';
include_once 'classes/userClass.php';

$database = new Database();
$db = $database->getConnection();

$member = new User($db);
$stmt = $member->readMember();

if (!isEmployee()) {
  $_SESSION['msg'] = "The page you are trying to access requires employee login!";
  header('location: index.php');
}

if(isset($_GET['deactivateAccountID'])){
  $member->accountID = $_GET['deactivateAccountID'];
  if($member->deactivateMember()){
    header("location: members.php");
  }
}
if(isset($_GET['activateAccountID'])){
  $member->accountID = $_GET['activateAccountID'];
  if($member->activateUser()){
    header("location: members.php");
  }
}

?>

<?php if (isset($_SESSION['success'])) : ?>
<div class="alert alert-success">
	<h5>
		<?php 
        echo $_SESSION['success']; 
        unset($_SESSION['success']);
      ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</h5>
</div>
<?php endif ?>

<!-- <nav class="navbar navbar-success bg-info text-white justify-content-between">
	<h5 class="navbar-brand">GETS Members</h5>
	<form class="form-inline">
		<input class="form-control mr-sm-2 bg-light" type="search" placeholder="Search member..." aria-label="Search" name="searchMember"
		 id="searchMember" style="background-image: url('res/search.png');background-repeat: no-repeat;padding: 5px 10px 5px 40px; background-position: 1px 1px;">
	</form>
</nav> -->
<br>




<table id="samplex" class="table table-hover table-bordered">
	<thead>
		<tr>
			<th scope="col">First Name</th>
			<th scope="col">Account Status</th>
			<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>

		<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row); 

echo "
		<tr>
			<td>
				${firstName}
			</td>
			<td>
				${accountStatus}
			</td>
			<td colspan=2>";
				if($row['accountStatus'] == "active"){
				echo "<center>
					<a class='btn btn-danger btn-sm' href='?deactivateAccountID='${accountID}' onclick='return confirm(`Are you sure you want to deactivate the selected user?`)'>
						<i class='fas fa-user-times'></i> Deactivate</a>

					<a role='button' class='text-white btn btn-primary btn-sm load_member' id='${accountID}'>
					<i class='fas fa-clock'></i> Load</a>

			<a class='btn btn-success btn-sm text-white view-info' id='${accountID}'>
			<i class='fas fa-eye'></i> View</a>
		</center>";
		}
      else{ echo "
		<center>
			<a role='button' onclick='return confirm(`Activate Selected Member?`)' class='btn btn-info btn-sm ' href='?activateAccountID=${accountID}'>Activate</a>
		</center>";
		}
		echo "
		</td>

		</tr>";
		}?>
	</tbody>
</table>

<script>
	// $(document).ready(function() {
	// 	$('#searchMember').on('keyup', function() {
	// 		var searchTerm = $(this).val().toLowerCase();
	// 		$('#memberTable tbody tr').each(function() {
	// 			var lineStr = $(this).text().toLowerCase();
	// 			if (lineStr.indexOf(searchTerm) === -1) {
	// 				$(this).hide();
	// 			} else {
	// 				$(this).show();
	// 			}
	// 		});
	// 	});
	// });

	$(document).ready(function() {
		$('#samplex').DataTable({
			select: true,
			dom: 'lBfrtip',
			buttons: [{
				extend: 'collection',
				text: 'Export',
				buttons: [
					'copy',
					'excel',
					'csv',
					'pdf',
					'print'
				]
			}]
		});
	});

	$(document).ready(function() {
		$('#sample').DataTable({
			dom: 'Bfrtip',
			buttons: [{
				extend: 'collection',
				text: 'Export',
				buttons: [
					'copy',
					'excel',
					'csv',
					'pdf',
					'print'
				]
			}]
		});
	});
</script>

<!--VIEW-->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">Member Information</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="view-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--END VIEW-->

<!--LOAD-->
<div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Load Member</h5>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
			<div class="modal-body" id="load-body">



			</div>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.load_member', function() {
		//$('#reservationModal').modal('show');
		var accountID = $(this).attr("id");

		//$('#computer-body').html(computerID);
		//$('#computerModal').modal('show')
		$.ajax({
			url: "loadModal.php",
			method: "POST",
			data: {
				accountID: accountID
			},
			success: function(data) {
				$('#load-body').html(data);
				$('#loadModal').modal('show');
			}
		});
	});


	$(document).on('click', '.view-info', function() {
		//$('#computerModal').modal('show');
		var accountID = $(this).attr("id");

		$.ajax({
			url: "viewInfo.php",
			method: "POST",
			data: {
				accountID: accountID
			},
			success: function(data) {
				$('#view-body').html(data);
				$('#viewModal').modal('show');

			}
		});
	});
</script>


<!--SELECT concat(users.firstName,' ',users.lastName) AS Customer,concat(employee.firstName,' ',employee.lastName) AS Personnel_in_Charge,Brand,Model FROM car_rental LEFT JOIN users ON car_rental.customerID=users.accountID LEFT JOIN users employee ON car_rental.adminID=employee.accountID LEFT JOIN car ON car.carID=car_rental.carID-->