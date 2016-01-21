<?php
include("../../../myDatabase2.php");
$doctorCode = $_GET['doctorCode'];
$username = $_GET['username'];
$ro = new database2();
$ro->coconutDesign();
echo "<link rel='stylesheet' type='text/css' href='../css/default.css' />";

echo "
<center>
<header class='clearfix' style='margin:15px;'>
<span>Synapse System</span>
</header>
";
echo "<div style='background:#47a3da; margin:10px; height:auto; width:250px; border-radius:15px;' >";
echo "<Br>";
echo "<table border='0' width='150px;'>";
echo "<tr>
<th><font color='white' size=4>Name</font></th>
</tr>";
$ro->androidViewPatient($doctorCode);
echo "</table>";
echo "</div>";
echo "<br>
<a href='http://".$ro->getMyUrl()."/COCONUT/android/doctor/doctorInterface.php?username=$username&doctorCode=$doctorCode' style='text-decoration:none; color:#47a3da;' target='_parent'>Back To Menu</a>";

?>
