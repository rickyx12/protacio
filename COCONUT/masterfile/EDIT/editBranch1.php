<?php
include("../../../myDatabase.php");
$username = $_POST['username'];
$branchID = $_POST['branchID'];
$branch = $_POST['branch'];
$show = $_POST['show'];
$ro = new database();

$ro->editNow("branch","branchID",$branchID,"branch",$branch);

echo "

<script type='text/javascript'>
window.location='http://".$ro->getMyUrl()."/COCONUT/masterfile/branch.php?username=$username&show=$show';
</script>

";

?>
