<?php
require_once "../../authentication.php";
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$room = $_GET['room'];

$ro = new database();

$ro->getPatientProfile($registrationNo);

echo "<script src='../../js/jquery-2.1.4.min.js'></script>";
echo "<script src='../../js/open.js'></script>";

echo "

	<script>
		$('document').ready(function() {
			$('#nursing').click(function(){

				var data = {
					inventoryLocation:'NURSING',
					batchNo:'$batchNo',
					registrationNo:'$registrationNo'
				};

				open('POST','../../inventory/dept-charges.php',data,'_parent');
			});

			$('#er').click(function(){

				var data = {
					inventoryLocation:'E.R',
					batchNo:'$batchNo',
					registrationNo:'$registrationNo'
				};

				open('POST','../../inventory/dept-charges.php',data,'_parent');
			});

			$('#or').click(function(){

				var data = {
					inventoryLocation:'OR',
					batchNo:'$batchNo',
					registrationNo:'$registrationNo'
				};

				open('POST','../../inventory/dept-charges.php',data,'_parent');
			});

		});
	</script>

";

echo "
<style type='text/css'>
a {
text-decoration:none;
color:white;
}

#rowz:hover {
background-color:black;
}
body {
background-color:#3b5998;
}
</style>

";

echo "<body>";
echo "<table border=0>";
echo "<tr>";


echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' target='selectedFrame'>Charges</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=$registrationNo&username=$username&room=$username&batchNo=$batchNo' target='selectedFrame'>Doctor</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=$registrationNo&username=$username&inventoryFrom=PHARMACY&room=$room&batchNo=$batchNo' target='selectedFrame'>Medicine</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=$registrationNo&username=$username&inventoryFrom=PHARMACY&batchNo=$batchNo' target='selectedFrame'>Supplies</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/availableMisc/showMisc.php?registrationNo=$registrationNo&username=$username&inventoryFrom=PHARMACY&batchNo=$batchNo&room=$room' target='selectedFrame'>Misc</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='#' id='nursing'>NS STATION</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='#' id='er'>E.R</a>&nbsp;</td>";

echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='#' id='or'>OR</a>&nbsp;</td>";

//echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/madeUpCharges/?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' target='selectedFrame'>Other Charges</a>&nbsp;</td>";

/*
if($ro->selectNow("registrationDetails","type","registrationNo",$registrationNo)=='OPD') {
echo "<td id='rowz'>&nbsp;<img src='http://".$ro->getMyUrl()."/COCONUT/myImages/19.gif'><a href='http://".$ro->getMyUrl()."/COCONUT/dermaCharges/?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' target='selectedFrame'>Derma</a>&nbsp;</td>";
}
*/
echo "</tr>";
echo "</table>";
echo "</body>";
?>
