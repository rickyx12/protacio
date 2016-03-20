<?
include "../../myDatabase.php";
$itemNo = $_GET['itemNo'];
$checked = $_GET['checked'];
$ro = new database();

if( $ro->selectNow("patientCharges","checked","itemNo",$itemNo) == "check" ) {
$ro->editNow("patientCharges","itemNo",$itemNo,"checked","");
$ro->editNow("patientCharges","itemNo",$itemNo,"checked","");
}else {
$ro->editNow("patientCharges","itemNo",$itemNo,"checked","check");
$ro->editNow("patientCharges","itemNo",$itemNo,"checked","check");
}


?>