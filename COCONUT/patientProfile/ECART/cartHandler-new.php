<?php
require_once "../../authentication.php";
include("../../../myDatabase.php");
$inventoryLocation = $_POST['inventoryLocation'];
$batchNo = $_POST['batchNo'];
$registrationNo = $_POST['registrationNo'];
$room = $_POST['room'];




$ro = new database();
$username = $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']);
$incrementBatchNo = ( $ro->selectNow("trackingNo","value","name","batchNo") + 1 );
$ro->editNow("trackingNo","name","batchNo","value",$incrementBatchNo);
/*
$ro->getBatchNo();
$myFile = "/opt/lampp/htdocs/COCONUT/trackingNo/batchNo.dat";
$fh = fopen($myFile, 'r');
$batchNo = fread($fh, 100);
fclose($fh);
*/


/*
echo "
<frameset rows='25%,185%,85%' framespacing='0' border='1'>
   <frame src='cartSelection.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo'  scrolling=no frameborder=1 framespacing=1 name='selection' />
   <frame src='#' frameborder=1 framespacing=1 name='selectedFrame' />
   <frame src='showCart_update.php?registrationNo=$registrationNo&batchNo=$batchNo&username=$username' frameborder=1 framespacing=1 />
</frameset>

";

*/
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
if( stripos($ua,'iPad') !== false ) { //solution pra s bug ng ipad na lumalaki ung selection
echo "<iframe src='cartSelection.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' scrolling='no' frameborder='0' width='100%' height='40px;' >
</iframe>";

echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' name='selectedFrame' width='100%' height='400px;' style='border:1px solid #FF0000;' ></iframe>";

}else {
echo "
<iframe src='cartSelection.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' scrolling='no' frameborder='0' width='100%' height='8%' >
</iframe>";

echo "<iframe src='http://".$ro->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$username&room=$room&batchNo=$batchNo' name='selectedFrame' width='100%' height='85%' style='border:1px solid #FF0000;' ></iframe>";

}


?>
