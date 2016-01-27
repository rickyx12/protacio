<?php
include("../../../myDatabase.php");
$icdCode = $_GET['icdCode'];
$diagnosis = $_GET['diagnosis'];
$icdNo = $_GET['icdNo'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<br><br><br><Br><br>";

echo "<form method='get' action='deleteICD.php'>";
echo "<input type=hidden name='icdNo' value='$icdNo'>";
echo "<input type=hidden name='icdCode' value='$icdCode'>";
echo "<center><div style='border:1px solid #ff0000; width:400px; height:120px;	'>";
echo "<br><font size=2 color=red>Are you sure you want to delete the ICD Code<br>$icdCode  </font>";
echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";
?>
