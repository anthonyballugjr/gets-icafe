<?php

$page_title = "";
include_once '../config/database.php';
include_once '../config/functions.php';
include_once '../classes/expensesClass.php';

date_default_timezone_set('Asia/Manila');

if (!isAdmin()) {
  $_SESSION['msg'] = "The page you are trying to access requires administrator login!";
  header('location: ../index.php');
}

$database = new Database();
$db = $database->getConnection();

$expenses = new Expenses($db);
$stmt = $expenses->readExpenses();

$today = date("Y-m-d h");

if(isset($_POST['btnAddExpense'])){
  $expenses->description = ucfirst($_POST['description']);
  $expenses->amount = $_POST['amount'];
  $expenses->dateStamp = $today;
  if($expenses->addToExpense()){
   header("location: expenses.php");
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>GETS Internet Cafe</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width-device-width, initial-scale=1">
  
  <script src="../assets/jquery/3.3.1/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="../assets/bootstrap/4.0.0/css/style.css">
  <link rel="stylesheet" href="../assets/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="../assets/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="../assets/popper.js/1.12.9/popper.min.js"></script>
  <link rel="stylesheet" href="../assets/fonts/fontawesome-5.0.8/web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="icon" href="icon.png" type="image/x-icon" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand mb-0 h1" href="../main.php">GETS ICafe Manager</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../main.php">Main Module <!--<span class="sr-only">(current)</span>--></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">GETS Employees</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="employees.php">Manage</a>
              <a class="dropdown-item" href="createUser.php">Create User</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../members.php">GETS Members <!--<span class="sr-only">(current)</span>--></a>
          </li>
          <li>
            <a class="nav-link" href="../services.php">Services</a>
          </li>
          <li>
            <a class="nav-link" href="#">Expenses</a>
          </li>
        </ul>

        <ul class="navbar-nav my-2 my-lg-0">
          <a class="navbar-brand" href="#">
            <img src="../images/<?php echo $_SESSION['user']['image'];?>" style="margin-right:-20px;" width="40"  alt="">
          </a>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['user']['firstName']." ". $_SESSION['user']['lastName'];?> <small><i>(<?php echo ucfirst($_SESSION['user']['accessLevel']);?>)</i></small>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="../viewProfile.php">View Profile</a>
              <a class="dropdown-item" href="../editAccount.php">Edit Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="expenses.php?logout='1'"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container-fluid">
    <div class="jumbotron-fluid">
    <div class="row">&nbsp</div>

    <div class="row">
      <div class="col-lg-12">
        <h3><?php echo $page_title ?></h3>
      </div>
    </div>

    <hr>
    <div class="row">

      <div class="col col-lg-6">
        <h4>Expenses (<?php echo date("F d, Y - l");?>)</h4>
        <hr>
        <table class="table table-hover table-bordered table-sm">
          <thead>
            <tr>
              <th>Description</th>
              <th>Amount</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $totalExpenses=0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
              extract($row); ?>

              <tr>
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['amount'];?></td>
                
              </tr>
              <?php $totalExpenses += $row['amount'];?>
            <?php }?>
          </tbody>
        </table>
        <div class="form-row float-right">
          <label><h5>Total Expenses: <?php echo $totalExpenses;?></h5></label>
        </div>
      </div>

      <div class="col col-lg-6">
        <h4>Add expense</h4>
        <hr>
        <form id ="saleForm" action="expenses.php" method="post">
          <div class="form-row">
            <div class="form-group col-sm-6">
              <textarea name="description" class="form-control" required placeholder="Enter description"></textarea>
            </div>
            <div class="form-group col-sm-4">
              <input type="text" class="form-control" name="amount" id="quantity" placeholder="Enter amount" required accept="number/*">
            </div>
          </div>
          <div class="form-group">
            <button name="btnAddExpense" type="submit" class="btn btn-primary" onclick="return confirm('Add to expenses?')"><i class="fas fa-plus"></i> Add expense</button>
            <button type="reset" class="btn btn-danger">Clear</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
  </div>
