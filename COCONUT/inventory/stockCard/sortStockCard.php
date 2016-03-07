<?php
include("../../../myDatabase.php");

$ro = new database();
$ro->coconutDesign();

echo "<br><br><br><br>";
echo "<center><font size=2 color=blue>Generic Name Start with letter</font></center>";
$ro->coconutBoxStart("600","70");
echo "<Br>";

$startLetter = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

for($x=0;$x<=24;$x++) {
echo "<a href='stockCardList.php?startLetter=".$startLetter[$x]."' style='text-decoration:none; color:red;'>".$startLetter[$x]."</a>&nbsp;&nbsp;";
}

$ro->coconutBoxStop();

?>
