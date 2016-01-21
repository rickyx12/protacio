<?php
include("../../myDatabase.php");
$noteNo = $_GET['noteNo'];
$noteType = $_GET['noteType'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->deleteNow("patientNotes","noteNo",$noteNo);

echo "

<script type='text/javascript'>
alert('Successfully Deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/patientNotes/viewNote.php?noteType=$noteType&registrationNo=$registrationNo&username=';
</script>

";

?>
