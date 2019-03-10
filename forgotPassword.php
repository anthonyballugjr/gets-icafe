<?php
$tabTitle="Password Reset";
$page_title = "Forgot Password";
include_once "config/database.php";
include_once "classes/userClass.php";
include_once "config/functions.php";

$database = new Database();
$db = $database->getConnection();


if(isset($_POST['btnForgotPassword'])){
	$forgotPassword = new User($db);
	$forgot = $forgotPassword->forgotPassword();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gets Internet Cafe</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<script src="assets/jquery/3.2.1/jquery-3.2.1.slim.min.js" "></script>
	<link rel="stylesheet " href="assets/bootstrap/4.0.0/css/bootstrap.min.css ">
	<script src="assets/bootstrap/4.0.0/js/bootstrap.min.js " "></script>
	<script src="assets/popper.js/1.12.9/popper.min.js"></script>

</head>

<body>
	<div class="form-row justify-content-center">

		<form class="jumbotron bg-dark text-white" method="post" autocomplete="false" action='forgotPassword.php' style="border-width:1px;border-style:solid;border-radius:5px;margin:0 auto; width:25%;">
			<h3>
				<?php echo $page_title; ?>
			</h3>
			<br>
			<small>
				<?php echo display_error(); ?>
			</small>
			<h6>Please enter either Username or Email Address</h6>
			<br>
			<div class='form-row'>
				<!--row 1-->
				<div class="form-group col-sm-12">
					<input type="text" class="form-control form-control-sm" name="forgotUser" placeholder="Username">
				</div>
				<div class="form-group col-sm-12">
					<h6 style="text-align:center;">OR</h6>
				</div>
				<div class="form-group col-sm-12">
					<input type="text" class="form-control form-control-sm" name="forgotEmail" placeholder="Email">
				</div>
			</div>
			<!--end row 1-->

			<div class="input-group-my-2 my-lg-0" align="right">
				<button type="submit" onclick="return confirm(" Are you sure yo uwant to reset your password? ") name="btnForgotPassword
				 " class="btn btn-success ">Submit</button>
				<a class="btn btn-danger " href="index.php " role="button ">Cancel</a>
			</div>
		</form>
	</div>
</body>
</html>