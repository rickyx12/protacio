<?php
include("../../../myDatabase1.php");
$short = $_GET['short'];
$title = $_GET['title'];
$registrationNo = $_GET['registrationNo'];
$doctor = $_GET['doctor'];
$pf = $_GET['pf'];


$ro = new database1();

//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)
$ro->addCharges_magicPackage("UNPAID",$registrationNo,"mp",$title,$short,"0",$short,"0",$short,"0",$ro->getSynapseTime(),date("M_d_Y"),"billing","Package",$title,"Cash","0","","1","","Pagadian","");

$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$doctor,"phic",$pf);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$doctor,"sellingPrice",$pf."/".$pf);
$ro->doubleEditNow("patientCharges","registrationNo",$registrationNo,"description",$doctor,"total",$pf);
?>
