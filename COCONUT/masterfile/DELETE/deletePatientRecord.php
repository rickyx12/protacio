<?php
include("../../../myDatabase.php");

$patientNo = $_GET['patientNo'];
$lastName = $_GET['lastName'];
$firstName = $_GET['firstName'];
$middleName = $_GET['middleName'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$ro = new database();

$ro->deleteNow("patientRecord","patientNo",$patientNo);
$ro->deleteNow("registrationDetails","patientNo",$patientNo);


echo "
<script type='text/javascript'>
alert('All Records of $lastName $firstName $middleName is now totally deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/patientRecord.php?username=$username&show=$show&desc=$desc';
</script>

";

?>
