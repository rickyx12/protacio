<?php
include("../../myDatabase.php");

$ro = new database();

$ro->showPatient_walkIn($_GET['q']);

?>
