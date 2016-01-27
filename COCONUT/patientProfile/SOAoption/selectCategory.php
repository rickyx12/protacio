<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<form method='get' action='byCategory.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<br><center><div style='border:1px solid #000000; width:495px; height:auto; border-color:black black black black;'>";
echo "<Br>";
echo "<Table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<tD><font class='labelz'>Category&nbsp;</font></td>";
echo "<Td>";
echo "<select class='comboBox' name='category'>";
$ro->showOption("Category","Category");
echo "</select>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white;' >";
echo "</form>";
echo "</div>";


?>
