<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$protoType = $_GET['protoType']; // kpg maintenance ippkta ung "edit" at "delete" if not "add ICD" 
$registrationNo = $_GET['registrationNo']; // accesories Lng pra kung mag aadd ng icd code ang patient


$ro = new database();

$ro->getMasterListICDcode($show,$desc,$protoType,$registrationNo,$username);

?>
