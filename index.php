<?php
$tabTitle="Home";
$page_title = "Welcome to GETS Internet Cafe";
include_once 'config/functions.php';
include_once 'config/database.php';
include_once 'classes/userClass.php';

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['btnLogin'])){
  $login = new User($db);
  $in = $login->login();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>GETS Internet Cafe</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<script src="assets/jquery/3.2.1/jquery-3.2.1.slim.min.js"></script>
	<link rel="stylesheet" href="assets/bootstrap/4.0.0/css/style.css">
	<link rel="stylesheet" href="assets/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="assets/popper.js/1.12.9/popper.min.js"></script>
	<link rel="stylesheet" href="assets/fonts/fontawesome-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css">
	<link rel="icon" href="admin/icon.png" type="image/x-icon" />

</head>

<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
			<span class="navbar-brand mb-0 h1">
				<h3>
					<?php echo $page_title; ?>
				</h3>
			</span>
		</nav>
		<div class="form-row">&nbsp</div>

		<?php if(isset($_SESSION['success'])){
      echo "<div class='alert alert-success'>
      <h5>".$_SESSION['success'];
      unset($_SESSION['success']); ?>
		<button class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</h5>
	</div>
	<?php }?>

	<?php if(isset($_SESSION['msg'])) : ?>
	<div class="alert alert-danger">
		<h4>
			<?php echo $_SESSION['msg'];
        unset($_SESSION['msg']);?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</h4>
	</div>
	<?php endif ?>

	<div class="container-fluid bg-dark text-white">
		<div class="form-row" style="padding:5px; margin-left:-20px;">
			<div id="carouselExampleIndicators" class="carousel slide col-sm-8 bg-dark text-dark" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>

				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="img-fluid" src="res/g1.jpg">
					</div>
					<div class="carousel-item">
						<img class="img-fluid" src="res/g2.jpg">
					</div>
					<div class="carousel-item">
						<img class="img-fluid" src="res/g3.jpg">
					</div>
				</div>
				<!--end carousel inner-->

				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
			<!--end carousel slide-->

			<!--LOGIN FORM-->
			<div class="col-sm-4" id="loginForm" style="padding-left:10px;">
				<br>
				<img src="res/logo.png" class="img-fluid mx-auto d-block" alt="Responsive image">
				<h4>User Login</h4>
				<hr>
				<form action="index.php" method="post">
					<small>
						<?php echo display_error(); ?>
					</small>

					<div class="form-row">
						<div class="form-group col">
							<label>Username</label>
							<input type="text" class="form-control is-valid form-control-sm" name="username" placeholder="Enter Username" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col">
							<label>Password</label>
							<input type="password" class="form-control is-valid form-control-sm" name="password" placeholder="Enter Password" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-8">
							Not yet a member?
							<a class='text-white' href='register.php'> Sign Up</a>
							<br>
							<a class='text-white' href='forgotPassword.php'>Forgot Password?</a>
						</div>
						<div class="form-group col float-right">
							<button name="btnLogin" type="submit" class="btn btn-outline-light">
								<i class="fas fa-sign-in-alt"></i> Login</button>
						</div>
					</div>
				</form>
				<hr>
			</div>
			<!--end login form-->
		</div>
		<!--row-->
	</div>
	<!--end container-fluid-->

	<br>

	<!--END LOGIN-->


	<footer class="container bg-dark text-center text-white">
		<div class="container py-2">
			<div class="row text-center">
				<div class="col-lg-12">GETS ICAFE MANAGER &copy;2018</div>
			</div>
		</div>
	</footer>
	</div>
	<!--end container-->

</body>

</html>