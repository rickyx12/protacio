<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);
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
<a href="#" onClick="printF('printData')" style="text-decoration:none; color:black;">PRINT</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<!-----
<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/resultList/deleteResult.php?registrationNo=<?php echo $registrationNo; ?>&itemNo=<?php echo $itemNo; ?>" style="text-decoration:none; color:Red;">DELETE</a>
//-->



<div id='printData'>

<?
echo "<script type='text/javascript' src='/ckeditor/ckeditor.js'></script>";

echo "<style type='text/css'>";

echo "

.linez{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 300px;
	font-weight:bold;
	border-color:white white black white;
	font-size:15px;

}

";

echo "</style>";

//echo "<br>";
//echo "<center><font size=4><b>MENDERO MEDICAL CENTER</b></font></center>";
//echo "<center><b><font size=3><b>LABORATORY DEPARTMENT</b></font></b></center>";
//echo "<center><font size=3>Consolacion, Cebu City</font></center>";
//echo "<center><font size=3>Tel No. 062-2143237</font></center>";
echo "<br><br><br><Br><br><Br><Br><Br>";
echo "<center>";
echo "<table border=0 cellspacing=0 cellpadding=1 width='100%' >";

echo "<tr>";
echo "<td><B>Patient ID:</b></td>";
echo "<td><input type='text' class='linez' value='".$ro->getRegistrationDetails_patientNo()."'></td>";
echo "<td><B>Date:</b></td>";
echo "<td><input type='text' class='linez' value='".$ro->selectNow("labSavedResult","date","itemNo",$itemNo)."@".$ro->selectNow("labSavedResult","time","itemNo",$itemNo)."'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>Name:</b></td>";
echo "<td><input type='text' class='linez' value='".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName()."'></td>";
echo "<td><b>Age/Sex:</b></td>";
echo "<td><input type='text' class='linez' value='".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender()."'></td>";
echo "</tr>";

echo "<tr>";
echo "<Td><b>Date of Birth:</td>";
echo "<td></b><input type='text' class='linez' value='".$ro->getPatientRecord_birthDate()."'></tD>";
echo "<td><b>Status:</td>";
echo "<td></b><input type='text' class='linez' value='".$ro->getPatientRecord_civilStatus()."'></tD>";
echo "</tr>";

echo "<tr>";
echo "<Td><b>Physician:</b></td>";
echo "<td><input type='text' class='linez' value='".$ro->getAttendingDoc($registrationNo,"ATTENDING")."'></tD>";
echo "<Td><b>Room:</b></td>";
echo "<td> <input type='text' class='linez' value='".$ro->getRegistrationDetails_room()."'></tD>";
echo "</tr>";

echo "</table>";

echo "</center>";
echo "<Br>";
echo "<center>";
echo $ro->ENCRYPT_DECRYPT($ro->doubleSelectNow_notDeleted("labSavedResult","result","itemNo",$itemNo,"registrationNo",$registrationNo));
echo "</center>";
if( $ro->selectNow("labSavedResult","morphology","itemNo",$itemNo) != "" ) {
echo "<b>Morphology:&nbsp;</b>".$ro->selectNow("labSavedResult","morphology","itemNo",$itemNo);
}else { }
echo "<Br>";

if( $ro->selectNow("labSavedResult","remarks","itemNo",$itemNo) != "" ) {
echo "<b>Remarks:&nbsp;</b>".$ro->selectNow("labSavedResult","remarks","itemNo",$itemNo);
}else { }

/*
echo "<br><BR>";
echo "<table border=0 cellpadding=1 width='100%' cellspacing=0>";
echo "<tr>";
echo "<td>&nbsp;DR.IRENE B. USON</tD>";
echo "<td>&nbsp;".$ro->getMedtechName($ro->selectNow("labSavedResult","medtech","itemNo",$itemNo,"registrationNo",$registrationNo))."</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;Pathologist</td>";
echo "<td>&nbsp;Medical Technologist</td>";
echo "</tr>";
*/
//echo "</table>";

?>
</div>

