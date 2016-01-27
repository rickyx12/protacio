<?php
include("../../myDatabase.php");
$radioNo = $_GET['radioNo'];
$description = $_GET['description'];
$ro = new database();

$ro->deleteNow("radiologyResults","radioNo",$radioNo);
echo "

<script type='text/javascript'>
alert('$description Results is now Deleted');
</script>

";

?>
