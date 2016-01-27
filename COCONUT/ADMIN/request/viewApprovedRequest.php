<?php
include("../../../storedProcedure.php");
$username = $_GET['username'];
$date = $_GET['date'];
$ro = new storedProcedure();

$ro->showApprovedRequest($date,$username);

?>
