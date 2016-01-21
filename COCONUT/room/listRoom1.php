<?php
include("../../myDatabase.php");
$ro = new database();
$ro->coconutAjax("9000","http://".$ro->getMyUrl()."/COCONUT/room/listRoom.php");
?>
