<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];


$ro = new database1();

$ro->getPatientProfile($registrationNo);

echo "
<style type='text/css'>

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: auto;
	width:900px;
	padding:4px 4px 4px 5px;
	font-size:20px;
}

</style>
";
?>

<script type="text/javascript">
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>
<a href="#" onClick="printF('printData')" style="text-decoration:none; color:black;"><font color=red>PRINT</font></a>
<div id='printData'>

<?

echo "<center><a href='http://".$ro->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output_doctor.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='40%;' height='20%'></a></center>";

echo "<br>";
echo "<table border=0 width='100%;'>";
echo "<Tr>";
echo "<td><b>NAME:</b> ".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<tD align='left'><b>DATE:</b> ".$ro->selectNow("radioSavedReport","date","itemNo",$itemNo)."</tD>";
echo "</tr>";

echo "<tr>";
echo "<td><b>PATIENT NO:</b>&nbsp;".$ro->getRegistrationDetails_patientNo()."</td>";
echo "<td><b>AGE:</b> ".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender()."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>PERFORMED:&nbsp;</b> ".$ro->selectNow("radioSavedReport","performed","itemNo",$itemNo)."</td>";
echo "</tr>";
echo "<tr>";
echo "<td><B>PROCEDURE:</b> ".$ro->selectNow("patientCharges","description","itemNo",$itemNo)."</td>";
echo "</tr>";
echo "</table>";
echo "</center>";

echo "<font size=4>".$ro->selectNow("radioSavedReport","radioReport","itemNo",$itemNo)."</font>";

echo "<br><br><br><br>";

echo "<u>".$ro->selectNow("radioSavedReport","physician","itemNo",$itemNo)."</u><br>&nbsp;&nbsp;&nbsp;".$ro->selectNow("Doctors","Specialization1","Name",$ro->selectNow("radioSavedReport","physician","itemNo",$itemNo))."";

//$ro->coconutButton("Proceed");
$ro->coconutFormStop();

?>
</div>
