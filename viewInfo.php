<?php

include_once "config/database.php";
include_once "classes/userClass.php";

$database = new Database();
$db = $database->getConnection();

$user=new User($db);

if(isset($_POST['accountID'])){
  $user->accountID=$_POST['accountID'];
  $stmt = $user->readOne();
}
?>

<div class="row">
  <div class="col-lg-3">
    <img alt="User Image" class="img-fluid" <?php if($user->image==""){?> src="images/default.png" <?php } else {?> src="images/<?php echo $user->image;?>" <?php }?>>
  </div>
  <div class="col-lg-9">
    <table class="table table-striped table-sm">
      <tr>
        <th>Full Name: </th>
        <td ><?php echo $user->firstName." ".$user->middleName." ".$user->lastName;?></td>
      </tr>
      <tr>
        <th>Email Address: </th>
        <td><?php echo $user->email;?></td>
      </tr>
      <tr>
        <th>Contact Number: </th>
        <td><?php echo $user->contactNo;?></td>
      </tr>
    </table>
  </div>
  
</div>
   