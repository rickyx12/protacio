<?php
include("../../myDatabase1.php");
$packageName = $_GET['packageName'];
$packagePrice = $_GET['packagePrice'];
$phicPrice = $_GET['phicPrice'];

$ro = new database1();

if( $packageName == "" ) {
$ro->getBack("Pls Type the Package Name");
}else if( $packagePrice == "" ) {
$ro->getBack("Pls Type the Package Price");
}else {

echo "

<frameset cols='150%,150%' framespacing='0' border='1'>
   <frame src='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/searchCharges.php?packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='http://".$ro->getMyUrl()."/COCONUT/hospitalPackage/showAddedPackage_update.php?packageName=$packageName' />

</frameset>


";
}

?>
