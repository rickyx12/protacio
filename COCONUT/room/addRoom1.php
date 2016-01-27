<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$type = $_GET['type'];
$rate = $_GET['rate'];
$branch = $_GET['branch'];
$floor = $_GET['floor'];
$username = $_GET['username'];


$ro = new database();

$myRoom = $description."_".$type;
$ro->addNewRoom($myRoom,$type,$rate,$branch,$floor);

echo "

<script type='text/javascript'>
alert('$description was sucessfully added to the list of rooms');
window.location='http://".$ro->getMyUrl()."/COCONUT/room/addRoom.php?username=$username';
</script>

";

?>
