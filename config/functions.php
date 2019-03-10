<?php
$conn;
$errors = array();
$modalErrors = array();

function __construct($db){
	$conn = $db;
}

function display_error(){
	global $errors;

	if(count($errors) > 0){
		echo 
		'<div class="alert alert-danger alert-dismissable fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>';
		foreach($errors as $error){
			echo $error.'<br>';
		}
		echo '</div>';
	}
	
}

function modalErrors(){
	global $modalErrors;

	if(count($modalErrors) > 0){
		echo 
		'<div class="alert alert-danger alert-dismissable fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>';
		foreach($modalErrors as $modalError){
			echo $modalError.'<br>';
		}
		echo '</div>';
	}
	
}

if(isset($_POST['cancelEdit'])){
	if($_SESSION['user']['accessLevel'] == 'Admin'){
		header("location: main.php");
	}
	else if($_SESSION['user']['accessLevel'] == 'Attendant'){
		header("location: main.php");
	}
	else if($_SESSION['user']['accessLevel'] == 'Member'){
		header("location: memberHome.php");
	}
}

function isLoggedIn(){
	if(isset($_SESSION['user'])){
		return true;
	}
	else{
		return false;
	}
}

if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
}

function isAdmin() {
	if(isset($_SESSION['user']) && $_SESSION['user']['accessLevel'] == 'Admin') {
		return true;
	}
	else {
		return false;
	}
}

function isEmployee() {
	if(isset($_SESSION['user']) && $_SESSION['user']['accessLevel'] == 'Admin') {
		return true;
	}
	else if(isset($_SESSION['user']) && $_SESSION['user']['accessLevel'] == 'Attendant'){
		return true;
	}
	else {
		return false;
	}
}


function checkEmail($email) {
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else {
		return false;
	}
}

function readTicket(){
	$query = "SELECT * FROM ticket_type";

	$stmt = $this->conn->prepare($query);
	$stmt->execute();

	return $stmt;
}
?>