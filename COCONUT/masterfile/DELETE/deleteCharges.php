<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$description = $_GET['description'];
$chargesCode = $_GET['chargesCode'];


$ro = new database();

$ro->deleteNow("availableCharges","chargesCode",$chargesCode);

echo "

<script type='text/javascript'>
alert('$description is now deleted in the list of Charges');
</script>

";

?>
