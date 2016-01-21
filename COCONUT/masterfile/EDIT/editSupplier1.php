<?php
include("../../../myDatabase.php");
$supplierCode = $_GET['supplierCode'];
$supplierName = $_GET['supplierName'];
$address = $_GET['address'];
$contactPerson = $_GET['contactPerson'];
$contactNo = $_GET['contactNo'];
$description = $_GET['description'];
$username = $_GET['username'];

$ro = new database();

$ro->EditNow("supplier","supplierCode",$supplierCode,"supplierName",$supplierName);
$ro->EditNow("supplier","supplierCode",$supplierCode,"address",$address);
$ro->EditNow("supplier","supplierCode",$supplierCode,"contactPerson",$contactPerson);
$ro->EditNow("supplier","supplierCode",$supplierCode,"contactNo",$contactNo);
$ro->EditNow("supplier","supplierCode",$supplierCode,"description",$description);

echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/supplier.php?username=$username';
</script>

";


?>
