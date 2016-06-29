<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$cash = $_GET['cash'];
$targetAmount = $_GET['targetAmount'];

$ro = new database2();


//echo ( $cash - $targetAmount );
echo "<center><br>";
$itemz = preg_split ("/\_/", $ro->getMaximumTotal_rBanny($registrationNo) ); //format cashUnpaid_itemNo
echo "<Br>";
echo "Item#:&nbsp;".$itemz[1]; 
echo "<br>Price:&nbsp;".$itemz[0];
echo "<br><b>Analyzing &nbsp;".$ro->selectNow("patientCharges","description","itemNo",$itemz[1])."</b>";

//check kung ilan na lang ung natitira sa target amount kpg bnwsan na sa current phic ng px
$pxPHIC = ( $ro->getCurrentPHIC_check_rBanny($registrationNo) - $targetAmount );

//check kung mas mataas pa ung total ng item kaysa sa natitirang sa targetAmount
if(  $itemz[0] >= $pxPHIC ) { 
	$newCash = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemz[1]) - ( $targetAmount - $ro->getTotal("phic","",$registrationNo) );

	if($newCash > 1) {
		$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$newCash);
		$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",  $targetAmount - $ro->getTotal("phic","",$registrationNo) );
	}else {
		$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemz[1]));
		$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid","0");
	}



}else {

	$excessPHIC = ( $itemz[0] - $targetAmount );
	$exactPHIC = ( $itemz[0] - $excessPHIC );

	$ro->editNow("patientCharges","itemNo",$itemz[1],"cashUnpaid",$excessPHIC);
	$ro->editNow("patientCharges","itemNo",$itemz[1],"phic",$exactPHIC);

}




if( $ro->getTotal("phic","",$registrationNo) != $targetAmount ) {
$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/rBanny/analyzing_rBanny.php?registrationNo=$registrationNo&cash=$cash&targetAmount=$targetAmount");
}else {
echo "<br><Br><Br><center><font size=5 color=red><i>R-Banny is now completed the PhilHealth CaseRate</i></font></center>";
}

?>
