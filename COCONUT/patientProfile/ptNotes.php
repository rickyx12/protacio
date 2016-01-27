<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();
$ro->getPatientProfile($registrationNo);
?>


<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "
<style type='text/css'>

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 80px;
	width: 470px;
	padding:4px 4px 4px 5px;
}

</style>
";
echo "<form method='get' action='ptNotes_insert.php'>";
echo "<input type=hidden name='patientNo' value='".$ro->getRegistrationDetails_patientNo()."'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><center><font size=2></font><center><div style='border:1px solid #000000; width:600px; height:485px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font size=4 color=red>S</font><font size=3>ubjective</font><br><textarea name='subjective' class='txtArea'></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>O</font><font size=3>bjective</font><br><textarea name='objective' class='txtArea'></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>A</font><font size=3>ssessment</font><br><textarea name='assessment' class='txtArea'></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>P</font><font size=3>lan</font><br><textarea name='plan' class='txtArea'></textarea></td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<input type=submit value='Proceed'>";
echo "</div>";
echo "</form>";


?>
