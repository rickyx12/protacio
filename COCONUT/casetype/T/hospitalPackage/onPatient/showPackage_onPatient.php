<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

echo "

<frameset cols='150%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/onPatient/showPackage.php?registrationNo=$registrationNo&username=$username'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='#' name='selection1' />

</frameset>


";


?>
