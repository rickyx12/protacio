<?php
include("../../convenienceDB.php");
$username = $_POST['username'];
$ro = new convenienceDB();

$ro->getInventoryList($username);


?>
