<?php
include("../../../myDatabase.php");
$limitNo = $_GET['limitNo'];
$registrationNo = $_GET['registrationNo'];
$limitTo = $_GET['limitTo'];
$username = $_GET['username'];


$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<br><br><br><Br><br>";

echo "<form method='get' action='deleteCreditLimit.php'>";
echo "<input type=hidden name='limitNo' value='$limitNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<center><div style='border:1px solid #ff0000; width:400px; height:120px;	'>";
echo "<br><font size=2 color=red>Are you sure you want to delete the Credit Limit for<br>$limitTo  </font>";
echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";
?>
