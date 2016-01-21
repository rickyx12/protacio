<?php
include("../../../myDatabase.php");
$icdCode = $_GET['icdCode'];
$diagnosis = $_GET['diagnosis'];
$icdNo = $_GET['icdNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();


?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />
<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS1.css" />


<?php

echo "<form method='get' action='editICD1.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='icdNo' value='$icdNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<Br>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:auto; border-color:black black black black;'>";
echo "<br>";

echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Td><font class='labelz'>ICD Code&nbsp;&nbsp;	</font></tD>";
echo "<td><input type=text name='icdCode' value='$icdCode' class='txtBox'></td>";
echo "</tr>";
echo "<tr>";
echo "<Td><font class='labelz' name='diagnosis'>Diagnosis&nbsp;&nbsp;	</font></tD>";
echo "<td><textArea name='diagnosis' class='txtAreaBig'>$diagnosis</textArea></td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "<input type=submit value='Proceed'>";
echo "<div>";
echo "</form>";

?>
