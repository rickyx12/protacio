<?php
include("../../../myDatabase.php");
$inventoryCode = $_GET['inventoryCode'];
$username = $_GET['username'];
$description = $_GET['description'];

$ro = new database();

//$ro->deleteNow("inventory","inventoryCode",$inventoryCode);

$ro->editNow("inventory","inventoryCode",$inventoryCode,"status","DELETED_".$username);

echo "
<script type='text/javascript'>
alert('$description is now deleted in the inventory');
</script>

";

?>
