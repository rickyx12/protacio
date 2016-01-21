<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$room = $_GET['roomz'];
$username = $_GET['username'];
$originalRoom = $_GET['originalRoom'];

$ro = new database();


//$ro->editNow("registrationDetails","registrationNo",$registrationNo,"room",$room);

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered","");
$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered","");
//$ro->deleteRoom($registrationNo); // delete original room ... incase nag transfer ng ibang room
$ro->editNow("room","Description",$originalRoom,"status","Vacant"); // set vacant the room when discharge or transfer
$ro->getRoom($room); // source of data pra sa room... pra makuha ung rate ng room from the masterfile

$ro->EditNow("registrationDetails","registrationNo",$registrationNo,"room",$room);
$ro->addCharges_cash("UNPAID",$registrationNo,$room,$room,$ro->room_rate(),0,$ro->room_rate(),$ro->room_rate(),0,0,date("H:i:s"),date("Y-m-d"),$username,"Confinement","Room And Board","Cash",0,"",1,"",$ro->room_branch(),"","","","","","",""); //add room 
$ro->EditNow("room","Description",$room,"status","Occupied"); // gwen occupied ang room 

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?registrationNo=$registrationNo&username=$username ");


?>
