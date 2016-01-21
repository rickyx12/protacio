<?php
include("../../myDatabase1.php");
$short = $_GET['amount'];
$title = $_GET['title'];
$registrationNo = $_GET['registrationNo'];

$ro = new database1();

//addCharges_cash($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room)
$ro->addCharges_magicPackage("UNPAID",$registrationNo,"MEDICINE",$title,$short,"0",$short,$short,"0","0",$ro->getSynapseTime(),date("M_d_Y"),"billing","Package",$title,"Cash","0","","1","","Pagadian","");

?>
