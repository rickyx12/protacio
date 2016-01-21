<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$serviceNo = $_GET['serviceNo'];
$service = $_GET['service'];
$category = $_GET['category'];
$show = $_GET['show'];


$ro = new database();

$ro->deleteNow("Services","serviceNo",$serviceNo);
echo "

<script type='text/javascript'>
alert('The $service in $category is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/chargesService.php?username=$username&show=$show';
</script>

";

?>
