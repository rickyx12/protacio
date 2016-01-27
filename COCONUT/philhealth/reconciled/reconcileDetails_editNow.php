<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$reconcileNo = $_GET['reconcileNo'];
$refno = $_GET['refno'];
$amount = $_GET['amount'];
$month = $_GET['month'];
$day = $_GET['day'];
$year = $_GET['year'];
$remarks = $_GET['remarks'];

$ro = new database2();

$date = $month."_".$day."_".$year;


$ro->doubleEditNow("phicReconcile","reconcileNo",$reconcileNo,"registrationNo",$registrationNo,"refno",$refno);
$ro->doubleEditNow("phicReconcile","reconcileNo",$reconcileNo,"registrationNo",$registrationNo,"amount",$amount);
$ro->doubleEditNow("phicReconcile","reconcileNo",$reconcileNo,"registrationNo",$registrationNo,"date",$date);
$ro->doubleEditNow("phicReconcile","reconcileNo",$reconcileNo,"registrationNo",$registrationNo,"remarks",$remarks);

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
