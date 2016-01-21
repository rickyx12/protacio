<?php
include("../../../myDatabase1.php");
$reports = $_POST['reports'];
$itemNo = $_POST['itemNo'];
$registrationNo = $_POST['registrationNo'];
$description = $_POST['description'];

$ro = new database1();

?>


<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<?php

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
$ro->getPatientProfile($registrationNo);
$ro->coconutFormStart("get","radioReport_update.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
echo "<table border=0 width='160%'>";
echo "<tr>";
echo "<td><b>Name:</b>&nbsp;".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<td><b>Date:</b>&nbsp;".$ro->selectNow("radioSavedReport","date","itemNo",$itemNo)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>Age/Sex</b>&nbsp;".$ro->getPatientRecord_age()."/".$ro->getPatientRecord_gender()."</td>";
echo "<td>Physician:&nbsp;<b>".$ro->selectNow("radioSavedReport","physician","itemNo",$itemNo)."</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td><b>Room:</b>&nbsp;".$ro->getRegistrationDetails_room()."</td>";
echo "<td>Examination:&nbsp;<b>$description</b></td>";
echo "</tr>";

echo "</table>";


echo "<textarea id='report' name='radioReport' class='txtArea'>"; 
echo $ro->doubleSelectNow("radioSavedReport","radioReport","registrationNo",$registrationNo,"itemNo",$itemNo);
echo"</textarea>";

echo "<br><br>";
$ro->coconutButton("edit");
$ro->coconutFormStop();

?>


<script type="text/javascript">
			
			CKEDITOR.replace( 'report',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

</script>

