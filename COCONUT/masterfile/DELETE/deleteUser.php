<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$employeeID = $_GET['employeeID'];
$user = $_GET['user'];

$ro = new database();

$ro->deleteNow("registeredUser","employeeID",$employeeID);

echo "
<script type='text/javascript'>
alert('$user is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/user.php?username=$username';
</script>

";

?>
