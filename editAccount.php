<?php
$tabTitle="Edit Account";
$page_title = "Edit Account";
include_once 'headerPlain.php';
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
$stmt = $account->readMember();

if(isset($_POST['btnUpdate'])){
  $update = new User($db);
  $updateStmt = $update->updateAccount();
}

if(isset($_POST['btnChangePassword'])){
$account->changePassword();
}
?>

<h3>
	<strong>
		<?php echo $_SESSION['user']['firstName']. " " .$_SESSION['user']['lastName']; ?>
	</strong>
</h3>
<div class='form-row'>
	<div class='col-sm-4'>
		<?php echo display_error();?>
	</div>
</div>



<form autocomplete="off" method="post" action="editAccount.php" enctype="multipart/form-data" class="form-horizontal">

	<div class="form-row">
		<!--row 1-->
		<div class="form-group col-sm-2">
			<label>Profile Picture</label>
			<br>
			<img src="images/<?php echo $_SESSION['user']['image'];?>" style="width:100px; height:auto;"
			 id="profile-img-tag">
			<input type="file" name="image" accept="image/*" class="btn btn-sm" id="profile-img">
		</div>

		<script type="text/javascript">
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#profile-img-tag').attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
			$('#profile-img').change(function() {
				readURL(this);
			});
		</script>

	</div>
	<!--end row 1-->

	<div class="form-row">
		<!--row 2-->
		<div class="form-group col-sm-4">
			<label>First Name</label>
			<input type="text" class="form-control form-control-sm" name="firstName" value="<?php echo $_SESSION['user']['firstName'];?>">
		</div>
		<div class='form-group col-sm-4'>
			<label>Middle Name</label>
			<input type='text' class='form-control form-control-sm' name='middleName' value="<?php echo $_SESSION['user']['middleName'];?>">
		</div>
		<div class='form-group col-sm-4'>
			<label>Last Name</label>
			<input type='text' class='form-control form-control-sm' name='lastName' value="<?php echo $_SESSION['user']['lastName'];?>">
		</div>

	</div>

	<div class='form-row'>
		<!--row 3-->
		<div class='form-group col-sm-4'>
			<label>Mobile Number</label>
			<input type='text' class='form-control form-control-sm' pattern="[0-9]{11}" title="ex. 09123456789, Please input 11 mobile numbers format"
			 name='contactNo' value="<?php echo $_SESSION['user']['contactNo'];?>">
		</div>

	</div>

	<div class='form-row'>
		<!--row 5-->
		<div class="form-group">
			<a href="#" role="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#changePasswordModal" data-backdrop="static">Change Password</a>
		</div>
	</div>
	<!--end row 5-->

	<div class='form-row float-right'>
		<div class='form-group col'>
			<button type='submit' name='btnUpdate' class='btn btn-outline-dark'>Save</button>
			<button type='submit' name='cancelEdit' class='btn btn-outline-danger'>Cancel</button>
		</div>
	</div>
</form>

<!--CHANGE PASSWORD-->
<div data-backdrop="static" class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark text-white">
				<h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
				<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!--modal content-->

				<?php if(isset($_SESSION['modalMsg'])) : ?>
				<div class="alert alert-info">
					<h5>
						<?php echo $_SESSION['modalMsg'];
                      unset($_SESSION['modalMsg']);
              ?>
					</h5>
				</div>
				<?php endif ?>
				<?php echo modalErrors();?>

				<form action="editAccount.php" method="post" id="changePasswordForm">
					<div class="form-row" id="divPassword">
						<div class="form-group col-sm-9">
							<input type="password" class="form-control form-control" placeholder="Enter current password" id="oldPassword" name="oldPassword"
							 required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-9">
							<small id="passwordHelpBlock" class="form-text text-muted">
								Password must be 8-20 characters long
							</small>
							<input type="password" class="form-control form-control" placeholder="Enter new password" name="newPassword_1" required>
							<!--oninvalid="this.setCustomValidity('Please enter a new password')" oninput="setCustomValidity('')"-->
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-9">
							<input type="password" class="form-control form-control" placeholder="Confirm new password" name="newPassword_2" required>
						</div>
					</div>
			</div>
			<!--end modal content-->

			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
				<button type="submit" name="btnChangePassword" class="btn btn-outline-dark" id="btnChange">Save changes
				</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!--END CHANGE PASSWORD-->


<script type="text/javascript">
	<?php if(isset($_POST['btnChangePassword'])){?>
	/* Your (php) way of checking that the form has been submitted */
	$(function() { // On DOM ready
		$('#changePasswordModal').modal('show'); // Show the modal
	});
	<?php } ?>
	/* /form has been submitted */
</script>