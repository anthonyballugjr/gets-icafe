<?php
$tabTitle="Main Module";
$page_title = "";
include_once 'header.php';
include_once 'config/database.php';
include_once 'classes/reportClass.php';
include_once 'classes/servicesClass.php';
include_once 'classes/serviceSaleClass.php';
include_once 'classes/computerSaleClass.php';
include_once 'classes/reservationClass.php';
include_once 'classes/computerClass.php';
include_once 'config/functions.php';
include_once 'config/pagingConfig.php';

date_default_timezone_set('Asia/Manila');
$today=date("Y-m-d");

if (!isEmployee()) {
  $_SESSION['msg'] = "The page you are trying to access requires employee login!";
  header('location: index.php');
}

$database = new Database();
$db = $database->getConnection();

$services = new Services($db);
$service = $services->readActive();

$sales = new ServiceSale($db);
$sale = $sales->readCurrentSales();

$comSales = new computerSale($db);
$comSale = $comSales->readSales();

$computer = new Computer($db);
$stmt = $computer->readAllComputer();

$reports = new Reports($db);

if(isset($_POST['btnAddSale'])){
  $sales->serviceID = $_POST['serviceID'];
  $sales->totalPrice = $_POST['totalPrice'];
  $sales->quantity = $_POST['quantity'];
  $sales->dateStamp = $today;
  if($sales->addToSale()){
    $_SESSION['success']="Added to sale!";
    header('location: main.php');
  }
}
?>

<?php if (isset($_SESSION['loginMsg'])) : ?>
<div class="alert alert-success">
	<h5>
		<?php 
        echo $_SESSION['loginMsg']; 
        unset($_SESSION['loginMsg']);
      ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</h5>
</div>
<?php endif ?>

<?php if (isset($_SESSION['success'])) : ?>
<div class="alert alert-success">
	<h5>
		<?php 
        echo $_SESSION['success']; 
        unset($_SESSION['success']);
      ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</h5>
</div>
<?php endif ?>    
  

<style>
.nav-pills > .nav-item > .active{
  color:white;
  background-color:#343a40;
  border-radius: 0px;
}
.row > .col-3 > .nav > .active{
  color:white;
  background-color:#343a40;
  border-radius: 0px;
}
.nav-pills > .nav-item > a{
  color:#212529;
}
.guest{
  padding:1px;
  margin-left:5%;
}
.button > div:hover{
  background-color: #343a40;
  color:white;
}
</style>

<!-- MAIN CONTROLS -->


<div id="clockdate" class="float-right">
	<strong>
		<div class="jumbotron" style="padding:12px;border-radius:10px;">
			<div id="clock"></div>
		</div>
	</strong>
</div>
<script>
	function startTime() {
		var today = new Date();
		var hr = today.getHours();
		var min = today.getMinutes();
		var sec = today.getSeconds();
		ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
		hr = (hr == 0) ? 12 : hr;
		hr = (hr > 12) ? hr - 12 : hr;
		//Add a zero in front of numbers<10
		hr = checkTime(hr);
		min = checkTime(min);
		sec = checkTime(sec);
		document.getElementById("clock").innerHTML = hr + " : " + min + " : " + sec + " " + ap;
		var time = setTimeout(function() {
			startTime()
		}, 500);
	}

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i;
		}
		return i;
	}
</script>

<ul class="nav nav-pills" id="controlTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="computers-tab" data-toggle="tab" href="#computers" role="tab" aria-controls="computers" aria-selected="true">
			<i class="fas fa-desktop"></i> Computer Terminals</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="addToSale-tab" data-toggle="tab" href="#sale" role="tab" aria-controls="profile" aria-selected="false">
			<i class="fas fa-money-bill-alt"></i> Sales</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="messages" aria-selected="false">
			<i class="fas fa-file-alt"></i> Reports</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
			<i class="fas fa-cogs"></i> Settings</a>
	</li>
</ul>

<div class='jumbotron' style="padding-top:10px;">
	<div class="tab-content">

		<script type="text/javascript">
			$(document).ready(function() {
				$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
					localStorage.setItem('activeTab', $(e.target).attr('href'));
				});
				var activeTab = localStorage.getItem('activeTab')
				if (activeTab) {
					$('#controlTab a[href="' + activeTab + '"]').tab('show');
				}

			});
		</script>

		<!--COMPUTERS TAB-->
		<div class="tab-pane fade show active" style="margin:0 auto;" id="computers" role="tabpanel" aria-labelledby="computers-tab">

			<hr>
			<div class="row">
				<div class="col-2"></div>
				<div class="col-2">
					<small>
						<strong>Vacant:</strong>
					</small>
					<i class='fas fa-circle-notch bg-primary' style='font-size:2.2em;border-radius:50%;'></i>
				</div>
				<div class="col-2">
					<small>
						<strong>Member Use:</strong>
					</small>
					<i class='fas fa-user-circle bg-success' style='font-size:2.2em;border-radius:60%;'></i>
				</div>
				<div class="col-2">
					<small>
						<strong>Guest Use:</strong>
					</small>
					<i class='fas fa-user-circle' style='font-size:2.2em;border-radius:60%;background:#f46542'></i>
				</div>
				<div class="col-2">
					<small>
						<strong>Under Repair:</strong>
					</small>
					<i class='fas fa-ban bg-danger' style='font-size:2em;border-radius:50%;'></i>
				</div>
			</div>
			<hr>
			<?php
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
//echo"<a role='button' class='button view_data' style='color:black;' id='{$computerID}' value='{$computerNo}'>Computer</a>";
      ?>
			<a href="#" no="<?php echo $row['computerNo'];?>" class="button view_data" style="color:black;"
			 id="<?php echo $row['computerID'];?>">
				<div class='jumbotron-fluid col-lg-1 computer' style='display:inline-block;border-width:1px; border-style:solid;margin-left:-.4%;'>
					<div style="width:70%;display:inline-block;padding: .5px">
						<strong>
							<?php echo $row['computerNo']; ?>
						</strong>
						<small class='mx-auto d-block'>
							<?php echo $row['status']; ?>
						</small>
					</div>
					<div class="float-left" style="width:30%;display:inline-block;padding:1.5px;">
						<?php if($row['status'] == "Vacant"){
              echo "<i class='fas fa-circle-notch bg-primary' style='font-size:1.7em;border-radius:50%;'></i>";
            }
            else if($row['status'] == "Guest"){
              echo "<i class='fas fa-user-circle' style='font-size:1.8em;border-radius:50%;background:#f46542;'></i>";
            }
            else if($row['status'] == "Member"){
              echo "<i class='fas fa-user-circle bg-success' style='font-size:1.8em;border-radius:50%;'></i>";
            }
            else{
              echo "<i class='fas fa-ban bg-danger' style='font-size:1.8em;border-radius:50%;'></i>";
            }
            ?>
					</div>
					<center>
						<small>
							<i class="fas fa-clock timeLeft"></i>
							<div class="text-dark" id="timer"></div>
						</small>
					</center>
				</div>
			</a>
			<?php }?>
		</div>
		<script>
		</script>


		<!--END COMPUTERS TAB-->

		<!--ADD TO SALES TAB-->
		<div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="addtoSale-tab">
			<hr>
			<div class="row">

				<div class="col-lg-6">
					<h4>Sales (
						<?php echo date("F d, Y - l");?>)</h4>
					<hr>
					<table class="table table-bordered table-sm" name="employeeTable" id="employeeTable">
						<thead>
							<tr>
								<th>Sales</th>
								<th>Quantity</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php
              $serviceSales=0;
              while($rowSale = $sale->fetch(PDO::FETCH_ASSOC)){
              extract($rowSale);
              ?>
							<tr>
								<td>
									<?php echo $rowSale['serviceName'];?>
								</td>
								<td>
									<?php echo $rowSale['quantity'];?>
								</td>
								<td>
									<?php echo $rowSale['totalPrice'];?>
								</td>
								<?php $serviceSales += $rowSale['totalPrice'];?>
							</tr>
							<?php }?>
						</tbody>
					</table>
					<div class="form-row text-right">
						<label class="col">
							<h6>Goods/Service Sales:
								<?php echo $serviceSales;?>
							</h6>
						</label>
					</div>
					<div class="form-row text-right">
						<?php $cSales=0;
            while($row=$comSale->fetch(PDO::FETCH_ASSOC)){
              $cSales += $row['amount']; }?>
						<label class="col">
							<h6>Computer Sales:
								<?php echo $cSales;?>
							</h6>
						</label>
					</div>
					<div class="form-row text-right">
						<label class="col">
							<h5>
								<strong>Total Sales:
									<?php echo $serviceSales + $cSales;?>
								</strong>
							</h5>
						</label>
					</div>
				</div>

				<div class="col-lg-6">
					<h4>Add to Sale</h4>
					<hr>
					<form id="saleForm" action="main.php" method="post">
						<div class="form-row">
							<div class="form-group col-sm-4">
								<label>Select Service</label>
								<select required="true" class="form-control form-control-sm" name="serviceID" onchange="$('#price').val($(this).find('option:selected').attr('service-price')), calculate()">
									<option></option>
									<?php while($row = $service->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    echo "<option service-price=".$row['servicePrice']." value=".$row['serviceID'].">".$row['serviceName']."</option>";
                  } ?>
								</select>
							</div>

							<div class="form-group col-sm-3">
								<label>Unit Price</label>
								<input type="text" readonly class="form-control form-control-sm bg-light" id="price">
							</div>
							<div class="form-group col-sm-2">
								<label>Quantity</label>
								<input type="number" class="form-control form-control-sm" name="quantity" id="quantity" onkeyup="calculate()" onchange="calculate()"
								 value="1" required>
							</div>

							<div class="form-group col-sm-3">
								<label>Sub Total</label>
								<input type="text" class="form-control form-control-sm bg-light" name="totalPrice" id="subTotal" readonly>
							</div>
						</div>

						<div class="form-group">
							<button name="btnAddSale" id="btnAddSale" type="submit" class="btn btn-primary">
								<i class="fas fa-plus"></i> Add to sale</button>
							<button type="reset" class="btn btn-danger">Clear</button>
						</div>
					</form>
				</div>

				<script>
					function calculate() {

						var unitPrice = parseFloat($('#price').val());
						var quantity = parseFloat($('#quantity').val());
						$('#subTotal').val(unitPrice * quantity);
					}
				</script>

			</div>
		</div>
		<!--END SERVICES TAB-->


		<!--REPORTS TAB-->
		<div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
			<?php 
  $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
  ?>

			<h4>Reports</h4>
			<hr>
			<div class="row">


				<div class="col-lg-4">
					<form method="POST" action="main.php">
						<label>From</label>
						<div class="form-row">
							<div class="form-group col-lg-4">
								<select class="form-control" name="monthFrom">
									<option>Month</option>
									<?php for($i=0;$i<count($months);$i++){
              $selectedMonthFrom=$i+1;
            echo "<option value=".$selectedMonthFrom.">".$months[$i]."</option>";
            } ?>
								</select>
							</div>
							<div class="form-group col-lg-3">
								<select class="form-control" name="dayFrom">
									<option>Day</option>
									<?php for($i=1;$i<32;$i++){
              echo "<option value=".$i.">".$i."</option>";
            }?>
								</select>
							</div>
							<div class="form-group col-lg-4">
								<select class="form-control" name="yearFrom">
									<option>Year</option>
									<?php for($i=date('Y');$i>1990;$i--){
              echo "<option value".$i.">".$i."</option>";
            }?>
								</select>
							</div>
						</div>

						<label>To</label>
						<div class="form-row">
							<div class="form-group col-lg-4">
								<select class="form-control" name="monthTo">
									<option>Month</option>
									<?php for($i=0;$i<count($months);$i++){
              $selectedMonthTo=$i+1;
              echo "<option id='monthTo' value=".$selectedMonthTo.">".$months[$i]."</option>";
            } ?>
								</select>
							</div>
							<div class="form-group col-lg-3">
								<select class="form-control" name="dayTo">
									<option>Day</option>
									<?php for($i=1;$i<32;$i++){
              echo "<option value=".$i.">".$i."</option>";
            }?>
								</select>
							</div>
							<div class="form-group col-lg-4">
								<select class="form-control" name="yearTo">
									<option>Year</option>
									<?php for($i=date('Y');$i>1990;$i--){
              echo "<option value".$i.">".$i."</option>";
            }?>
								</select>
							</div>
						</div>


						<div class="form-row">
							<div class="form-group col">
								<button type="submit" class="btn btn-primary" name="salesReport">Sales</button>
								<button class="btn btn-primary" name="expensesReport">Expenses</button>
							</div>
						</div>
					</form>
				</div>

				<div class="col-lg-8 bg-light">
					<?php 
      if(isset($_POST['salesReport'])){
        $x=$reports->salesReport(); ?>
					<center>
						<h1>GETS INTERNET CAFE</h1>
						<h3>Sales Report</h3>
						<hr>
						<h5>
							<?php echo "0".$monthA."/".$dayA."/".$yearA." - 0".$monthB."/".$dayB."/".$yearB;?>
						</h5>
					</center>
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th>Date</th>
								<th>Daily Sales</th>
								<th>Employee on Duty</th>
							</tr>
						</thead>
						<tbody>
							<?php $sumTotal=0;
        while($row=$x->fetch(PDO::FETCH_ASSOC)){
          $sumTotal+=$row['total'];
          extract($row);
          echo "<tr>
                  <td>{$dateStampx}</td>
                  <td>{$total}</td>
                  <td>{$employeeOnDuty}</td>
                </tr>";
        } ?>
						</tbody>
					</table>
					<div class="form-row float-right">
						<label>
							<h4>
								<?php echo "Sales Total: ".$sumTotal." PHP";?>
							</h4>
						</label>
					</div>
					<hr>
					<div class="form-row">
						<div class="form-group">
							<button class="btn btn-primary">Generate PDF</button>
						</div>
					</div>
					<?php }

      else if(isset($_POST['expensesReport'])){
       $x=$reports->expenses(); ?>

					<center>
						<h1>GETS INTERNET CAFE</h1>
						<h3>Expenses Report</h3>
						<hr>
						<h5>
							<?php echo "0".$monthA."/".$dayA."/".$yearA." - 0".$monthB."/".$dayB."/".$yearB;?>
						</h5>
					</center>
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th>Date</th>
								<th>Expense</th>
								<th>Amount</th>
								<th>Employee on Duty</th>
							</tr>
						</thead>
						<tbody>
							<?php $sumTotalx=0;
        while($row=$x->fetch(PDO::FETCH_ASSOC)){
          $sumTotalx+=$row['total'];
          extract($row);
          
          echo "<tr>
                  <td>{$dateStampx}</td>
                  <td>{$description}</td>
                  <td>{$total}</td>
                  <td>{$employeeOnDuty}</td>
                </tr>";
        } ?>
						</tbody>
					</table>
					<div class="form-row float-right">
						<label>
							<h4>
								<?php echo "Expenses Total: ".$sumTotalx;?>
							</h4>
						</label>
					</div>
					<?php }
      else{
        echo "<br><br><br><center><div class='alert alert-info'><strong>SELECT DATE/S AND TYPE OF REPORT FROM LEFT MODULE</strong></div></center>";
      } ?>
				</div>


			</div>


		</div>
		<!--END OF REPORTS-->

		<!--SETTINGS-->
		<div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

			<div class="row">
				<div class="col-3 jumbotron-fluid">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"
						 aria-selected="true">Computer</a>
						<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
						 aria-selected="false">Network</a>
						<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
						 aria-selected="false">x</a>
						<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pill
      s-settings" aria-selected="false">xx</a>
					</div>
				</div>
				<div class="col-9">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<h5>Add a PC</h5>
							<div class="form-row">
								<div class="form-group col col-lg-3">
									<input type="text" class="form-control form-control-sm" placeholder="Computer Number...">
								</div>
								<div class="form-group col">
									<button type="submit" class="btn btn-primary btn-sm">Add</button>
								</div>
							</div>
							<hr>
						</div>

						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
						<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
					</div>
				</div>
			</div>

		</div>


		<!--END OF MAIN CONTROLS-->

		<!--computerModal-->
		<div class="modal fade" id="computerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title" id="exampleModalLabel" id="computerNo">
							<?php echo date("F d, Y - l");?>
						</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="computer-body">



					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<script>
			$(document).on('click', '.view_data', function() {
				//$('#computerModal').modal('show');
				var computerID = $(this).attr("id");
				var computerNo = $(this).attr("no");

				//$('#computer-body').html(computerID);
				//$('#computerModal').modal('show')
				$.ajax({
					url: "computerModal.php",
					method: "POST",
					data: {
						computerID: computerID,
						computerNo: computerNo
					},
					success: function(data) {
						$('#computer-body').html(data);
						$('#computerModal').modal('show');

					}
				});
			});
		</script>

		<?php
include_once 'footer.php';
