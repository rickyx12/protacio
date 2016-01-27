<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$serviceNo = $_GET['serviceNo'];
$service = $_GET['service'];
$category = $_GET['category'];
$show = $_GET['show'];
$desc = $_GET['desc'];


$ro = new database();

$ro->editNow("Services","serviceNo",$serviceNo,"Service",$service);
$ro->editNow("Services","serviceNo",$serviceNo,"Category",$category);

echo "
<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/chargesService.php?username=$username&show=$show&desc=$desc';
</script>


";


?>
