<?php
include("../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$birthPlace = $_GET['birthPlace'];
$nationality = $_GET['nationality'];
$pxOccu = $_GET['pxOccu'];
$fathersName = $_GET['fathersName'];
$mothersName = $_GET['mothersName'];
$address = $_GET['address'];
$contactNo1 = $_GET['contactNo1'];
$spouseName = $_GET['spouseName'];
$address1 = $_GET['address1'];
$contactNo2 = $_GET['contactNo2'];
$admissionType = $_GET['admissionType'];
$ssc = $_GET['ssc'];
$ws = $_GET['ws'];
$employerName = $_GET['employerName'];
$dataGivenBy = $_GET['dataGivenBy'];
$informantAddress = $_GET['informantAddress'];
$patientRelation = $_GET['patientRelation'];
$disposition = $_GET['disposition'];
$result = $_GET['result'];
$phicMember = $_GET['phicMember'];

$ro = new database2();
$ro->getPatientProfile($registrationNo);
$ro->admissionDischargedRecord($ro->getRegistrationDetails_patientNo(),$registrationNo,$birthPlace,$nationality,$pxOccu,$fathersName,$mothersName,$address,$contactNo1,$spouseName,$address1,$contactNo2,$admissionType,$ssc,$ws,$employerName,$dataGivenBy,$informantAddress,$patientRelation,$disposition,$result);



?>
