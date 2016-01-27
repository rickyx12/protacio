<?php
include("../../../myDatabase.php");

$ro = new database();

echo "

<frameset cols='150%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/masterfile/masterListPackage.php'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='#' name='selection1' />

</frameset>


";


?>
