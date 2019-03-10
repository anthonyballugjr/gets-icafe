<?php
$tabTitle="Membership Registration";
$page_title ='Membership Registration';
include_once 'headerPlain.php';
include_once 'config/database.php';
include_once 'classes/userClass.php';
include_once 'config/functions.php';

error_reporting( ~E_NOTICE);

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['reg_btn'])){
  $register = new User($db);
  $reg = $register->register();
}
?>

<!--CREATE ACCOUNT-->



<div class='form-row'>
	<div class='col-sm-12'>
		<?php echo display_error();?>
	</div>
</div>

<div class="jumbotron">
	<form autocomplete="off" method="post" action='register.php' enctype='multipart/form-data'>
		<div class='form-row'>
			<!--row 1-->
			<div class="form-group col-sm-4">
				<label>First Name</label>
				<input type="text" class="form-control form-control-sm" name="firstName" placeholder="Ex. Juan" value="<?php echo $firstName; ?>">
			</div>

			<div class="form-group col-sm-4">
				<label>Middle Name</label>
				<input type="text" class="form-control form-control-sm" name="middleName" placeholder="Ex. De Guzman (Optional)" value="<?php echo $middleName;?>">
			</div>

			<div class="form-group col-sm-4">
				<label>Last Name</label>
				<input type="text" class="form-control form-control-sm" name="lastName" placeholder="Ex. Dela Cruz" value="<?php echo $lastName; ?>">
			</div>
		</div>
		<!--end row 1-->

		<div class="form-row">
			<!--row 2-->
			<div class="form-group col-sm-4">
				<label>Email Address</label>
				<input type="email" class="form-control form-control-sm" name="email" placeholder="Ex. emailaddress@email.com" value="<?php echo $email;?>">
			</div>

			<div class="form-group col-sm-4">
				<label>Mobile Number</label>
				<input type="text" class="form-control form-control-sm" pattern="[0-9]{11}" title="ex. 09123456789, Please input 11 mobile numbers format"
				 name="contactNo" placeholder="Ex. 09123456789" value="<?php echo $contactNo;?>">
			</div>
		</div>
		<!--end row 2-->

		<div class="form-row">
			<!--row 3-->
			<div class="form-group col">
				<label>Username</label>
				<input type="text" class="form-control form-control-sm" name="username" value="<?php echo $username; ?>">
			</div>

			<div class="form-group col">
				<label>Password</label>
				<input type="password" placeholder="Password must be 8-20 characters long" id="password_1" class="form-control form-control-sm"
				 name="password_1">
				<small id="passwordHelpBlock" class="form-text text-muted">
					<input type="checkbox" onclick="showPass()"> Show Password
				</small>
			</div>
			<div class="form-group col-sm-4">
				<label>Confirm Password</label>
				<input type="password" class=" form-control form-control-sm" name="password_2">
			</div>
		</div>
		<!--end row 3-->

		<script>
			function showPass() {
				var x = document.getElementById("password_1");
				if (x.type === "password") {
					x.type = "text";
				} else {
					x.type = "password";
				}
			}
		</script>

		<div class="form-row">
			<div class="form-group col-sm-8"></div>
			<div class="form-group col-sm-4">
				<small class="form-text text-muted col-sm-12">
					By clicking
					<mark>Sign Up</mark>, you agree to our
					<a href="#modalTerms" role="button" data-toggle="modal" data-target="#modalTerms">Terms</a> and that you have read our
					<a href="#modalPrivacy" role="button" data-toggle="modal" data-target="#modalPrivacy">Date Use Policy</a>.
				</small>
			</div>
		</div>

		<div class="form-row float-right">
			<div class="form-group">
				<button type="submit" name="reg_btn" class="btn btn-outline-dark">
					<i class="fas fa-user-plus"></i> Sign up</button>
				<a class="btn btn-outline-danger" href="index.php" role="button">Cancel</a>
			</div>
		</div>

	</form>
	<!--end form-->
</div>



<!-- TERMS AND CONDITIONS Modal -->
<div class="modal fade bd-example-modal-lg" id="modalTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title" id="exampleModalLongTitle">Terms and Conditions</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<p>Last updated: February 05, 2018</p>


				<p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the http://www.getsicafe.com
					website (the "Service") operated by GETS ICafe ("us", "we", or "our").</p>

				<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms
					apply to all visitors, users and others who access or use the Service.</p>

				<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then
					you may not access the Service.

					<h5>Accounts</h5>

					<p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times.
						Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our
						Service.</p>

					<p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions
						under your password, whether your password is with our Service or a third-party service.</p>

					<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any
						breach of security or unauthorized use of your account.</p>


					<h5>Links To Other Web Sites</h5>

					<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by GETS ICafe.</p>

					<p>GETS ICafe has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any
						third party web sites or services. You further acknowledge and agree that GETS ICafe shall not be responsible or liable,
						directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance
						on any such content, goods or services available on or through any such web sites or services.</p>

					<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services
						that you visit.</p>


					<h5>Termination</h5>

					<p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever,
						including without limitation if you breach the Terms.</p>

					<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without
						limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

					<p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever,
						including without limitation if you breach the Terms.</p>

					<p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may
						simply discontinue using the Service.</p>

					<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without
						limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>


					<h5>Governing Law</h5>

					<p>These Terms shall be governed and construed in accordance with the laws of Philippines, without regard to its conflict
						of law provisions.</p>

					<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any
						provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms
						will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede
						and replace any prior agreements we might have between us regarding the Service.</p>


					<h5>Changes</h5>

					<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material
						we will try to provide at least 15 days notice prior to any new terms taking effect. What constitutes a material change
						will be determined at our sole discretion.</p>

					<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised
						terms. If you do not agree to the new terms, please stop using the Service.</p>


					<h5>Contact Us</h5>

					<p>If you have any questions about these Terms, please
						<a href="#">contact us</a>.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--END TERMS & CONDITIONS-->


<!--PRIVACY POLICY MODAL-->
<div class="modal fade bd-example-modal-lg" id="modalPrivacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
 aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title" id="exampleModalLongTitle">Privacy Policy</h1>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<p>Last updated: February 05, 2018</p>

				<p>GETS Icafe ("us", "we", or "our") operates the http://www.getsicafe.com website (the "Service").</p>

				<p>This page informs you of our policies regarding the collection, use and disclosure of Personal Information when you use
					our Service.</p>

				<p>We will not use or share your information with anyone except as described in this Privacy Policy.</a>.</p>

				<p>We use your Personal Information for providing and improving the Service. By using the Service, you agree to the collection
					and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, terms used in
					this Privacy Policy have the same meanings as in our Terms and Conditions, accessible at http://www.getsicafe.com</p>


				<h5>Information Collection And Use</h5>

				<p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used
					to contact or identify you. Personally identifiable information may include, but is not limited to, your name, phone
					number, other information ("Personal Information").</p>

				<h5>Log Data</h5>

				<p>We collect information that your browser sends whenever you visit our Service ("Log Data"). This Log Data may include
					information such as your computer's Internet Protocol ("IP") address, browser type, browser version, the pages of our
					Service that you visit, the time and date of your visit, the time spent on those pages and other statistics.</p>

				<h5>Cookies</h5>

				<p>Cookies are files with small amount of data, which may include an anonymous unique identifier. Cookies are sent to your
					browser from a web site and stored on your computer's hard drive.</p>

				<p>We use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie
					is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>

				<h5>Service Providers</h5>

				<p>We may employ third party companies and individuals to facilitate our Service, to provide the Service on our behalf,
					to perform Service-related services or to assist us in analyzing how our Service is used.</p>

				<p>These third parties have access to your Personal Information only to perform these tasks on our behalf and are obligated
					not to disclose or use it for any other purpose.</p>

				<h5>Security</h5>

				<p>The security of your Personal Information is important to us, but remember that no method of transmission over the Internet,
					or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your
					Personal Information, we cannot guarantee its absolute security.</p>

				<h5>Links To Other Sites</h5>

				<p>Our Service may contain links to other sites that are not operated by us. If you click on a third party link, you will
					be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>

				<p>We have no control over, and assume no responsibility for the content, privacy policies or practices of any third party
					sites or services.</p>

				<h5>Changes To This Privacy Policy</h5>

				<p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy
					on this page.</p>

				<p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective
					when they are posted on this page.</p>

				<h2>Contact Us</h2>

				<p>If you have any questions about this Privacy Policy, please
					<a href="#">contact us</a>.</p>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--END PRIVACY POLICY-->




<!--END CREATE ACCOUNT-->