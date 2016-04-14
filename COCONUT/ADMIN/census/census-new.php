<? include "../../../myDatabase4.php" ?>
<? include "../../../myDatabase.php" ?>
<? $ro4 = new database4() ?>
<? $ro = new database() ?>
<? if(isset($_POST['date'])) {
	$date = $_POST['date'];
}else {
	$date = date("Y-m-d");
} ?>
<? $ro4->opd_patient_census($date,$date) ?>
<? $count = 1 ?>
<? $totalRevenue = 0 ?>
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
			$(document).ready(function(){
				$("#date").datepicker({
					dateFormat:'yy-mm-dd',
					onSelect:function(dateText) {
						$("body").load("census-new.php",{date:dateText});
					}
				});
			});
		</script>

	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Census</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					 <input type="text" id="date" value="<? echo $date ?>" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Patient</th>
							</tr>
						</thead>
						<tbody>
							<? foreach($ro4->opd_patient_census_registrationNo() as $registrationNo) { ?>
								<tr>
									<td>&nbsp;<? echo $ro->selectNow("registrationDetails","pxCount","registrationNo",$registrationNo) ?></td>
									<td>&nbsp;<? echo $ro->selectNow("patientRecord","lastName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?>, <? echo $ro->selectNow("patientRecord","firstName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?></td>
								</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>