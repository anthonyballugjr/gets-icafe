<?php
include_once 'classes/userClass.php';
include_once 'config/database.php';
include_once 'config/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gets Internet Cafe</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<script src="assets/jquery/3.3.1/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet " href="assets/bootstrap/4.0.0/css/style.css">
	<link rel="stylesheet " href="assets/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="assets/popper.js/1.12.9/popper.min.js"></script>
	<script src="assets/jquery/jquery.timepicker.min.js"></script>
	<link rel="stylesheet" href="assets/fonts/fontawesome-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css">
	<link rel="icon" href="admin/icon.png" type="image/x-icon" />

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"
	/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>

</head>

<body onload="startTime()">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand mb-0 h1" href="memberHome.php">
				<?php echo $page_title;?>
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			 aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="#">My Reservations</a>
					</li>
					<li class="nav-item">
						<a class="nav-link view_transaction" id="<?php echo $_SESSION['user']['accountID'];?>"
						 href="#">My Transactions</a>
					</li>
				</ul>

				<a class="navbar-brand" href="#">
					<img src="images/<?php echo $_SESSION['user']['image'];?>" width="40" alt=""
					 style="margin-right:-20px;">
				</a>

				<ul class="navbar-nav my-2 my-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
						 aria-expanded="false">
							<?php echo $_SESSION['user']['firstName']." ". $_SESSION['user']['lastName'];?>
							<small>
								<i>(
									<?php echo ucfirst($_SESSION['user']['accessLevel']);?>)</i>
							</small>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="viewProfile.php">View Profile</a>
							<a class="dropdown-item" href="editAccount.php">Edit Profile</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="memberHome.php?logout='1'">
								<i class="fas fa-sign-out-alt"></i> Logout</a>

						</div>
					</li>
				</ul>
			</div>
	</nav>


	<div class="container">
		<div class="row">&nbsp</div>

		<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="exampleModalLabel" id="computerNo">Transactions (
							<?php echo date('F, d, Y');?>)</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="transaction-body">



					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			$(document).on('click', '.view_transaction', function() {
				//$('#computerModal').modal('show');
				var memberID = $(this).attr("id");

				//$('#computer-body').html(computerID);
				//$('#computerModal').modal('show')
				$.ajax({
					url: "transactionModal.php",
					method: "POST",
					data: {
						memberID: memberID
					},
					success: function(data) {
						$('#transaction-body').html(data);
						$('#transactionModal').modal('show');

					}
				});
			});
		</script>