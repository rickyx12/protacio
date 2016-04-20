<?php
include "../../myDatabase.php";

$itemNo = $_POST['itemNo'];
$discount = $_POST['discount'];
$countCharges = 0;

$ro = new database();

echo "Entered Discount:&nbsp;".$discount."<br>";
for($x=0;$x<count($itemNo);$x++){
	//echo $itemNo[$x]."<br>";
	$countCharges += 1;
}
$discountPerCharges = ($discount / $countCharges);
//echo $countCharges;
echo "Discount per Charges:&nbsp;".$discountPerCharges;

//check ung charges kung mas mataas ung cashUnpaid kaysa sa discount n pde ilagay
for($a=0;$a<count($itemNo);$a++) {
	if($ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$a]) < ($discount / $countCharges)) {
		//dont execute some charges are not applicable for discount
		echo "<br>[<font color=red>".$ro->selectNow("patientCharges","description","itemNo",$itemNo[$a])." - ".$ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$a])."]</font> - not applicable for discount"."<br>";
	}else {
		//execute all charges are applicable for discount
		$chargesUnpaid = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo[$a]);
		$ro->editNow("patientCharges","itemNo",$itemNo[$a],"discount",$discountPerCharges);
		$ro->editNow("patientCharges","itemNo",$itemNo[$a],"cashUnpaid",($chargesUnpaid-$discountPerCharges));
		//echo "<Br>Discount Successful<br>";
	}	
}	


?>