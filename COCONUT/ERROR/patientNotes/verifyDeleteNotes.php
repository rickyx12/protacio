<?php
include("../../myDatabase.php");
$noteNo = $_GET['noteNo'];
$noteBy = $_GET['noteBy'];
$noteType = $_GET['noteType'];
$date = $_GET['date'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();
$ro->coconutDesign();
?>



<?php

echo "<br><br><br><Br><br>";

echo "<form method='get' action='deleteNotes.php'>";
$ro->coconutHidden("noteNo",$noteNo);
$ro->coconutHidden("noteType",$noteType);
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<center><div style='border:1px solid #ff0000; width:400px; height:120px;	'>";
echo "<br><font size=2 color=red>Are you sure you want to delete the $noteType of $noteBy in $date</font>";
echo "<br><Br><input type=submit value='Yes' style='border:1px solid #ff0000; background-color:transparent;'>";
echo "</div>";
echo "</form>";
?>
