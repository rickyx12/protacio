<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$ro = new database1();
$ro->coconutDesign();

echo "
<style type='text/css'>

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 380px;
	width: 690px;
	padding:4px 4px 4px 5px;
	font-size:15px;
}

</style>
";
echo "<br>";
echo "<b>".$ro->selectNow("patientCharges","description","itemNo",$itemNo)."</b>";

echo "<br><Br>";
echo "<b><b>";


$ro->coconutFormStart("get","addMisc1.php");
$ro->coconutHidden("examName",$ro->selectNow("patientCharges","description","itemNo",$itemNo));
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("username",$username);

echo "<textarea name='examResult' class='txtArea'></textarea>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();


?>
