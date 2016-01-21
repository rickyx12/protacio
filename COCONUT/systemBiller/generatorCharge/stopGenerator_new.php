<?php
include("../../../myDatabase2.php");
$chargeNo = $_GET['chargeNo'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("generatorCharge","chargeNo",$chargeNo,"dateStop", $ro->selectNow("generatorCharge","dateStart","chargeNo",$chargeNo) );
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"timeStop",date("H:i:s"));
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"user",$username);
$ro->editNow("generatorCharge","chargeNo",$chargeNo,"status","off");

//$start = new DateTime( $ro->selectNow("generatorCharge","timeStart","dateStart",$dateStarted) );
//$stop =  new DateTime( $ro->selectNow("generatorCharge","timeStop","dateStart",$dateStarted) );

$to_time = strtotime($ro->selectNow("generatorCharge","dateStop","chargeNo",$chargeNo)." ".$ro->selectNow("generatorCharge","timeStop","chargeNo",$chargeNo));

$from_time = strtotime($ro->selectNow("generatorCharge","dateStart","chargeNo",$chargeNo)." ".$ro->selectNow("generatorCharge","timeStart","chargeNo",$chargeNo));


//$diff = $start->diff( $stop );

//echo round(abs($to_time - $from_time) / 60,2). " minute";

$totalHrs = ( round(abs($to_time - $from_time) / 60) );

//$totalHrs = round($diff->format( '%H:%I:%S' ));

//echo " Generator Stop<br>Total  ".$totalHrs;

$ro->editNow("generatorCharge","chargeNo",$chargeNo,"hours",$totalHrs);
$datez = preg_split ("/\-/", $ro->selectNow("generatorCharge","dateStart","chargeNo",$chargeNo) ); 
header("Location: /COCONUT/systemBiller/generatorCharge/showList.php?month=$datez[1]&day=$datez[2]&year=$datez[0]&username=$username");

?>
