<?php
include("../myDatabase1.php");


$ro = new database();
$ro->coconutDesign();

echo "<center><br><br><br><br><Br>";

$ro->coconutBoxStart_red("600","180");
echo "<br><br><br><center>";
echo " The Patient was registered a while ago. this can be resulted to <br> <font color=red>Double Encoding in Census Report</font>. ";
echo "<br><Br>";

echo "  <input type='button' value='<< Back To Registration' onclick='history.go(-1)' style='border:1px solid #ff0000; background-color:transparent; height:40px; ' > ";

$ro->coconutBoxStop();

echo "</center>";

?>