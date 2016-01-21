<?php
include("../../myDatabase3.php");

if( isset($_GET['datez']) ) {
$datez = $_GET['datez'];
}else {
$datez = date("Y-m-d");
}

$ro = new database3();

echo "<center><a href='/COCONUT/flow/floatingPx.php?datez=$datez' style='text-decoration:none; color:black;'>OPD Transaction</a>";
echo "<form method='get' action='opdTransaction.php'>";
echo "<input type='text' autocomplete=off name='datez' style='border:1px solid #ff0000;' value='".$datez."'>";
echo "</form>";
$ro->opdTransaction($datez,"no");

?>
