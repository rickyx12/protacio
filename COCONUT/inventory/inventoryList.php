<?php
include("../../myDatabase3.php");

$ro = new database3();

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?

$ro->inventoryListToExcel("medicine");

?>
