<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$companyNo = $_GET['companyNo'];
$companyName = $_GET['companyName'];

$ro = new database();

$ro->deleteNow("Company","companyNo",$companyNo);

echo "
<script type='text/javascript'>
alert('$companyName is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/company.php?username=$username';
</script>

";

?>
