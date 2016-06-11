<? include "../../myDatabase3.php" ?>
<? include "../../myDatabase4.php" ?>
<? $date1 = $_GET['date1'] ?>
<? $date2 = $_GET['date2'] ?>

<? $personalBalance = 0 ?>

<? $ro3 = new database3() ?>
<? $ro4 = new database4() ?>

<? $ro3->personalBalancePatient($date1,$date2) ?>

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
			<h4>Balance Outpatient</h4>
			<form method="get" action="<? $_SERVER['PHP_SELF'] ?>">
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
			<div class="col-md-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Name</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro3->personalBalancePatient_registrationNo() as $registrationNo ) { ?>
							<tr>
								<td>
									<? echo $ro4->formatDate($ro3->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo)) ?>
								</td>
								<td>
									<?
										echo $ro3->selectNow("patientRecord","lastName","patientNo",$ro3->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)).", ".$ro3->selectNow("patientRecord","firstName","patientNo",$ro3->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo))
									?>
								</td>
								<td>
									<?
										$personalBalance += ($ro3->personalBalancePatient_total($registrationNo) + $ro3->personalBalancePatient_therapy_total($registrationNo));
										echo number_format($ro3->personalBalancePatient_total($registrationNo) + $ro3->personalBalancePatient_therapy_total($registrationNo),2);
									?>
								</td>
							</tr>
						<? } ?>
					</tbody>
					<tbody>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><? echo number_format($personalBalance,2) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>