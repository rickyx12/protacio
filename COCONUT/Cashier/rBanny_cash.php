<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$cashInputted = $_GET['cashInputted'];
$targetAmount = $_GET['targetAmount'];
$username = $_GET['username'];
$orNO = $_GET['orNO'];
$datePaid = $_GET['datePaid'];
$shift = $_GET['shift'];

$ro = new database2();
$excessPaid1=0;
//echo ( $cash - $targetAmount );
echo "<center><br>";
$itemz = preg_split ("/\_/", $ro->getMaximumTotal_rBanny_cash_cashier($registrationNo) );
echo "<Br>";
echo "Item#:&nbsp;".$itemz[1]; 
echo "<br>Price:&nbsp;".$itemz[0];
echo "<br><b>Analyzing &nbsp;".$ro->selectNow("patientCharges","description","itemNo",$itemz[1])."</b>";

//check kung ilan na lang ung natitira sa target amount kpg bnwsan na sa current Paid ng px
if( $ro->getCurrentPaid_check_rBanny($registrationNo) >= $targetAmount ) {
$pxPaid = ( $ro->getCurrentPaid_check_rBanny($registrationNo) - $targetAmount );
}else {
$pxPaid = ( $targetAmount - $ro->getCurrentPaid_check_rBanny($registrationNo) );
}
//check kung mas mataas pa ung total ng item kaysa sa natitirang sa targetAmount
if(  $itemz[0] >= $pxPaid ) { 


$newCash = ($ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemz[1]) -  $targetAmount );

if($newCash > 1) {
echo $pxPaid;
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashPaid", $ro->selectNow("patientCharges","total","itemNo",$itemz[1]) - $newCash );

$ro->editNow("patientCharges","itemNo",$itemz[1],"paidBy",$username);
$ro->editNow("patientCharges","itemNo",$itemz[1],"timePaid",date("H:i:s"));
$ro->editNow("patientCharges","itemNo",$itemz[1],"datePaid",$datePaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"control_datePaid",$datePaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"orNO",$orNO);
//$ro->editNow("patientCharges","itemNo",$itemz[1],"status","UNPAID");
$ro->editNow("patientCharges","itemNo",$itemz[1],"reportShift",$shift);


$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d")); //date discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d")); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"balance",$ro->getTotal("cashUnpaid","",$registrationNo)); 

}else {
echo "2";
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashPaid",$ro->selectNow("patientCharges","total","itemNo",$itemz[1]));
$ro->editNow("patientCharges","itemNo",$itemz[1],"status","PAID");

$ro->editNow("patientCharges","itemNo",$itemz[1],"paidBy",$username);
$ro->editNow("patientCharges","itemNo",$itemz[1],"timePaid",date("H:i:s"));
$ro->editNow("patientCharges","itemNo",$itemz[1],"datePaid",$datePaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"control_datePaid",$datePaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"orNO",$orNO);
$ro->editNow("patientCharges","itemNo",$itemz[1],"reportShift",$shift);

}


}else {

if( $itemz[0] >= $targetAmount ) {
$excessPaid = ( $itemz[0] - $targetAmount );
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$excessPaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashPaid",$targetAmount);
//$ro->editNow("patientCharges","itemNo",$itemz[1],"status","BALANCE");
$ro->editNow("patientCharges","itemNo",$itemz[1],"reportShift",$shift);

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d")); //date discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d")); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"balance",$ro->getTotal("cashUnpaid","",$registrationNo)); 
}else {
$excessPaid  = ( $targetAmount - $itemz[0] );
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0.00");
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashPaid",$ro->selectNow("patientCharges","total","itemNo",$itemz[1]));
$ro->editNow("patientCharges","itemNo",$itemz[1],"status","PAID");
$ro->editNow("patientCharges","itemNo",$itemz[1],"paidBy",$username);
$ro->editNow("patientCharges","itemNo",$itemz[1],"timePaid",date("H:i:s"));
$ro->editNow("patientCharges","itemNo",$itemz[1],"datePaid",$datePaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"control_datePaid",$datePaid);
$ro->editNow("patientCharges","itemNo",$itemz[1],"orNO",$orNO);
$ro->editNow("patientCharges","itemNo",$itemz[1],"reportShift",$shift);

$ro->editNow("registrationDetails","registrationNo",$registrationNo,"dateUnregistered",date("Y-m-d")); //date discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"timeUnregistered",date("H:i:s")); //time discharged
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh","Synapse System"); //set as MGH [LOCKED ACCOUNT] 
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"mgh_date",date("Y-m-d")); //set as MGH [LOCKED ACCOUNT] 
}

$excessPaid1 = $excessPaid;
$exactPaid = ( $itemz[0] );




}
$excessPaid2 = $excessPaid1;

if( $excessPaid2 > 0 ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/Cashier/rBanny_cash.php?registrationNo=$registrationNo&cashInputted=$cashInputted&targetAmount=$excessPaid1&username=$username&orNO=$orNO&datePaid=$datePaid&shift=$shift");
}else {
$ro->editNow("registrationDetails","registrationNo",$registrationNo,"balance",$ro->getTotal("cashUnpaid","",$registrationNo));
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/individualPayment/toDispense.php?registrationNo=$registrationNo&module=PHARMACY&username=$username&month=".date("m")."&day=".date("d")."&year=".date("Y")."&fromTime_hour=00&fromTime_minutes=00&fromTime_seconds=00&toTime_hour=24&toTime_minutes=00&toTime_seconds=00&nod=");
}


?>
