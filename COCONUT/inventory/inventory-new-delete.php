<?php
include "../../myDatabase.php";
session_start();
$ro = new database();

$ro->editNow("inventory","inventoryCode",$_POST['inventoryCode'],"status","DELETED_".$_SESSION['username']."@".date("Y-m-d"));

?>