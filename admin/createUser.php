<?php 
include_once '../config/functions.php';
include_once '../config/database.php';
include_once '../classes/userClass.php';
$page_title="Create Employee Account";

if(!isAdmin()){
  $_SESSION['msg'] = "The page you are trying to access requires administrator login!";
  header("location: ../index.php");
}

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['reg_btn'])){
  $register = new User($db);
  $registerStmt = $register->register();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Administrator</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<script src="../assets/jquery/3.2.1/jquery-3.2.1.slim.min.js" "></script>
	<link rel="stylesheet" href="../assets/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="../assets/bootstrap/4.0.0/js/bootstrap.min.js" "></script>
	<script src="../assets/popper.js/1.12.9/popper.min.js"></script>
  <link rel="stylesheet" href="../assets/fonts/fontawesome-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="icon" href="icon.png" type="image/x-icon" />
	
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-dark bg-dark">
  <span class="navbar-brand mb-0 h1"><h3><?php echo $page_title; ?></h3></span>
</nav>
		<div class="row">&nbsp</div>

	<div class='jumbotron'>
  <div class="col">
    <!--REGISTRATION FORM-->
    <form class="jumbotron" method="post" action ='createUser.php' style="border-width:1px;border-style:solid;border-radius:5px;">
      <?php echo display_error(); ?>

    <div class='form-row'><!--row 1-->
      <div class="form-group col-sm-4">
       <label>First Name</label>
       <input type="text" class="form-control form-control-sm" name="firstName" placeholder="Ex. Juan">
     </div>

     <div class="form-group col-sm-4">
       <label>Middle Name</label>
        <input type="text" class="form-control form-control-sm" name="middleName" placeholder="(Optional)">
    </div>

     <div class="form-group col-sm-4">
        <label>Last Name</label>
        <input type="text" class="form-control form-control-sm" name="lastName" placeholder="Ex. Dela Cruz" >
      </div>

     
  </div><!--end row 1-->

  <div class="form-row"><!--row 2-->
      <div class="form-group col-sm-4">
    <label>Email Address</label>
    <input type="email" class="form-control form-control-sm" name="email" placeholder="emailaddress@email.com">
  </div>
  <div class="form-group col-sm-4">
    <label>Contact No</label>
    <input type="text" class="form-control form-control-sm" pattern="[0-9]{11}" name="contactNo" placeholder="09123456789" >
  </div>

</div><!--end row 2-->

<div class="form-row"><!--row 3-->

  <div class="form-group col-sm-3">
    <label>Type</label>
      <select required="true" class='form-control form-control-sm' name="accessLevel" id="accessLevel">
        <option value="Attendant">Attendant</option>
        <option value="Admin">Admin</option>
        
      </select>
  </div>
  <div class="form-group col-sm-3">
    <label>Username</label>
    <input type="text" class="form-control form-control-sm" name="username">
  </div>
  <div class="form-group col-sm-3">
		<label>Password</label>
    <input type="password" class="form-control form-control-sm" name="password_1"><small id="passwordHelpBlock" class="form-text text-muted">
       Password must be 8-20 characters long
     </small>	
	</div>
  <div class="form-group col-sm-3">
    <label>Confirm Password</label>
    <input type="password" class="form-control form-control-sm" name="password_2">
  </div>
</div><!--end row 3-->

  <div class="input-group-my-2 my-lg-0" align="right">
    <button type="submit" name="reg_btn" class="btn btn-outline-dark"><i class="fas fa-user-plus"></i> Create User</button>
    <a class="btn btn-outline-danger" href="../main.php" role="button">Cancel</a>
  </div>
</form>
</div><!--col2-->
<!--END CREATE ACCOUNT-->


</div><!--container-fluid-->

<?php
include_once '../footer.php';
?>