<?php
include("../../myDatabase1.php");
$module = $_GET['module'];
$username = $_GET['username'];
$ro = new database1();


echo "<br><Br><Br><br><Br>";
$ro->coconutBoxStart("400","100");
echo "<br>";
echo "<center><font size=2>For Receiving in $module</font>
<br>";

if($ro->getReceivingRequest($module,"Pagadian") > 0) { echo "<br><a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/receivingRequest.php?module=$module&username=$username&branch=Pagadian' style='text-decoration:none;'><font color=red>(".$ro->getReceivingRequest($module,"Pagadian").") Receiving Found</font></a>";  }else { echo ""; }

echo "</center>";
$ro->coconutBoxStop();

?>
