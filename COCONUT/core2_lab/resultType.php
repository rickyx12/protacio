<?php
include("../../myDatabase1.php");

$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$itemNo = $_GET['itemNo'];
$username = $_GET['username'];


header("Location: /COCONUT/Laboratory/resultList/resultList.php?username=$username&registrationNo=$registrationNo");




echo "<br><Br><Center>";
//$ro->coconutBoxStart("700","auto");


//$ro->getLabForm( $ro->selectNow("availableCharges","subCategory","chargesCode",$chargesCode),$registrationNo,$itemNo,$username );


echo "<br><br>";
//$ro->coconutBoxStop();


?>
