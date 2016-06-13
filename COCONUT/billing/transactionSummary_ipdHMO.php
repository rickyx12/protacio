<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>

<? $date1 = $_GET['date1'] ?>
<? $date2 = $_GET['date2'] ?>
<? $hmoTotal = 0 ?>
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
			<h4>HMO Inpatient</h4>
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
							<? if( $ro4->inpatient_hmo_total($registrationNo) > 0 ) { ?>
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
											$pxExcess = ( 
															$ro4->inpatient_hmoExcess($registrationNo,"excessMaxBenefits") + 
															$ro4->inpatient_hmoExcess($registrationNo,"excessRoom") +
															$ro4->inpatient_hmoExcess($registrationNo,"excessPF") +
															$ro4->inpatient_hmoExcess($registrationNo,"hmoManualExcessValue") +
															$ro4->inpatient_hmoExcess($registrationNo,"PHICportion")
														);
											$pxHMO = ( $ro4->inpatient_hmo_total($registrationNo) - $pxExcess );
											$hmoTotal += $pxHMO;
											echo number_format($pxHMO,2);
										?>
									</td>
								</tr>
							<? } ?>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>&nbsp;<? echo number_format($hmoTotal,2) ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>