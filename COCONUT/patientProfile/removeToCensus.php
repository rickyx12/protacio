<?php
include "../../myDatabase.php";

$ro = new database();

$ro->deleteNow("ipdCensus","registrationNo",$_GET['registrationNo']);

header("Location: addToCensus.php?registrationNo=$_GET[registrationNo]");


?>