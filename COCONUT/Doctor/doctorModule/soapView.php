<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();

?>
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<?php
$ro->getSOAP($itemNo,$registrationNo);
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
echo "<form method='get' action='editSoap.php'>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<br><center><font size=2><b>Doctor:</b>".$ro->soap_description()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Service:</b>".$ro->soap_service()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Date Created:</b>".$ro->soap_date()."</font><center><div style='border:1px solid #000000; width:600px; height:485px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font size=4 color=red>S</font><font size=3>ubjective</font><br><textarea name='subjective' class='txtArea'>".$ro->soap_subjective()."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>O</font><font size=3>bjective</font><br><textarea name='objective' class='txtArea'>".$ro->soap_objective()."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>A</font><font size=3>ssessment</font><br><textarea name='assessment' class='txtArea'>".$ro->soap_assessment()."</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=4 color=red>P</font><font size=3>lan</font><br><textarea name='plan' class='txtArea'>".$ro->soap_plan()."</textarea></td>";
echo "</tr>";
echo "</table>";
echo "<br>";
if($username != "") {
echo "<input type=submit value='Edit'>";
}else {
echo "";
}
echo "</div>";
echo "</form>";
