<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];


$ro = new database();


if($ro->selectNow("patientCharges","status","itemNo",$itemNo) == "PAID" && ($ro->selectNow("patientCharges","title","itemNo",$itemNo) != "MEDICINE" || $ro->selectNow("patientCharges","title","itemNo",$itemNo) != "SUPPLIES" )    ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/verifyDelete_passRequired.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description&quantity=$quantity&username=$username&show=$show&desc=$desc");
}else if($ro->selectNow("core2_laboratoryResultChecker","registrationNo","itemNo",$itemNo) > 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/verifyDelete_passRequired.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description&quantity=$quantity&username=$username&show=$show&desc=$desc");
}
else if($ro->selectNow("radioSavedReport","registrationNo","itemNo",$itemNo) > 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/verifyDelete_passRequired.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description&quantity=$quantity&username=$username&show=$show&desc=$desc");
}
else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/verifyDelete.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description&quantity=$quantity&username=$username&show=$show&desc=$desc");
}



?>
