<?php
include "../../myDatabase.php";
include "../../myDatabase4.php";

echo "<script src='../../jquery.js'></script>";


echo "
<script>
	$(document).ready(function() {
		$('#censusBtn').click(function() {
			location.reload();
		});
	});
</script>

";

$ro = new database();
$ro4 = new database4();

$ro->coconutDesign();
$ro4->census_list_patient($_GET['registrationNo']);

echo "<form method='get' action='addToCensus.php'>";
echo "<br>";
echo "<center>";
echo "<font color=red>Census Date</font><br><br>";
$ro->coconutHidden("registrationNo",$_GET['registrationNo']);
$ro->coconutHidden("room",$ro->selectNow("registrationDetails","room","registrationNo",$_GET['registrationNo']));
$ro->coconutTextBox("datez",date("Y-m-d"));
echo "<br><br>";
echo "<input id='censusBtn' type='submit' value='Proceed'>";
echo "</form>";
echo "</center>";


if( isset($_GET['room']) ) {

	$myData = array(

		"registrationNo" => $_GET['registrationNo'],
		"room" => $_GET['room'],
		"date" => $_GET['datez']

	);

	$ro4->insertNow("ipdCensus",$myData);
	echo "<center>Patient Added</center>";

}

echo "<br>";
?>

<!doctype html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>		

		<script>
			$(document).ready(function() {

				<? foreach( $ro4->census_list_patient_id() as $id ) { ?>
					$(document).on("click","#remove<? echo $id ?>",function() {
						var id = <? echo $id ?>+"";
						//console.log(registrationNo);
						$.post("removeToCensus.php",{id:id},function() {
							location.reload();
						});
					});
				<? } ?>

			});
		</script>

	</head>
	<body>
		<div class="container">
			<div class="col-md-3">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>&nbsp</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->census_list_patient_id() as $id ) { ?>
							<tr>
								<td><? echo $ro4->formatDate($ro->selectNow("ipdCensus","date","id",$id)) ?></td>
								<td><input type="button" id="remove<? echo $id ?>" class="btn btn-danger" value="Remove"></td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>