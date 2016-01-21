<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$itemNo = $_GET['itemNo'];
$templateNo = $_GET['templateNo'];
$template = $_GET['template'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);

/*
if(isset($_GET['submit']))
{

$result = $_GET['result'];

addLaboratoryResultInPatient($registrationNo,$itemNo,$chargesCode,$medtech,$date,$result);

}
*/

echo "<script type='text/javascript' src='/ckeditor/ckeditor.js'></script>";

echo "<br>";
echo "<center><font size=4><b>PAGADIAN CITY MEDICAL CENTER</b></font></center>";
echo "<center><b><font size=3><b>LABORATORY DEPARTMENT</b></font></b></center>";
echo "<center><font size=3>Cabrera St., Pagadian City</font></center>";
echo "<center><font size=3>Tel No. 062-2143237</font></center>";
echo "<br><br>";
echo "<center>";

echo "<table border=0 cellspacing=0 cellpadding=1 width='100%' >";
echo "<tr>";
echo "<td>&nbsp;<b>Name:</b>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<td>&nbsp;<b>Age/Sex:</b>&nbsp;".$ro->getPatientRecord_Age()."/".$ro->getPatientRecord_gender()."</td>";
echo "<Td>&nbsp;<b>Date:</b>&nbsp;".date("M d, Y")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b>D.O.B:</b>&nbsp;".$ro->getPatientRecord_birthDate()."</td>";
echo "<Td>&nbsp;<b>WARD:</b>&nbsp;".$ro->getRegistrationDetails_type()."</td>";
echo "</tr>";

echo "</table>";

echo "<Br><br>";


$ro->coconutFormStart("POST","addLabToPatient.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("date",date("M_d_Y"));
echo "<textarea id='result' name='result'>".$ro->selectNow("labResultList","template","templateNo",$templateNo)."</textarea>";

$ro->coconutFormStop();
?>


<script type="text/javascript">
			
			CKEDITOR.replace( 'result',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

</script>
