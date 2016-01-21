<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo =  $_GET['registrationNo'];
$description = $_GET['description'];
$radiologist = $_GET['radiologist'];
$medTech = $_GET['medTech'];
$branch = $_GET['branch'];
$receivedMonth = $_GET['receivedMonth'];
$receivedDay = $_GET['receivedDay'];
$receivedYear = $_GET['receivedYear'];
$releasedMonth = $_GET['releasedMonth'];
$releasedDay = $_GET['releasedDay'];
$releasedYear = $_GET['releasedYear'];
$ro = new database();

?>


<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "
<style type='text/css'>

.impression {
	border: 1px solid #000;
	color: #000;
	height: 390px;
	width: 450px;
}

</style>

";
echo "<form method='get' action='result_insert.php'>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<input type=hidden name='radiologist' value='$radiologist'>";
echo "<input type=hidden name='medTech' value='$medTech'>";
echo "<input type=hidden name='branch' value='$branch'>";
echo "<input type=hidden name='receivedMonth' value='$receivedMonth'>";
echo "<input type=hidden name='receivedDay' value='$receivedDay'>";
echo "<input type=hidden name='receivedYear' value='$receivedYear'>";
echo "<input type=hidden name='releasedMonth' value='$releasedMonth'>";
echo "<input type=hidden name='releasedDay' value='$releasedDay'>";
echo "<input type=hidden name='releasedYear' value='$releasedYear'>";

echo "<br><center><font size=4>Impression ($description)</font><center><div style='border:1px solid #000000; width:600px; height:440px; border-color:black black black black;'>";
echo "<br>";
echo "<textarea name='impression' class='impression' ></textarea>";
echo "<br><br>";
echo "<input type=submit value='Proceed'>";
echo "</div>";
echo "</form>";

?>
