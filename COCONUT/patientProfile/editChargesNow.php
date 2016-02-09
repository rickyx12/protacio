<?php
include("../../myDatabase3.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$quantity = $_GET['quantity'];
$discount = $_GET['discount'];
$total = $_GET['total'];
$timeCharge = $_GET['timeCharge'];
$dateCharge = $_GET['dateCharge'];
$paidVia = $_GET['paidVia'];
$title = $_GET['title'];
$service = $_GET['service'];
$cashCovered = $_GET['cashCovered'];
$companyCovered = $_GET['companyCovered'];
if( isset($_GET['companyCovered1']) ) { $companyCovered1 = $_GET['companyCovered1'];  } else { }
if( isset($_GET['companyCovered2']) ) { $companyCovered2 = $_GET['companyCovered2'];  } else { }
$phicCovered = $_GET['phicCovered'];
$branch = $_GET['branch'];
$username = $_GET['username'];

$show = $_GET['show'];
$desc = $_GET['desc'];


$datePaid_month = $_GET['datePaid_month'];
$datePaid_day = $_GET['datePaid_day'];
$datePaid_year = $_GET['datePaid_year'];
$timePaid_hour = $_GET['timePaid_hour'];
$timePaid_minutes = $_GET['timePaid_minutes'];
$timePaid_seconds = $_GET['timePaid_seconds'];
$paidBy = $_GET['paidBy'];
$remarks = $_GET['remarks'];


$ro = new database3();
$datePaid = $datePaid_month."_".$datePaid_day."_".$datePaid_year;
$timePaid = $timePaid_hour.":".$timePaid_minutes.":".$timePaid_seconds;
$total = $quantity * $sellingPrice;
$grandTotal = $total - $discount;

$totalCovered =  ($cashCovered + $companyCovered + $phicCovered)  ;



//$totalCovered =  ($cashCovered + $companyCovered + $phicCovered)  ;


//check if total covered is equal to the grand total
if($totalCovered != $grandTotal) { //if not equal,dont edit but prompt the user that was not tally 

echo "
<script type='text/javascript'>
alert('Sorry,The Cash Covered + Company Covered + PHIC Covered = ($totalCovered) this Total Covered is not equal to the Total which is ($total) only');
window.back(-1);
</script>";

}else {
$beforeEdit_sellingPrice = $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo);
$beforeEdit_quantity = $ro->selectNow("patientCharges","quantity","itemNo",$itemNo);
$beforeEdit_discount = $ro->selectNow("patientCharges","discount","itemNo",$itemNo);
$beforeEdit_total = $ro->selectNow("patientCharges","total","itemNo",$itemNo);
$beforeEdit_cash = $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo);
$beforeEdit_company = $ro->selectNow("patientCharges","company","itemNo",$itemNo);
$beforeEdit_phic = $ro->selectNow("patientCharges","phic","itemNo",$itemNo);
$beforeEdit_user = $ro->selectNow("patientCharges","chargeBy","itemNo",$itemNo);
$beforeEdit_dateCharge = $ro->selectNow("patientCharges","dateCharge","itemNo",$itemNo);
$beforeEdit_timeCharge = $ro->selectNow("patientCharges","timeCharge","itemNo",$itemNo);

//kung ndi inedit ng user ung dateCharge then use current date
if($beforeEdit_dateCharge == $dateCharge) {
$dateCharge = date("Y-m-d");
}else {
//kung inedit ng user ung dateCharge then use the inputted date by the user
$dateCharge = $dateCharge;
}

$ro->editedAmount($itemNo,$registrationNo,$beforeEdit_sellingPrice,$beforeEdit_quantity,$beforeEdit_discount,$beforeEdit_total,$beforeEdit_cash,$beforeEdit_company,$beforeEdit_phic,$beforeEdit_timeCharge,$beforeEdit_dateCharge,$beforeEdit_user);
//if tally execute edit
$ro->editCharges($itemNo,"description",$description);
$ro->editCharges($itemNo,"sellingPrice",$sellingPrice);
$ro->editCharges($itemNo,"quantity",$quantity);
$ro->editCharges($itemNo,"discount",$discount);
$ro->editCharges($itemNo,"total",$grandTotal);
$ro->editCharges($itemNo,"timeCharge",$timeCharge);
$ro->editCharges($itemNo,"dateCharge",$dateCharge);
$ro->editCharges($itemNo,"paidVia",$paidVia);
$ro->editCharges($itemNo,"title",$title);
$ro->editCharges($itemNo,"service",$service);
$ro->editCharges($itemNo,"cashUnpaid",$cashCovered);
$ro->editCharges($itemNo,"company",$companyCovered);
$ro->editCharges($itemNo,"branch",$branch);
$ro->editCharges($itemNo,"datePaid",$datePaid);
$ro->editCharges($itemNo,"timePaid",$timePaid);
$ro->editCharges($itemNo,"paidBy",$paidBy);
$ro->editCharges($itemNo,"phic",$phicCovered);
$ro->editCharges($itemNo,"remarks",$remarks);
$ro->editCharges($itemNo,"chargeBy",$username);
$ro->editCharges($itemNo,"dateCharge",$dateCharge);
$ro->editCharges($itemNo,"timeCharge",date("H:is:"));
if($title=="DERMA"){
$dermaCapital=$_GET['dermaCapital'];
$ro->editCharges($itemNo,"dermaCapital",$dermaCapital);
}

}

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/patientCharges.php?registrationNo=$registrationNo&username=$username&show=$show&desc=$desc';
</script>

";

?>
