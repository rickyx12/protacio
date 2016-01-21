<?php
include("../../myDatabase.php");


$ro = new database();

echo "<Br><Br><Br><br><br>";
$ro->coconutBoxStart("750","80");
echo "<br>";
echo "<img src='angry.jpeg'>&nbsp;&nbsp;<font color=reD>Pls Change the <b>TYPE</b> of patient to <b>IPD</b> before you can print an admission slip.</font>";

$ro->coconutBoxStop();

?>
