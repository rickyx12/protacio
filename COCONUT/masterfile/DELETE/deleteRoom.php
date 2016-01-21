<?php
include("../../../myDatabase.php");
$roomNo = $_GET['roomNo'];
$description = $_GET['description'];
$type = $_GET['type'];
$rate = $_GET['rate'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];

$ro = new database();

$ro->deleteNow("room","roomNo",$roomNo);
echo "

<script type='text/javascript'>
alert('The $description is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/viewRoom.php?username=$username&show=$show&desc=';
</script>

";

?>
