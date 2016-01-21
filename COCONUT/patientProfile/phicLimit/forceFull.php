<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$casetype = $_GET['casetype'];
$cashUnpaid = $_GET['cashUnpaid'];


$ro = new database();
$ro->getPHIClimit_setter($casetype);

echo $cashUnpaid."<br>";
echo $ro->totalItems($registrationNo,"MEDICINE");

$shouldBeCovered = ( $cashUnpaid - $ro->getPHIClimit_medicine() );
echo "<Br><br>Total:&nbsp;".$shouldBeCovered ;
echo "<Br>No. of Items:&nbsp;".$ro->totalItems($registrationNo,"MEDICINE");

$shouldBeLessInCash = ( $ro->getPHIClimit_medicine() % $ro->totalItems($registrationNo,"MEDICINE") ) ;
echo "<br><br>Should Be Less in every items:&nbsp;".$shouldBeLessInCash;

//$ro->phicFuller("patientCharges","registrationNo",$registrationNo,"title","MEDICINE","cashUnpaid",$shouldBeLessInCash);
//$ro->phicFuller("patientCharges","registrationNo",$registrationNo,"title","MEDICINE","phic",$shouldBeLessInCash);

?>
