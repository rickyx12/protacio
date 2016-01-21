<?php
include("../../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];


$ro = new database1();

echo "<br><Br><br>";
echo "<font color=blue><b>PhilHealth Package</b></font>:&nbsp;".number_format($ro->selectNow("package","price","description",$ro->selectNow("registrationDetails","package","registrationNo",$registrationNo)),2);
echo "<Br>";
echo "<font color=green><b>Total PhilHealth Covered</b></font>:&nbsp;".number_format($ro->getTotal_paidVia($registrationNo,"phic"),2);

$descrepancy = ( $ro->selectNow("package","price","description",$ro->selectNow("registrationDetails","package","registrationNo",$registrationNo)) - $ro->getTotal_paidVia($registrationNo,"phic") );
echo "<br>";
echo "<font color=red><b>Descrepancy:</b></font>&nbsp;".number_format($descrepancy,2);

echo "<br><br>";

$misc = $ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo);
$nsCharges = $ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo);
$medicine = $ro->getTotal("cashUnpaid","MEDICINE",$registrationNo);
$supplies = $ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo);


if( $descrepancy > $misc ) {
echo "MISCELLANEOUS:&nbsp;".number_format($ro->getTotal("cashUnpaid","MISCELLANEOUS",$registrationNo),2);
}else if ( $descrepancy > $nsCharges ) {
echo "NURSING-CHARGES:&nbsp;".number_format($ro->getTotal("cashUnpaid","NURSING-CHARGES",$registrationNo),2);
}else if ( $descrepancy > $medicine ) {
echo "MEDICINE:&nbsp;".number_format($ro->getTotal("cashUnpaid","MEDICINE",$registrationNo),2);
}else if(  $descrepancy > $supplies ) {
echo "SUPPLIES:&nbsp;".number_format($ro->getTotal("cashUnpaid","SUPPLIES",$registrationNo),2);
}else {

}


?>
