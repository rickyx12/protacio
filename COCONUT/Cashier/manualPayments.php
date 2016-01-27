<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<Br><center><font size=1>Manual Payments (OTHER'S)</font><br><div style='border:1px solid #000000; width:500px; height:180px; border-color:black black black black;'>";
echo "<br>";
echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Description&nbsp;</font></td>";
echo "<td><input type=text name='description' class='txtBox'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Amount&nbsp;</font></td>";
echo "<td><input type=text name='amount' class='shortField'></td>";
echo "</tr>";
echo "</table>";

echo "</div>";

?>
