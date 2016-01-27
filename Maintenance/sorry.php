<?php
include("../myDatabase.php");

$ro = new database();
$ro->coconutDesign();


echo "<Br><Br><Br><BR><Br><center>";

//echo "<img src='http://".$ro->getMyUrl()."/Maintenance/section_Under_Construction.png'>";

$ro->coconutBoxStart("600","100");
echo "<Br><center>";
echo " <img src='http://".$ro->getMyUrl()."/Maintenance/sorry.jpeg'> &nbsp;&nbsp;<font color=red>THIS SECTION IS UNDER CONSTRUCTION</font>";

$ro->coconutBoxStop();

?>
