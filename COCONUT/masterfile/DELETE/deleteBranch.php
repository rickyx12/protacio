<?php
include("../../../myDatabase.php");
$branchID = $_GET['branchID'];
$branch = $_GET['branch'];
$username = $_GET['username'];
$ro = new database();

$ro->deleteNow("branch","branchID",$branchID);

echo "

<script type='text/javascript'>
alert('$branch Branch is now deleted');
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/branch.php?username=$username';
</script>

";

?>
