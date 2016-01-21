<?php
include("../../myDatabase.php");
$labNo = $_GET['labNo'];
$description = $_GET['description'];
$ro = new database();

$ro->deleteNow("laboratoryResults","labNo",$labNo);
$ro->deleteNow("laboratoryResultsValue","labNo",$labNo);

echo "

<script type='text/javascript'>
alert('$description Results is now Deleted');
</script>

";

?>
