<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>

<? $date1 = $_GET['date1'] ?>
<? $date2 = $_GET['date2'] ?>
<? $blaanceTotal = 0 ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<? $ro4->inpatient_discharged($date1,$date2) ?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="UTF-8">
		<script src="../../jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.theme.min.css"></link>	

		<script>
			$(document).ready(function(){
				$(".date").datepicker({
					dateFormat:'yy-mm-dd',
				});
			});
		</script>

	</head>
	<body>
		<div class="container">
			<h4>Balance Inpatient</h4>
			<form method="get" action="<? $_SERVER['PHP_SELF'] ?>">
				<input type="hidden" name="payment" value="<? echo $payment ?>">
				<div class="row">
					<div class="col-md-2">
						<input type="text" name="date1" class="form-control date" readonly="readonly" value="<? echo $date1 ?>">
					</div>

					<div class="col-md-2">
						<input type="text" name="date2" class="form-control date" readonly="readonly" value="<? echo $date2 ?>">
					</div>			

					<div class="col-md-2">
						<input type="submit" class="btn btn-success" value="Proceed">
					</div>	
				</div>
			</form>			
			<div class="col-md-7">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Patient</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->inpatient_discharged_registrationNo() as $registrationNo ) { ?>
							<? $cashPayment = $ro4->inpatient_payment_total($registrationNo,"Cash") ?>
							<? $creditCardPayment = $ro4->inpatient_payment_total($registrationNo,"Credit Card") ?>
							<? $discount = $ro->selectNow("registrationDetails","discount","registrationNo",$registrationNo) ?>
							<?
								$pxCharges = round( 
									$ro4->inpatient_paymentMode_total_charges($registrationNo,"cashUnpaid") + 
									$ro4->inpatient_paymentMode_total_inventory($registrationNo,"cashUnpaid") + 
									$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"cashUnpaid"),2 
									); 									
							?>
							<?
								$hmoExcess = (
									$ro->selectNow("registrationDetails","hmoManualExcessValue","registrationNo",$registrationNo) + 
									$ro->selectNow("registrationDetails","PHICportion","registrationNo",$registrationNo) + 
									$ro->selectNow("registrationDetails","excessMaxBenefits","registrationNo",$registrationNo) + 
									$ro->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo) + 
									$ro->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo)
									)
							?>
							<?
								$pxTotalCharges = ( $pxCharges + $hmoExcess )
							?>
							<? $pxPayment = ( $cashPayment + $creditCardPayment + $discount ) ?>
							<? $pxBalance = ( $pxTotalCharges - $pxPayment ) ?>
							<?if( $pxBalance > 0 ) {?>
								<tr>
									<td>
										<? 
											echo $ro4->formatDate($ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo))
										 ?>
									</td>

									<td>
										<?
											$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
											$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
											$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
											echo $lastName.", ".$firstName;
										?>
									</td>

									<td>
										<?
											echo number_format($pxBalance,2);
											$blaanceTotal += $pxBalance;
										?>
									</td>
								</tr>
							<? } ?>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><? echo number_format($blaanceTotal,2) ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>