<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$chargesCode = $_GET['chargesCode'];
$reqdate = $_GET['reqdate'];
$itemNo = $_GET['itemNo'];


$ro = new database();

//ito ung magssabi kung saang result page dapat mappunta based sa subcategory ng charges
if($ro->selectNow("availableCharges","subCategory","chargesCode",$chargesCode) == "hematology") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/core2_lab/addHematology.php?registrationNo=$registrationNo&username=$username&itemNo=$itemNo");
}else if($ro->selectNow("availableCharges","subCategory","chargesCode",$chargesCode) == "clinchem") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Laboratory/clinChemData.php?registrationNo=$registrationNo&itemNo=$itemNo");
}else if($ro->selectNow("availableCharges","subCategory","chargesCode",$chargesCode) == "urinalysis") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Laboratory/urinalysis.php?registrationNo=$registrationNo&itemNo=$itemNo");
}else if($ro->selectNow("availableCharges","subCategory","chargesCode",$chargesCode) == "serology") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Laboratory/serologyData.php?registrationNo=$registrationNo&itemNo=$itemNo");
}else if($ro->selectNow("availableCharges","subCategory","chargesCode",$chargesCode) == "fecalysis") {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Laboratory/fecalysisData.php?registrationNo=$registrationNo&itemNo=$itemNo");
}


else {

}


?>
