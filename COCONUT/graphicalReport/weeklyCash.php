<?php include "../../myDatabase3.php"; 
$fromMonth = $_GET['fromMonth'];
$fromYear = $_GET['fromYear'];
$ro = new database3(); 


$ipdWeek1 = $ro->getCashPaidChart_ipd("".$fromYear."-".$fromMonth."-01","".$fromYear."-".$fromMonth."-07");
$ipdWeek2 = $ro->getCashPaidChart_ipd("".$fromYear."-".$fromMonth."-08","".$fromYear."-".$fromMonth."-14");
$ipdWeek3 = $ro->getCashPaidChart_ipd("".$fromYear."-".$fromMonth."-15","".$fromYear."-".$fromMonth."-21");
$ipdWeek4 = $ro->getCashPaidChart_ipd("".$fromYear."-".$fromMonth."-22","".$fromYear."-".$fromMonth."-31");

$opdWeek1 = ($ro->getCashPaidChart_opd("cashPaid","".$fromYear."-".$fromMonth."-01","".$fromYear."-".$fromMonth."-07") + $ro->getCashPaidChart_opd("amountPaidFromCreditCard","".$fromYear."-".$fromMonth."-01","".$fromYear."-".$fromMonth."-07"));
$opdWeek2 = ($ro->getCashPaidChart_opd("cashPaid","".$fromYear."-".$fromMonth."-08","".$fromYear."-".$fromMonth."-14") + $ro->getCashPaidChart_opd("amountPaidFromCreditCard","".$fromYear."-".$fromMonth."-08","".$fromYear."-".$fromMonth."-14"));
$opdWeek3 = ($ro->getCashPaidChart_opd("cashPaid","".$fromYear."-".$fromMonth."-15","2016-02-21") + $ro->getCashPaidChart_opd("amountPaidFromCreditCard","".$fromYear."-".$fromMonth."-15","".$fromYear."-".$fromMonth."-21"));
$opdWeek4 = ($ro->getCashPaidChart_opd("cashPaid","".$fromYear."-".$fromMonth."-22","".$fromYear."-".$fromMonth."-31") + $ro->getCashPaidChart_opd("amountPaidFromCreditCard","".$fromYear."-".$fromMonth."-22","".$fromYear."-".$fromMonth."-31"));

$month = ['01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'];


echo $month[$fromMonth]." ".$fromYear;


?>
<!doctype html>
<html>
	<head>
		<title>Weekly Census</title>
		<script src="../../ChartJS/Chart.js"></script>
	</head>
	<body>
		<div style="width: 80%">
			<canvas id="canvas" height="300" width="600"></canvas>
		</div>


	<script>
	var ipdWeek1 = <?php echo $ipdWeek1; ?>;
	var ipdWeek2 = <?php echo $ipdWeek2; ?>;	
	var ipdWeek3 = <?php echo $ipdWeek3; ?>;
	var ipdWeek4 = <?php echo $ipdWeek4; ?>;	

	var opdWeek1 = <?php echo $opdWeek1; ?>;
	var opdWeek2 = <?php echo $opdWeek2; ?>;
	var opdWeek3 = <?php echo $opdWeek3  ?>;
	var opdWeek4 = <?php echo $opdWeek4  ?>;

	var barChartData = {
		labels : ["Week 1","Week 2","Week 3","Week 4"],
		datasets : [
			{	label: "IPD",
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [ipdWeek1,ipdWeek2,ipdWeek3,ipdWeek4]
			},
			{
				label: "OPD",
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [opdWeek1,opdWeek2,opdWeek3,opdWeek4]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true,
			barValueSpacing : 50,
			multiTooltipTemplate: "<%= datasetLabel %> - <%= value.toLocaleString() %>",
		});
	}
	</script>
	</body>
</html>
