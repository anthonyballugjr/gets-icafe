<?php 
$page_title = "Computer Terminals";
//include_once '../headerPlain.php';
include_once '../classes/computerClass.php';
include_once '../config/functions.php';
include_once '../config/database.php';



$database = new Database();
$db = $database->getConnection();

$computer = new Computer($db);
$stmt = $computer->readAllComputer();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>GETS Internet Cafe</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<script src="../assets/jquery/3.2.1/jquery-3.2.1.slim.min.js" "></script>
	<link rel="stylesheet" href="../assets/bootstrap/4.0.0/css/style.css">
	<link rel="stylesheet" href="../assets/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="../assets/bootstrap/4.0.0/js/bootstrap.min.js" "></script>
	<script src="../assets/popper.js/1.12.9/popper.min.js"></script>
	
</head>

<body>
	<div class="container">

		<nav class="navbar navbar-dark bg-dark">
  <span class="navbar-brand mb-0 h1"><h3><?php echo $page_title; ?></h3></span>
</nav>


		<div class="row">&nbsp</div>

<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
extract($row);   
?>



<div class='col col-sm-1 float-left' style='display:inline-block; border-width:1px; border-style:solid;border-radius: 5px;'>
	<small><strong><?php echo $row['computerNo']; ?></strong></small>
	<small class='mx-auto d-block'><mark><strong><?php echo $row['status']; ?></strong></mark></small>
	<img class='rounded mx-auto d-block' src='../res/vacant.png' width='50px' height='50px'>
</div>

<?php
}

?>


</div>
</body>
</html>
