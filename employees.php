<?php
$tabTitle="Employees";
$page_title = "";
include_once 'config/database.php';
include_once 'classes/userClass.php';
include_once 'config/functions.php';
include_once "header.php";

if (!isAdmin()) {
  $_SESSION['msg'] = "The page you are trying to access requires administrator login!";
  header('location: ../index.php');
}

$database = new Database();
$db = $database->getConnection();

$records_per_page = 5;
$page =isset($_GET['page']) ? $_GET['page'] : 1;
$from_record_num = ($records_per_page*$page)-$records_per_page;
$total_rows = 0;

$user = new User($db);
$stmt = $user->readUser($from_record_num,$records_per_page);

if(isset($_GET['deactivateAccountID'])){
  $user->accountID = $_GET['deactivateAccountID'];
  if($user->deactivateEmployee()){
    header("location: employees.php");
  }
}

if(isset($_GET['activateAccountID'])){
  $user->accountID = $_GET['activateAccountID'];
  if($user->activateUser()){
    header("location: employees.php");
  }
}

if(isset($_GET['loadAccountID'])){
  $user->accountID = $_GET['loadAccountID'];
}


?>


<nav class="navbar navbar-dark bg-dark justify-content-between">
	<h4 class="navbar-brand">GETS Employees</h4>
	<form class="form-inline">
		<input class="form-control mr-sm-2" type="search" placeholder="Search employee" aria-label="Search" name="searchMember" id="searchEmployee"
		 style="background-image: url('res/search.png');background-repeat: no-repeat;padding: 5px 10px 5px 40px; background-position: 1px 1px;"
		 onkeyup="search()">
	</form>
</nav>
<br>


<table class="table table-hover table-striped table-bordered table-sm" name="employeeTable" id="employeeTable">
	<thead>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Access Level</th>
			<th colspan=2>
				<center>Actions</center>
			</th>
		</tr>
	</thead>

	<tbody>

		<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row); 
?>

		<tr>
			<td>
				<?php echo $row['firstName'];?>
			</td>
			<td>
				<?php echo $row['lastName'];?>
			</td>
			<td>
				<?php echo $row['accessLevel'];?>
			</td>


			<td colspan=2>

				<?php if($row['accountStatus'] == "active"){ ?>
				<center>
					<a class='btn btn-danger btn-sm' href='?deactivateAccountID=<?php echo $row[' accountID
					 '];?>'onclick='return confirm("Are you sure you want to deactivate the selected user?")'>
						<i class="fas fa-user-times"></i> Deactivate</a>

					<a class="btn btn-success btn-sm text-white view-info" id="<?php echo $row['accountID'];?>">
						<i class="fas fa-eye"></i> View</a>
				</center>
				<?php
      }
      else{ ?>
				<center>
					<a role='button' class='btn btn-info btn-sm col-sm-4' onclick="return confirm('Activate Selected Employee?')" href='?activateAccountID=<?php echo $row['
					 accountID '];?>'> Activate</a>
				</center>
				<?php  }  ?>
			</td>
		</tr>
		<?php }?>

	</tbody>
</table>

<?php $page_url="employees.php?0&";
    include_once 'paging.php'; ?>


<!--VIEW-->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">Employee Information</h5>
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

<script>
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

	$(document).ready(function() {
		$('#searchEmployee').on('keyup', function() {
			var searchTerm = $(this).val().toLowerCase();
			$('#employeeTable tbody tr').each(function() {
				var lineStr = $(this).text().toLowerCase();
				if (lineStr.indexOf(searchTerm) === -1) {
					$(this).hide();
				} else {
					$(this).show();
				}
			});
		});
	});
</script>