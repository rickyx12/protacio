<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];


$ro = new database();

echo "

<frameset cols='105%,210%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/doctor/newPlan.php?registrationNo=$registrationNo'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/android/doctor/planPreview_update.php?registrationNo=$registrationNo'  scrolling=yes frameborder=1 framespacing=1 name='rightFrame' />

</frameset>


";

?>
