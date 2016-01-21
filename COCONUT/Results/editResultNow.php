<?php
include("../../myDatabase.php");
$valuesNo = $_GET['valuesNo'];
$examName = $_GET['examName'];
$examResult = $_GET['examResult'];
$flag = $_GET['flag'];
$examValues = $_GET['examValues'];

$labNo = $_GET['labNo'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$pathologist = $_GET['pathologist'];
$medTech = $_GET['medTech'];
$receivedMonth = $_GET['receivedMonth'];
$receivedDay = $_GET['receivedDay'];
$receivedYear = $_GET['receivedYear'];
$releasedMonth = $_GET['releasedMonth'];
$releasedDay = $_GET['releasedDay'];
$releasedYear = $_GET['releasedYear'];
$branch = $_GET['branch'];

$ro = new database();


$ro->editNow("laboratoryResultsValue","valuesNo",$valuesNo,"examName",$examName);
$ro->editNow("laboratoryResultsValue","valuesNo",$valuesNo,"examResult",$examResult);
$ro->editNow("laboratoryResultsValue","valuesNo",$valuesNo,"examFlag",$flag);
$ro->editNow("laboratoryResultsValue","valuesNo",$valuesNo,"examValue",$examValues);



echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/Results/editResultValue.php?labNoz=$labNo&registrationNo=$registrationNo&itemNo=$itemNo&description=$description&pathologist=$pathologist&medTech=$medTech&receivedMonth=$receivedMonth&receivedDay=$receivedDay&receivedYear=$receivedYear&releasedMonth=$releasedMonth&releasedDay=$releasedDay&releasedYear=$releasedYear&branch=$branch'
</script>

";

?>
