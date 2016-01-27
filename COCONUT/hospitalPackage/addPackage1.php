<?php
include("../../myDatabase1.php");
$packageName = $_GET['packageName'];

$ro = new database1();

if( $packageName == "" ) {
$ro->getBack("Pls Type the Package Name");
}else {

echo "

<frameset cols='150%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/searchCharges.php?packageName=$packageName'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/showAddedPackage_update.php?packageName=$packageName' />

</frameset>


";
}

?>
