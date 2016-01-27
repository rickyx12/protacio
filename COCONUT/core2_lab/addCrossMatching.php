<?php
include("../CORE/core2.php");

$examinationDesired = $_GET['examinationDesired'];

$donor1 = $_GET['donor'];
$dateCollected1 = $_GET['dateCollected'];
$expiryDate1 = $_GET['expiryDate'];
$retyping1 = $_GET['retyping'];
$crossMatching1 = $_GET['crossMatching'];

$donor2 = $_GET['donor2'];
$dateCollected2 = $_GET['dateCollected2'];
$expiryDate2 = $_GET['expiryDate2'];
$retyping2 = $_GET['retyping2'];
$crossMatching2 = $_GET['crossMatching2'];

$donor3 = $_GET['donor3'];
$dateCollected3 = $_GET['dateCollected3'];
$expiryDate3 = $_GET['expiryDate3'];
$retyping3 = $_GET['retyping3'];
$crossMatching3 = $_GET['crossMatching3'];

$donor4 = $_GET['donor4'];
$dateCollected4 = $_GET['dateCollected4'];
$expiryDate4 = $_GET['expiryDate4'];
$retyping4 = $_GET['retyping4'];
$crossMatching4 = $_GET['crossMatching4'];


$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];

$ro = new core2();

$ro->addLaboratoryResultChecker($registrationNo,$itemNo);
$ro->addCrossMatching($registrationNo,$itemNo,"NOEMIA D. BARTOLOME,M.D",$username,$examinationDesired,$donor1,$dateCollected1,$expiryDate1,$retyping1,$crossMatching1,$donor2,$dateCollected2,$expiryDate2,$retyping2,$crossMatching2,$donor3,$dateCollected3,$expiryDate3,$retyping3,$crossMatching3,$donor4,$dateCollected4,$expiryDate4,$retyping4,$crossMatching4,date("M d, Y"));



?>
