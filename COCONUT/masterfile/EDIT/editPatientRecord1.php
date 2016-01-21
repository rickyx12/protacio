<?php
include("../../../myDatabase.php");

$patientNo = $_GET['patientNo'];
$username = $_GET['username'];
$lastName = $_GET['lastName'];
$firstName = $_GET['firstName'];
$middleName = $_GET['middleName'];
$completeName = $_GET['completeName'];
$Birthdate = $_GET['Birthdate'];
$Age = $_GET['Age'];
$Gender = $_GET['Gender'];
$Senior = $_GET['Senior'];
$Address = $_GET['Address'];
$contactNo = $_GET['contactNo'];
$PHIC = $_GET['PHIC'];
$civilStatus = $_GET['civilStatus'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();

$ro->editNow("patientRecord","patientNo",$patientNo,"lastName",$lastName);
$ro->editNow("patientRecord","patientNo",$patientNo,"firstName",$firstName);
$ro->editNow("patientRecord","patientNo",$patientNo,"middleName",$middleName);
$ro->editNow("patientRecord","patientNo",$patientNo,"completeName",$completeName);
$ro->editNow("patientRecord","patientNo",$patientNo,"Birthdate",$Birthdate);
$ro->editNow("patientRecord","patientNo",$patientNo,"Age",$Age);
$ro->editNow("patientRecord","patientNo",$patientNo,"Gender",$Gender);
$ro->editNow("patientRecord","patientNo",$patientNo,"Senior",$Senior);
$ro->editNow("patientRecord","patientNo",$patientNo,"Address",$Address);
$ro->editNow("patientRecord","patientNo",$patientNo,"contactNo",$contactNo);
$ro->editNow("patientRecord","patientNo",$patientNo,"PHIC",$PHIC);
$ro->editNow("patientRecord","patientNo",$patientNo,"civilStatus",$civilStatus);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/masterfile/patientRecord.php?username=$username&show=$show&desc=$desc");

?>
