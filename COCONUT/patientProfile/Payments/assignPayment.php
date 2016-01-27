<?php
include("../../../myDatabase.php");
$type = $_GET['type'];
$assign = $_GET['assign'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$countz = count($assign);
$ro = new database();

$ro->getPatientProfile($registrationNo);

for($x=0;$x<$countz;$x++) {
$assignPayment = preg_split ("/\_/", $assign[$x]); 
$ro->getPatientChargesToEdit($assignPayment[0]);

if($assignPayment[1] == "cash") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",$ro->patientCharges_total()); // iLLgay sa cash
///ccguraduhin n mgging zero ung total sa mga column mga column n e2 dahil mppunta Lhat sa cash
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"charity",0);
}else if($assignPayment[1] == "hmo") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",$ro->patientCharges_total());
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"charity",0);
}else if($assignPayment[1] == "phic") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",$ro->patientCharges_total());
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"charity",0);
}else if($assignPayment[1] == "package") {
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"charity",$ro->patientCharges_total() );
}





else if($assignPayment[1] == "casetype") {


if($ro->patientCharges_title() == "MEDICINE" || $ro->patientCharges_title() == "SUPPLIES" ) { //check if meds/supplies

/////ASSIGN PAYMENT

if($ro->compensable_checker($assignPayment[0]) == "yes" && ($ro->getPatientRecord_phic() == "YES" || $ro->getPatientRecord_phic() == "yes" )  ) { //check kung pde i-cover ng phic at may PHIC ang patient


$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",$ro->patientCharges_total());
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);


}else if($ro->hmo_checker($assignPayment[0]) != "" && ($ro->getPatientRecord_phic() == "YES" || $ro->getPatientRecord_phic() == "yes" ) && $ro->senior_checker($assignPayment[0]) == "NO" || $ro->senior_checker($assignPayment[0]) == "no" ) { //check kung pde i-cover ng hmo kung mei hmo ang patient
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",$ro->patientCharges_total());
}else if($ro->senior_checker($assignPayment[0]) == "YES" || $ro->senior_checker($assignPayment[0]) == "yes" ) { //kung senior
$discount = $ro->patientCharges_total() * $ro->percentage("senior");
$totalDisc = $ro->patientCharges_total() - $discount;
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",$totalDisc);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"discount",$discount);
}
else { // iLgay sa excess
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"phic",0);
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"cashUnpaid",$ro->patientCharges_total());
$ro->EditNow("patientCharges","itemNo",$assignPayment[0],"company",0);
}


}


}else {
echo "";
}


} 








echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentAssigning.php?registrationNo=$registrationNo&username=$username&type=$type&desc=';
</script>";


?>
