<?php
include("../../myDatabase.php");
$type = $_GET['type'];
$branch = $_GET['branch'];

$ro = new database();
echo "<br><centeR><font size=2 color=red>Pls. Change the Type of Patient as OPD or IPD once the patient is not in the $type anymore</font><br><a href='http://".$ro->getMyUrl()."/COCONUT/opdRegistration.php' target='_blank'><font size=2>Branch:&nbsp;$branch</font></a>";

$ro->getPatientSpecialroom($type,$branch);

?>
