<?php
include("../../../myDatabase2.php");
$dateStarted = $_GET['dateStarted'];
$username = $_GET['username'];

$ro = new database2();

$ro->editNow("generatorCharge","dateStart",$dateStarted,"dateStop",$dateStarted);
$ro->editNow("generatorCharge","dateStart",$dateStarted,"timeStop",date("H:i:s"));
$ro->editNow("generatorCharge","dateStart",$dateStarted,"user",$username);
$ro->editNow("generatorCharge","dateStart",$dateStarted,"status","off");

//$start = new DateTime( $ro->selectNow("generatorCharge","timeStart","dateStart",$dateStarted) );
//$stop =  new DateTime( $ro->selectNow("generatorCharge","timeStop","dateStart",$dateStarted) );

$to_time = strtotime($ro->selectNow("generatorCharge","dateStop","dateStart",$dateStarted)." ".$ro->selectNow("generatorCharge","timeStop","dateStart",$dateStarted));

$from_time = strtotime($ro->selectNow("generatorCharge","dateStart","dateStart",$dateStarted)." ".$ro->selectNow("generatorCharge","timeStart","dateStart",$dateStarted));


//$diff = $start->diff( $stop );

//echo round(abs($to_time - $from_time) / 60,2). " minute";

$totalHrs = ( round(abs($to_time - $from_time) / 60) );

//$totalHrs = round($diff->format( '%H:%I:%S' ));

//echo " Generator Stop<br>Total  ".$totalHrs;

$ro->editNow("generatorCharge","dateStart",$dateStarted,"hours",$totalHrs);
$datez = preg_split ("/\-/", $dateStarted ); 
header("Location: /COCONUT/systemBiller/generatorCharge/showList.php?month=$datez[1]&day=$datez[2]&year=$datez[0]&username=$username");

?>
