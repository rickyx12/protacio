<?php
include "../../myDatabase.php";

$itemNo = $_POST['itemNo'];
$discount = $_POST['discount'];
$countCharges = 0;
$error = 0;

$ro = new database();

echo "Entered Discount:&nbsp;".$discount."<br>";
for($x=0;$x<count($itemNo);$x++){
	//echo $itemNo[$x]."<br>";
	$countCharges += 1;
}
$discountPerCharges = number_format(($discount / $countCharges),2);
$discountPerCharges_noFormat = ($discount / $countCharges);
//echo $countCharges;
echo "Discount per Charges:&nbsp;".$discountPerCharges;



//check ung charges kung mas mataas ung cashUnpaid kaysa sa discount n pde ilagay
for($a=0;$a<count($itemNo);$a++) {
	if($ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$a]) < ($discount / $countCharges)) {
		//dont execute some charges are not applicable for discount
		$error += 1;
		echo "<br>[<font color=red>".$ro->selectNow("patientCharges","description","itemNo",$itemNo[$a])." - ".$ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$a])."]</font> - not applicable for discount"."<br>";
	}else {
		//execute all charges are applicable for discount
		//$chargesUnpaid = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$a]);
		//$ro->editNow("patientCharges","itemNo",$itemNo[$a],"discount",$discountPerCharges);
		//$ro->editNow("patientCharges","itemNo",$itemNo[$a],"cashUnpaid",($chargesUnpaid-$discountPerCharges));
		//echo "<Br>Discount Successful<br>";
	}	
}


//echo $error;	


if($error < 1) {
//kung wlang error then execute
 for($x=0;$x<count($itemNo);$x++) {
	$chargesUnpaid = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$x]);
	$ro->editNow("patientCharges","itemNo",$itemNo[$x],"discount",$discountPerCharges_noFormat);
	$ro->editNow("patientCharges","itemNo",$itemNo[$x],"cashUnpaid",round($chargesUnpaid-$discountPerCharges_noFormat,2));
 }
}else {
	//dont edit
}


?>