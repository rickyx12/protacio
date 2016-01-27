<?php
include("../../myDatabase.php");
$soapNo = $_GET['soapNo'];
$description = $_GET['description'];
$ro = new database();

$ro->deleteNow("SOAP","soapNo",$soapNo);

echo "

<script type='text/javascript'>
alert('$description S.O.A.P is now Deleted');
</script>

";

?>
