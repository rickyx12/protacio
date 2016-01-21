<?php
include("../../../myDatabase.php");
$roomNo = $_GET['roomNo'];
$description = $_GET['description'];
$type = $_GET['type'];
$rate = $_GET['rate'];
$branch = $_GET['branch'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$floor = $_GET['floor'];
$status = $_GET['status'];


$ro = new database();

$myRoom = $description."_".$type;

$ro->EditNow("room","roomNo",$roomNo,"Description",$myRoom);
$ro->EditNow("room","roomNo",$roomNo,"type",$type);
$ro->EditNow("room","roomNo",$roomNo,"rate",$rate);
$ro->EditNow("room","roomNo",$roomNo,"branch",$branch);
$ro->EditNow("room","roomNo",$roomNo,"floor",$floor);
$ro->EditNow("room","roomNo",$roomNo,"status",$status);
echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/viewRoom.php?username=$username&show=$show&desc=$desc';
</script>

";

?>
