<?php
include("../../myDatabase.php");
$labNoz = $_GET['labNoz'];
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
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
$remarks = $_GET['remarks'];

$examName1 = $_GET['examName1'];
$examName2 = $_GET['examName2'];
$examName3 = $_GET['examName3'];
$examName4 = $_GET['examName4'];
$examName5 = $_GET['examName5'];
$examName6 = $_GET['examName6'];
$examName7 = $_GET['examName7'];
$examName8 = $_GET['examName8'];
$examName9 = $_GET['examName9'];
$examName10 = $_GET['examName10'];

$examResult1 = $_GET['examResult1'];
$examResult2 = $_GET['examResult2'];
$examResult3 = $_GET['examResult3'];
$examResult4 = $_GET['examResult4'];
$examResult5 = $_GET['examResult5'];
$examResult6 = $_GET['examResult6'];
$examResult7 = $_GET['examResult7'];
$examResult8 = $_GET['examResult8'];
$examResult9 = $_GET['examResult9'];
$examResult10 = $_GET['examResult10'];

$flag1 = $_GET['flag1'];
$flag2 = $_GET['flag2'];
$flag3 = $_GET['flag3'];
$flag4 = $_GET['flag4'];
$flag5 = $_GET['flag5'];
$flag6 = $_GET['flag6'];
$flag7 = $_GET['flag7'];
$flag8 = $_GET['flag8'];
$flag9 = $_GET['flag9'];
$flag10 = $_GET['flag10'];


$examValues1 = $_GET['examValues1'];
$examValues2 = $_GET['examValues2'];
$examValues3 = $_GET['examValues3'];
$examValues4 = $_GET['examValues4'];
$examValues5 = $_GET['examValues5'];
$examValues6 = $_GET['examValues6'];
$examValues7 = $_GET['examValues7'];
$examValues8 = $_GET['examValues8'];
$examValues9 = $_GET['examValues9'];
$examValues10 = $_GET['examValues10'];

$ro = new database();
$dateReceived = $receivedMonth."_".$receivedDay."_".$receivedYear;
$dateReleased = $releasedMonth."_".$releasedDay."_".$releasedYear;

$ro->insert_laboratoryResult($labNoz,$itemNo,$registrationNo,$dateReceived,$dateReleased,$pathologist,$medTech,$remarks,$branch);


if($examName1 != "" && $examResult1 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName1,$examResult1,$flag1,$examValues1,"");
}else {
echo "";
}

if($examName2 != "" && $examResult2 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName2,$examResult2,$flag2,$examValues2,"");
}else {
echo "";
}

if($examName3 != "" && $examResult3 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName3,$examResult3,$flag3,$examValues3,"");
}else {
echo "";
}

if($examName4 != "" && $examResult4 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName4,$examResult4,$flag4,$examValues4,"");
}else {
echo "";
}

if($examName5 != "" && $examResult5 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName5,$examResult5,$flag5,$examValues5,"");
}else {
echo "";
}

if($examName6 != "" && $examResult6 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName6,$examResult6,$flag6,$examValues6,"");
}else {
echo "";
}

if($examName7 != "" && $examResult7 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName7,$examResult7,$flag7,$examValues7,"");
}else {
echo "";
}


if($examName8 != "" && $examResult8 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName8,$examResult8,$flag8,$examValues8,"");
}else {
echo "";
}

if($examName9 != "" && $examResult9 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName9,$examResult9,$flag9,$examValues9,"");
}else {
echo "";
}

if($examName10 != "" && $examResult10 != "") {
$ro->insert_laboratoryResultValue($labNoz,$examName10,$examResult10,$flag10,$examValues10,"");
}else {
echo "";
}



echo "
<script type='text/javascript'>
alert('Examination Result for the $description is now Available');
</script>


";


?>
