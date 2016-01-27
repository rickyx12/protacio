<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$transfer = $_GET['transfer'];
$countz = count($transfer);


$ro = new database();


if($desc == "cash2company") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_company();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
}

}else if($desc == "cash2phic") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_cashUnpaid() + $ro->patientCharges_phic();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
}
}else if($desc == "cash2package") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"charity",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",0);
}
}



else if($desc == "company2cash") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
}

}

else if($desc == "company2phic") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_company() + $ro->patientCharges_phic();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",0);
}

}


else if($desc == "phic2cash") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_cashUnpaid();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"cashUnpaid",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
}

}


else if($desc == "phic2company") {

for($x=0;$x<$countz;$x++) {
$ro->getPatientChargesToEdit($transfer[$x]);
$totalTransfer = $ro->patientCharges_phic() + $ro->patientCharges_company();
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"company",$totalTransfer);
$ro->EditNow("patientCharges","itemNo",$transfer[$x],"phic",0);
}

}

else {
echo "";
}

echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/patientProfile/paymentTransfer.php?registrationNo=$registrationNo&username=$username&show=All&desc=$desc';
</script>

";


?>
