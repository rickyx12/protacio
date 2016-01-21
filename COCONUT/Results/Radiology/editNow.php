<?php
include("../../../myDatabase.php");
$radioNo = $_GET['radioNo'];
$itemNo = $_GET['itemNo'];
$registrationNo =  $_GET['registrationNo'];
$description = $_GET['description'];
$radiologist = $_GET['radiologist'];
$medTech = $_GET['medTech'];
$branch = $_GET['branch'];
$receivedMonth = $_GET['receivedMonth'];
$receivedDay = $_GET['receivedDay'];
$receivedYear = $_GET['receivedYear'];
$releasedMonth = $_GET['releasedMonth'];
$releasedDay = $_GET['releasedDay'];
$releasedYear = $_GET['releasedYear'];
$impression = $_GET['impression'];
$username = $_GET['username'];


$ro = new database();

$dateReceived = $receivedMonth."_".$receivedDay."_".$receivedYear;
$dateReleased = $releasedMonth."_".$releasedDay."_".$releasedYear;

$ro->editNow("radiologyResults","radioNo",$radioNo,"radiologist",$radiologist);
$ro->editNow("radiologyResults","radioNo",$radioNo,"medTech",$medTech);
$ro->editNow("radiologyResults","radioNo",$radioNo,"dateReceived",$dateReceived);
$ro->editNow("radiologyResults","radioNo",$radioNo,"dateReleased",$dateReleased);
$ro->editNow("radiologyResults","radioNo",$radioNo,"impression",$impression);
$ro->editNow("radiologyResults","radioNo",$radioNo,"branch",$branch);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/Results/Radiology/radioResult_list.php?registrationNo=$registrationNo&username=$username'
</script>


";

?>
