<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$batchNo = $_GET['batchNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();

if( $ro->selectNow("inventory","autoDispense","inventoryCode",$ro->selectNow("patientCharges","chargesCode","itemNo",$itemNo)) == "yes" ) {
echo "<script type='text/javascript'>alert('You cannot delete that meds/sup here its already dispensed pls return instead in Medicine menu');</script>";
}else {
//$ro->deleteNow("patientCharges","itemNo",$itemNo);
$ro->editNow("patientCharges","itemNo",$itemNo,"status","DELETED_".$username);

}
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/android/mobileECART/showCart_update.php?registrationNo=$registrationNo&batchNo=$batchNo&username=$username");

?>
