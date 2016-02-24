<?php
include("../../myDatabase3.php");
$registrationNo = $_GET['registrationNo'];
$targetAmount = $_GET['discount'];

$ro = new database3();

//echo ( $cash - $targetAmount );
echo "<center><br>";
$itemz = preg_split ("/\_/", $ro->getHighestTotal_rBanny($registrationNo) );
echo "<Br>";
echo "Item#:&nbsp;".$itemz[1]; 
echo "<br>Price:&nbsp;".$itemz[0];
echo "<br><b>Analyzing &nbsp;".$ro->selectNow("patientCharges","description","itemNo",$itemz[1])."</b>";

//check kung ilan na lang ung natitira sa target amount kpg bnwsan na sa current discount ng px
$pxDisc = ( $ro->getCurrentDiscount_rBanny($registrationNo) - $targetAmount );

//check kung mas mataas pa ung total ng item kaysa sa natitirang sa targetAmount
if(  $itemz[0] >= $pxDisc ) { 
$newCash = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemz[1]) - ( $targetAmount - $ro->getTotal("discount","",$registrationNo) );

if($newCash > 1) {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
$ro->editNow("patientCharges","itemNo",$itemz[1],"discount",  $targetAmount - $ro->getTotal("discount","",$registrationNo) );
echo "1";
}else {
$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
$ro->editNow("patientCharges","itemNo",$itemz[1],"discount",$ro->selectNow("patientCharges","total","itemNo",$itemz[1]));
echo "2";
}



}else {

$excessDisc = ( $itemz[0] - $targetAmount );
$exactDisc = ( $itemz[0] - $excessDisc );

$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$excessDisc);
$ro->editNow("patientCharges","itemNo",$itemz[1],"discount",$exactDisc);
echo "3";
}




if( $ro->getTotal("discount","",$registrationNo) != $targetAmount ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/patientProfile/rBanny_discount.php?registrationNo=$registrationNo&discount=$targetAmount");
}else {
echo "<br><Br><Br><center><font size=5 color=red><i>Discount Completed</i></font></center>";
}

?>
