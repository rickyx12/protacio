<?php
include("../../../myDatabase.php");
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$opd = $_GET['opdprice'];
$ipd = $_GET['ipdprice'];
$subCategory = $_GET['subCategory'];



$ro = new database();

$ro->editNow("availableCharges","chargesCode",$chargesCode,"Description",$description);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"OPD",$opd);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"HMO",$ipd);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"WARD",$ipd);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"SOLOWARD",$ipd);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"SEMIPRIVATE",$ipd);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"PRIVATE",$ipd);
$ro->editNow("availableCharges","chargesCode",$chargesCode,"subCategory",$subCategory);


?>

