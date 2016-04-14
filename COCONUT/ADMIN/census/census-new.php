<? include "../../../myDatabase4.php" ?>
<? $ro4 = new database4() ?>
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
				<div class="col-md-6">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Patient</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<? for($a=0,$b=0,$c=0;$a<count($ro4->opd_patient_census_firstName()),$b<count($ro4->opd_patient_census_lastName()),$c< count($ro4->opd_patient_census_registrationNo());$a++,$b++,$c++) { ?>
								<tr>
									<? $totalRevenue += $ro4->patient_with_transaction_total($ro4->opd_patient_census_registrationNo()[$c]) ?>
									<td><? echo $count++ ?></td>
									<td><? echo $ro4->opd_patient_census_lastName()[$b] ?>, <? echo $ro4->opd_patient_census_firstName()[$a] ?></td>
									<td><? ($ro4->patient_with_transaction_total($ro4->opd_patient_census_registrationNo()[$c]) > 0) ? $print = number_format($ro4->patient_with_transaction_total($ro4->opd_patient_census_registrationNo()[$c]),2) : $print = ""; echo $print ?></td>
								</tr>

							<? } ?>
						</tbody>
						<tbody>
							<tr>
								<td>Px</td>
								<td><? echo ($count-1) ?></td>
								<td><? echo number_format($totalRevenue,2) ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>