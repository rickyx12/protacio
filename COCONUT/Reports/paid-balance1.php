<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $itemNo = $_POST['itemNo'] ?>
<? $paid = $_POST['paid'] ?>
<? $ro4->registration_details($ro->selectNow("registrationDetails","patientNo","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo))) ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>			
	</head>
	<body>
		<div class="container">
			<h3><? echo $ro->selectNow("patientRecord","completeName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo))) ?></h3>
			<h4>Paid - <? echo $paid ?></h4>
			<div class="col-md-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Reg#</th>
							<th>In</th>
							<th>Out</th>
							<th>Balance</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach($ro4->registration_details_registrationNo() as $registrationNo) { ?>
							<tr>

								<? if($ro4->patient_with_transaction_balance($registrationNo) > 0) { ?>
									<td><? echo $registrationNo ?></td>
									<td><? echo $ro4->formatDate($ro->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo)) ?></td>
									<td><? echo $ro4->formatDate($ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo)) ?></td>
									<td><? echo $ro4->patient_with_transaction_balance($registrationNo) ?></td>
									<? if( $paid >= $ro4->patient_with_transaction_balance($registrationNo) ) { ?>
										<form method="post" action="paid-balance2.php">
											<input type="hidden" name="registrationNo_balance" value="<? echo $registrationNo ?>">
											<input type="hidden" name="registrationNo_paid" value="<? echo $ro->selectNow("patientCharges","registrationNo","itemNo",$itemNo) ?>">
											<input type="hidden" name="itemNo" value="<? echo $itemNo ?>">

											<? if($ro->selectNow("paidBalance","amountPaid","registrationNo_balance",$registrationNo) != "") { ?>
												<td><span class="label label-success">Paid</span></h5>
											<?}else {?>	
												<td><input type="submit" class="btn btn-danger" value="Paid"></td>
											<? } ?>
										</form>
									<? }else { ?>	
										<td></td>
									<? } ?>
								<? } ?>

							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>