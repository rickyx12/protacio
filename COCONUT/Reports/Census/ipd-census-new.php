<? include "../../../myDatabase.php" ?>
<? include "../../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../../jquery-2.1.4.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../../bootstrap-3.3.6/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../../js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../../js/jquery-ui.theme.min.css"></link>

		<script>
			$(document).ready(function() { 
				$("#date").datepicker({
					dateFormat:'yy-mm-dd',
					onSelect:function(dateText) {
						$("body").load("ipd-census-new.php",{date:dateText});
					}
				});
			});
		</script>

	</head>
	<body>

		<?

		if(isset($_POST['date'])) {
			$date = $_POST['date'];
		}else {
			$date = date("Y-m-d");
		}

		?>

		<? $ro4->ipd_census($date) ?>
		<? $totalPatient = 0 ?>
		<div class="container">
			<h2>Inpatient Census</h2>
			<div class="row">
				<div class="col-md-3">
						<input type="text" id="date" value="<? echo $date ?>" class="form-control">		
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="col-md-10">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>PIN#</th>
								<th>Case#</th>
								<th>Name</th>
								<th>HMO</th>
								<th>PhilHealth</th>
							</tr>
						</thead>
						<tbody>
						<? foreach($ro4->ipd_census_id() as $id) { ?>
							<? $totalPatient += 1 ?>
							<tr>
								<td><? echo $ro->selectNow("registrationDetails","manual_patientNo","registrationNo",$ro->selectNow("ipdCensus","registrationNo","id",$id)) ?></td>

								<td><? echo $ro->selectNow("registrationDetails","manual_registrationNo","registrationNo",$ro->selectNow("ipdCensus","registrationNo","id",$id)) ?></td>

								<td><? echo $ro->selectNow("patientRecord","completeName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$ro->selectNow("ipdCensus","registrationNo","id",$id))) ?></td>	

								<td><? echo $ro->selectNow("registrationDetails","Company","registrationNo",$ro->selectNow("ipdCensus","registrationNo","id",$id)) ?></td>	

								<td><? echo $ro->selectNow("patientRecord","PHIC","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$ro->selectNow("ipdCensus","registrationNo","id",$id))) ?></td>					

							</tr>
						<? } ?>
						</tbody>
						<tbody>
							<tr>
								<td><b>Patients</b></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><b><? echo $totalPatient ?></b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>