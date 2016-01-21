<?php
include("../../../myDatabase.php");
$reconcileNo = $_GET['reconcileNo'];
$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->deleteNow("phicReconcile","reconcileNo",$reconcileNo);

echo "
<script language='javascript' type='text/javascript'>
function closeWindow() {
window.open('','_parent','');
window.close();
}
</script> 
";

echo "<Br><Br><Br>";
echo "<a href='javascript:closeWindow();' style='text-decoration:none; color:red;'>CLOSE</a>";

?>
