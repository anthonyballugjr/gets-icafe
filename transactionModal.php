<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");

include_once "config/database.php";
include_once "classes/userClass.php";
include_once "classes/computerClass.php";
include_once "classes/transactionClass.php";

$database = new Database();
$db = $database->getConnection();

$transaction = new Transaction($db);


if(isset($_POST['memberID'])){
	$transaction->memberID = $_POST['memberID'];
	$stmt = $transaction->readTransaction(); ?>


	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Date (Y-M-D)</th>
				<th>Balance Before</th>
				<th>Balance After</th>
				<th>Transaction Type</th>
			</tr>
		</thead>
		<tbody>


	<?php while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row); ?>

		<tr>
			<td><?php echo $row['dateStamp'];?></td>
			<td><?php echo $row['balanceNow'];?></td>
		</tr>


	<?php } ?>
		</tbody>
	</table>

<?php }?>
