<?php include "../../../myDatabase.php" ?>
<?php include "../../../myDatabase4.php" ?>
<?php $ro = new database() ?>
<?php $ro4 = new database4() ?>
<?php $ro4->get_opd_collection($_GET['registrationNo']) ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <script src="../../../jquery-2.1.4.min.js"></script>
  <link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>

  <script>
	$(document).ready(function(){
			<?php foreach($ro4->get_opd_collection_collectionNo() as $collectionNo) { ?>
					$(document).on("click","#voidBtn<?php echo $collectionNo ?>",function(){
						
						$.post("void-opd-new-backend.php",{collectionNo:<?php echo $collectionNo ?>},function(){
							location.reload();
						});
						
					});
			<?php } ?>
	});  	
  </script>

</head>
<body>
	<div class="container">
	<h3>Void Payments</h3>
	<div class="col-md-2"></div>
	<div class="col-md-9">
		<table id="voidTable" class="table table-hover">
			<thead>
				<tr>
					<th>OR#</th>
					<th>Particulars</th>
					<th>Date Paid</th>
					<th>Paid</th>
					<th>PF</th>
					<th>Paid Via</th>
					<th>Paid By</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($ro4->get_opd_collection_collectionNo() as $collectionNo) { ?>
				<tr>
					<td>&nbsp;<?php echo $ro->selectNow("collectionReport","orNo","collectionNo",$collectionNo) ?></td>
					<td>&nbsp;<?php echo $ro->selectNow("patientCharges","description","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo)) ?></td>
					<td>&nbsp;<?php echo $ro4->formatDate($ro->selectNow("collectionReport","datePaid","collectionNo",$collectionNo)) ?></td>
					<td>&nbsp;<?php echo $ro->selectNow("collectionReport","amountPaid","collectionNo",$collectionNo) ?></td>
					<td>&nbsp;<?php echo $ro->selectNow("patientCharges","doctorsPF","itemNo",$ro->selectNow("collectionReport","itemNo","collectionNo",$collectionNo)) ?></td>
					<td>&nbsp;<?php echo $ro->selectNow("collectionReport","paidVia","collectionNo",$collectionNo) ?></td>
					<td>&nbsp;<?php echo $ro->selectNow("collectionReport","paidBy","collectionNo",$collectionNo) ?></td>
					<td>&nbsp;<input type="button" id="voidBtn<?php echo $collectionNo ?>" class="btn btn-danger" value="Void"></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	</div>
</body>
</html>