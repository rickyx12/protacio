<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$radioNo = $_GET['radioNo'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<br><br><br><Br><br>";

echo "<form method='get' action='deleteRadioNow.php'>";
echo "<input type=hidden name='radioNo' value='$radioNo'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<center><div style='border:1px solid #ff0000; width:400px; height:120px;	'>";
echo "<br><font size=2 color=red>Are you sure you want to delete the result of<br>$description  </font>";
echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";
?>
