<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$supplierName = $_GET['supplierName'];
$supplierCode = $_GET['supplierCode'];


$ro = new database();

$ro->deleteNow("supplier","supplierCode",$supplierCode);

echo "
<script type='text/javascript'>
alert('$supplierName is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/supplier.php?username=$username';
</script>

";

?>
