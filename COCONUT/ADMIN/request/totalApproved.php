<?php
include("../../../storedProcedure.php");
$date = $_POST['date'];
$ro = new storedProcedure();

$ro->adminApproved($date);

?>
