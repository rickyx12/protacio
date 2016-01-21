<?php
include("../../myDatabase3.php");
$cols = $_GET['cols'];
$date = $_GET['date'];
$date1 = $_GET['date1'];
$title = $_GET['title'];
$ro = new database3();

if( $cols == "cashUnpaid" ) {
$ro->transactionSummary_getPatient_cash($date,$date1,$title);
}else if( $cols == "hmo" ) {
$ro->transactionSummary_getPatient_hmo($date,$date1,$title);
}
else { }



?>
