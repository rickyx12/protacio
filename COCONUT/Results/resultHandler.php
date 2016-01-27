<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();


echo "

<frameset cols='75%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/Results/laboratoryResult_list.php?registrationNo=$registrationNo&username=$username'  scrolling=yes frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/Department/departmentPage.php'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
