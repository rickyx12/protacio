<?php
include("../../myDatabase.php");
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


if($examName != "" && $examResult != "") {

$ro->insert_laboratoryResultValue($labNo,$examName,$examResult,$flag,$examValues,"");
}else {
echo "";
}

echo "
<script type='text/javascript'>";

if($examName != "" && $examResult != "") {
echo "window.location='http://".$ro->getMyUrl()."/COCONUT/Results/editResultValue.php?labNoz=$labNo&registrationNo=$registrationNo&itemNo=$itemNo&description=$description&pathologist=$pathologist&medTech=$medTech&receivedMonth=$receivedMonth&receivedDay=$receivedDay&receivedYear=$receivedYear&releasedMonth=$releasedMonth&releasedDay=$releasedDay&releasedYear=$releasedYear&branch=$branch';";
}else {
echo "alert('Sorry, Examination Name and Examination Result are required');";
echo "history.back(-1);";
}

echo "</script>";





?>
