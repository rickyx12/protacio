<?php
include("../myDatabase1.php");

$patientNo = $_GET['patientNo'];
$date = $_GET['date'];
$from = $_GET['from'];

$ro = new database1();

if( $ro->selectNow("reportHeading","information","reportName","stopDoubleRegistration") == "Activate" ) {

if($ro->checkingStop($patientNo,date("Y-m-d")) == "" ) {
header("Location:http://".$ro->getMyUrl()."/Registration/newRecord_again.php?patientNo=$patientNo&from=$from");
}else {
header("Location:http://".$ro->getMyUrl()."/Registration/stopRegistration.php");
}

}else {

header("Location:http://".$ro->getMyUrl()."/Registration/newRecord_again.php?patientNo=$patientNo&from=$from");



}


?>
