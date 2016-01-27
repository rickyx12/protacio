<?php
include("../myDatabase1.php");
$supplierName = $_GET['supplierName'];
$address = $_GET['address'];
$contactPerson = $_GET['contactPerson'];
$contactNo = $_GET['contactNo'];
$description = $_GET['description'];

$ro = new database1();

$ro->addSupplier($supplierName,$address,$contactPerson,$contactNo,$description);



?>
