<?php
include_once 'classes/userClass.php';
include_once 'config/database.php';
include_once 'config/functions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>GETS Internet Cafe -
		<?php echo $tabTitle;?>
	</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">


	<script src="assets/jquery/3.3.1/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet " href="assets/bootstrap/4.0.0/css/style.css ">
	<link rel="stylesheet " href="assets/bootstrap/4.0.0/css/bootstrap.min.css ">
	<script src="assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="assets/popper.js/1.12.9/popper.min.js"></script>
	<link rel="stylesheet" href="assets/fonts/fontawesome-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css">
	<link rel="icon" href="admin/icon.png" type="image/x-icon" />

	<!--- datatables-->
	<link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css" />
	<script type="text/javascript" src="assets/datatables/pdfmake.min.js"></script>
	<script type="text/javascript" src="assets/datatables/vfs_fonts.js"></script>
	<script type="text/javascript" src="assets/datatables/datatables.min.js"></script>


</head>

<body onload="startTime()">


	<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand mb-0 h1" href="#">GETS ICafe Manager</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
			 aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<?php if($_SESSION['user']['accessLevel'] == "Attendant"){
            echo "
            <li class='nav-item'>
              <a class='nav-link' href='main.php'>Main Module <!--<span class='sr-only'>(current)</span>--></a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='members.php'>GETS Members <!--<span class='sr-only'>(current)</span>--></a>
            </li>";
              }
              else if($_SESSION['user']['accessLevel'] == 'Admin'){
                echo "
                <li class='nav-item'>
                  <a class='nav-link' href='main.php'>Main Module <!--<span class='sr-only'>(current)</span>--></a>
                </li>
                <li class='nav-item dropdown'>
                  <a class='nav-link dropdown-toggle' href='#'' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>GETS Employees
                  </a>
                  <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                    <a class='dropdown-item' href='employees.php'>Manage</a>
                    <a class='dropdown-item' href='admin/createUser.php'>Create User</a>                      
                  </div>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='members.php'>GETS Members <!--<span class='sr-only'>(current)</span>--></a>
                </li>
                <li class='nav-item'>
                  <a class='nav-link' href='services.php'>Goods/Services</a>
                </li>
                <li>
                  <a class='nav-link' href='admin/expenses.php''>Expenses</a>
                </li>";
              }?>


					<!--<li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>-->
				</ul>

				<ul class="navbar-nav my-2 my-lg-0">
					<a class="navbar-brand" href="#">
						<img src="images/<?php echo $_SESSION['user']['image'];?>" width="40" alt=""
						 style="margin-right:-20px;">
					</a>
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
							<a class="dropdown-item" href="editAccount.php.">Edit Profile</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="main.php?logout='1'">
								<i class="fas fa-sign-out-alt"></i> Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">&nbsp</div>
		<div class="row">
			<div class="col-lg-12">
				<h3>
					<?php echo $page_title ?>
				</h3>
			</div>
		</div>