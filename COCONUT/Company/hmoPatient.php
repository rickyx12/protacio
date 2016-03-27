<?php
include "../../myDatabase4.php"; 
include "../../myDatabase.php";

$ro = new database4();
$ro1 = new database();
$reportDate;

if(isset($_POST["date"])) {
$reportDate = $_POST["date"];
}else {
$reportDate = "2016-03-02";
}



?>
<!doctype html>
<html>
	<head>
		<title>HMO SHIFTING</title>
		<script language="javascript" src="../js/jquery-2.1.4.min.js"></script>
		<script langugae="javascript" src="../js/jquery-ui.min.js"></script>
		<script language="javascript" src="../../bootstrap-3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.theme.min.css"></link>
		<style>
			#patientName {
				text-decoration: none;
				color:black;
			}
		</style>
		<script>
			$(document).ready(function() {
				$("#patient").load("hmoPatient_table.php");


				$("#fromDate").datepicker({
					dateFormat:'yy-mm-dd',
					onSelect:function(dateText) {
					
							$("#patient").load("hmoPatient_table.php",{date:dateText},function() {
								alert("Date Change");
							});
						
					}
				})
			});
		</script>

	</head>
	<body>
	<div class="container">
		<?php $ro->get_hmo_patient($reportDate,$reportDate) ?>
		<div class="col-md-10">
		<h4>Patient w/ HMO</h4>
		<div class="col-md-3">
			<input type="text" class="form-control" id="fromDate" value="<?php echo $reportDate ?>">
			<div id="patient" class="col-md-10">
			<br><Br>
			
				<img src="../myImages/heartLoading.gif" style="height:100%; width: 100%;">
			

			</div>
		</div>
	</div>
	</body>
</html>