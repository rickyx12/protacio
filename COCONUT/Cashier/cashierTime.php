<?php
include("../../myDatabase.php");

$ro = new database();

?>

<script src="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/serverTime/serverTime.js"></script>

<?php

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

echo "<body onload='DisplayTime();'>";
echo "<p id='curTime'></p>";
echo "</body>";
$currentTime = (date("H")+15).":".date("i:s");
//echo "TOTAL".($ro->getItemNo_total("110") - 10);

echo "".date("H:i:s");
?>
