<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$chargesCode = $_GET['chargesCode'];
$itemNo = $_GET['itemNo'];
$subCategory = $_GET['subCategory'];
$ro = new database1();
echo "TESTING ...";

if( $subCategory == "CBC" ) {

header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=16&template=");
/*
$ro->coconutFormStart("POST","/COCONUT/Laboratory/resultList/resultFormTemplate.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("chargesCode",$chargesCode);
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("templateNo","16");
$ro->coconutHidden("template",$ro->selectNow("labResultList","template","templateNo","16"));
$ro->coconutButton("add CBC Result");
$ro->coconutFormStop();
*/
}else if( $subCategory == "urinalysis" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=10&template=");
}else if( $subCategory == "Coagulation" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=50&template=");
}else if( $subCategory == "Pregnancy" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=29&template=");
}else if( $subCategory == "reticCount" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=33&template=");
}else if( $subCategory == "BLOODBANK" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=20&template=");
}else if( $subCategory == "bloodTyping" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=6&template=");
}else if( $subCategory == "ABG" ) {
header("Location: /COCONUT/Laboratory/resultList/resultFormTemplate_new.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=14&template=");
}

else {
header("Location: /COCONUT/Laboratory/resultList/resultList.php?registrationNo=$registrationNo&username=$username&chargesCode=$chargesCode&itemNo=$itemNo");
}

?>
