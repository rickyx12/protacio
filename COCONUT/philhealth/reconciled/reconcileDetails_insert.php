<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$refno = $_GET['refno'];
$amount = $_GET['amount'];
$remarks = $_GET['remarks'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];


$ro = new database2();

echo "
<script language='javascript' type='text/javascript'>
function closeWindow() {
window.open('','_parent','');
window.close();
}
</script> 
";
$datez = $month."_".$day."_".$year;

$ro->phicReconcile($registrationNo,$refno,$amount,$remarks,$datez);
echo "<Br><Br><Br>";
echo "<a href='javascript:closeWindow();' style='text-decoration:none; color:red;'>CLOSE</a>";


?>
