<?php
include("../../../myDatabase.php");
$floorNo = $_GET['floorNo'];
$description = $_GET['description'];
$branch = $_GET['branch'];
$username = $_GET['username'];
$show = $_GET['show'];
$desc = $_GET['desc'];
$ro = new database();

$ro->deleteNow("floor","floorNo",$floorNo);

echo "

<script type='text/javascript'>
alert('$description in $branch Branch is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/floor.php?username=$username&show=$show&desc=$desc';
</script>

";

?>
