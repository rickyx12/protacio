<?php
include "../../myDatabase.php";

$ro = new database();

$ro->deleteNow("ipdCensus","id",$_POST['id']);

//header("Location: addToCensus.php?registrationNo=$_GET[registrationNo]");


?>