<?php
include("../../myDatabase.php");

$ro = new database();

$ro->showPatient($_GET['q']);

?>
