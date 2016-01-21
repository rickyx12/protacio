<?php
include("../../myDatabase2.php");

$registrationNo = $_GET['registrationNo'];
$nationality = $_GET['nationality'];
$birthPlace = $_GET['birthPlace'];
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


$ro = new database2();

$ro->editNow("patientRecord2","registrationNo",$registrationNo,"birthPlace",$birthPlace);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"nationality",$nationality);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"pxOccupation",$pxOccu);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"fathersName",$fathersName);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"mothersName",$mothersName);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"address",$address);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"contact1",$contactNo1);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"spouseName",$spouseName);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"address1",$address1);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"contact2",$contactNo2);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"admissionType",$admissionType);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"socialService",$ssc);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"ws",$ws);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"employerName",$employerName);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"dataGivenBy",$dataGivenBy);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"informantAddress",$informantAddress);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"relation2patient",$patientRelation);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"disposition",$disposition);
$ro->editNow("patientRecord2","registrationNo",$registrationNo,"result",$result);


?>
