<?php
include("../../../myDatabase.php");
$companyName = $_GET['companyName'];
$companyAddress = $_GET['companyAddress'];
$rate1 = $_GET['rate1'];
$rate2 = $_GET['rate2'];
$rate3 = $_GET['rate3'];
$rate4 = $_GET['rate4'];
$companyNo = $_GET['companyNo'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$type = $_GET['type'];


$ro = new database();

$ro->editNow("Company","companyNo",$companyNo,"companyName",$companyName);
$ro->editNow("Company","companyNo",$companyNo,"companyAddress",$companyAddress);
$ro->editNow("Company","companyNo",$companyNo,"rate1",$rate1);
$ro->editNow("Company","companyNo",$companyNo,"rate2",$rate2);
$ro->editNow("Company","companyNo",$companyNo,"rate3",$rate3);
$ro->editNow("Company","companyNo",$companyNo,"rate4",$rate4);
$ro->editNow("Company","companyNo",$companyNo,"type",$type);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/company.php?username=$username&desc=$desc&show=$show';
</script>

";


?>
