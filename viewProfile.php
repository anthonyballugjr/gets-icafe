<?php
$tabTitle="Member Profile";
$page_title = "My Profile";
include_once "headerPlain.php";
include_once 'config/database.php';
include_once 'config/functions.php';
include_once 'classes/userClass.php';

if(!isLoggedIn()){
  $_SESSION['msg'] = "You must login first!";
  header("location: index.php");
}

$database = new Database();
$db = $database->getConnection();

$account = new User($db);
$stmt = $account->readProfile();

$str = $_SESSION['user']['middleName'];
?>


<div class="container">
	<div class="jumbotron bg-dark text-white" style="width:40%;margin:0 auto;">
		<div class="form-row">
			<!--row 1-->
			<div class="form-group col-sm-12">
				<center>
					<img class="img-thumbnail" src="images/<?php echo $_SESSION['user']['image'];?>"
					 style="width:140px; height:auto; border-width:2px; border-style: solid;border-color:black;" id="profile-img-tag">
				</center>
			</div>
		</div>
		<!--end row 1-->
		<center>
			<div class="form-row">
				<!--row 2-->
				<div class="form-group col-sm-12">
					<h3>
						<?php echo $_SESSION['user']['firstName']." ".substr($_SESSION['user']['middleName'],0,1)."."." ".$_SESSION['user']['lastName'];?>
					</h3>
					<h6>
						<i>GETS
							<?php echo $_SESSION['user']['accessLevel'];?>
						</i>
					</h6>
				</div>
			</div>
			<div class='form-row'>
				<!--row 3-->
				<div class="form-group col-sm-12">
					<h6>Username:
						<?php echo $_SESSION['user']['userName'];?>
					</h6>
					<h6>Mobile Number:
						<?php echo $_SESSION['user']['contactNo'];?>
					</h6>
					<h6>Email:
						<?php echo $_SESSION['user']['emailAddress'];?>
					</h6>
					<?php if($_SESSION['user']['accessLevel'] == 'Member'){ ?>
					<h6>Remaining Balance:
						<?php echo $account->balance;?>
					</h6>
					<?php }?>
				</div>
			</div>
		</center>

		<center>
			<a class="btn btn-info" role="button" <?php if($_SESSION[ 'user'][ 'accessLevel']=='Member' ) {?> href="memberHome.php"
				<?php } else if($_SESSION['user']['accessLevel'] == 'Attendant'){ ?>
				href="main.php"
				<?php } else { ?>
				href="main.php"
				<?php }?>
				>
				<i class="fas fa-arrow-alt-circle-left"></i> Back to Main</a>
		</center>

	</div>
</div>

<!--<div class='form-row'><!--row 4>
    <div class="form-group col-lg-12">
      <!--<label>Change Password</label>>
      <div class="form-check">
        <label>
          Change Password
        </label>
      </div>

      <div class="form-row" id="divPassword" style="display:none;">
        <div class="form-group col-sm-3">
          <input type="password" class="form-control form-control-sm" placeholder="Enter Old Password" id="oldPassword" name="oldPassword">
        </div>
        <div class="form-group col-sm-3">
          <input type="password" class="form-control form-control-sm" placeholder="Enter New Password" name="newPassword_1">
          <small id="passwordHelpBlock" class="form-text text-muted">
          Password must be 8-20 characters long
          </small>
        </div>
        <div class="form-group col-sm-3">
          <input type="password" class="form-control form-control-sm" placeholder="Confirm New Password" name="newPassword_2">
        </div>
        <div class="form-group">
          <button>Update Password</button>
          <script type="text/javascript">
            $('#myCheck').change(function(){
              $('#divPassword').toggle();
            });
            
          </script>
        </div>
      </div>
    </div>
  </div>-->



</div>
</div>