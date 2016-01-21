<?php
include("../../myDatabase2.php");
$ptNotesNo = $_GET['ptNotesNo'];
$ro = new database2();

$ro->editNow("ptNotes","ptNotesNo",$ptNotesNo,"status","DELETED_".date("Y-m-d")."@".date("H:i:s"));


?>
