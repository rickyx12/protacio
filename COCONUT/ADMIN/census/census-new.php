<? include "../../../myDatabase4.php" ?>
<? include "../../../myDatabase2.php" ?>
<? $ro4 = new database4() ?>
<? $ro = new database2() ?>
<? if(isset($_POST['date'])) {
	$date = $_POST['date'];
}else {
	$date = date("Y-m-d");
} ?>
<? $ro4->opd_patient_census($date,$date) ?>
<? $ro4->room_list() ?>
<? $count = 1 ?>
<? $totalAdmitted = 1 ?>
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
					 <input type="text" id="date" readonly="true" value="<? echo $ro4->formatDate($date) ?>" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Patient</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<? foreach($ro4->opd_patient_census_registrationNo() as $registrationNo) { ?>
								<tr>
									<td>&nbsp;<? echo $ro->selectNow("registrationDetails","pxCount","registrationNo",$registrationNo) ?></td>
									<td>&nbsp;<? echo $ro->selectNow("patientRecord","lastName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?>, <? echo $ro->selectNow("patientRecord","firstName","patientNo",$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo)) ?></td>

									<? if($ro->selectNow("registrationDetails","mgh_date","registrationNo",$registrationNo) != "") { ?>
										<td><span class="glyphicon glyphicon-ok"></span></td>
									<? }else { ?>
										<td>&nbsp;</td>
									<? } ?>
								</tr>
							<? } ?>
						</tbody>
					</table>
				</div>

				<div class="col-md-1"></div>

				<div class="col-md-6">
					<table class="table table-hover">
						<thead>
							<th>Room</th>
							<th>Patient</th>
						</thead>
						<tbody>
							
							<? foreach($ro4->room_list_description() as $description) { ?>
								<? $ro->currentAdmittedPatient($description) ?>
								<tr>
									<td><? echo $description ?></td>
									<td><? echo $ro->currentAdmittedPatient_name() ?>
								</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>