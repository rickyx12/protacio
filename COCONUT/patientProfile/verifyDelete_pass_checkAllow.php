<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database2();

//if( ($ro->getTitle($itemNo) == "MEDICINE" || $ro->getTitle($itemNo) == "SUPPLIES")  && $ro->selectNow("registeredUser","module","username",$username) != "PHARMACY" ) {
//echo "<br><Br><Br><font color=red>PHARMACY NA LANG MAG RERETURN.
//<bR>
//NAHIYA AKO SAYO EH BKA BUSY KA. =)</font>";
//}else {

//}



/* 
pra sa auto return ibig sbhin kpg nag return ung NS,ER,OR ndi n kailangan ng confirmation pra bumalik s inventory ung qty ng nireturn
if( $ro->selectNow("patientCharges","inventoryFrom","itemNo",$itemNo) != "PHARMACY" && $ro->selectNow("patientCharges","inventoryFrom","itemNo",$itemNo) != "CSR" ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/itemDepartment.php?itemNo=$itemNo&username=$username&return=main");
}else {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/verifyDelete_redirect_checkAllow.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description&quantity=$quantity&username=$username&show=$show&desc=$desc");
}
*/

//s ngaun disable q muna ung auto return
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/verifyDelete_redirect_checkAllow.php?registrationNo=$registrationNo&itemNo=$itemNo&description=$description&quantity=$quantity&username=$username&show=$show&desc=$desc");


?>
