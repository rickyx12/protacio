<?php
include("../../../myDatabase.php");
require_once('../authentication.php');
$requestNo = $_POST['requestNo'];
$username = $_POST['username'];
$date = $_POST['date'];
$status = $_POST['status'];



$ro = new database();

$ro->editNow("admin2request","requestNo",$requestNo,"status",$status."_".$username);
$ro->editNow("admin2request","requestNo",$requestNo,"status_time",$ro->getSynapseTime());
$ro->editNow("admin2request","requestNo",$requestNo,"status_date",date("Y-m-d"));
$ro->editNow("admin2request","requestNo",$requestNo,"status_encodeIn",getenv("REMOTE_ADDR")."-".php_uname("n"));
//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/table.php?date=$date");
/*
echo "
<script>
setTimeout(function(){ history.go(-1); return false; },3000);
</script>
";
*/

echo "<Br><br><br><br><Br><Br><Br>";
echo "<CenteR>";
$ro->coconutImages("ajax-loader.gif");
if( $status == "APPROVED" ){
echo "&nbsp;&nbsp;&nbsp;&nbsp;Please Wait While Approving.....";
}else {
echo "&nbsp;&nbsp;&nbsp;&nbsp;Please Wait While Cancelling.....";
}
echo "</center>"

?>

