<?php
include("../../../myDatabase.php");
$cuz = new database();

mysql_connect($cuz->myHost(),$cuz->getUser(),$cuz->getPass());
mysql_select_db($cuz->getDB());

$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$type = $_GET['type'];
$dept = $_GET['dept'];

$uname = $_POST['uname'];
$delpass = $_POST['delpass'];

$asql=mysql_query("SELECT * FROM registeredUser WHERE username='$uname' AND password='$delpass'");
$acount=mysql_num_rows($asql);
$dateRegistered=$cuz->selectNow("registrationDetails","dateRegistered","registrationNo",$registrationNo);

if($acount!=0){
$date=date("Y-m-d");
$time=date("H:i:s");

$delete = "DELETED_".$uname."[".$date."@".$time."]_".$dateRegistered;
//$ro->deleteNow("registrationDetails","registrationNo",$registrationNo);
$cuz->EditNow("registrationDetails","registrationNo",$registrationNo,"dateRegistered",$delete);

echo "<center><Br><br><Br><br><font color=red size=5>Successfully Deleted</font>";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=registrationCensus.php?username=$username&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&type=$type&dept=$dept'>";
}
else{
echo "<center><Br><br><Br><br><font color=red size=5>You are not authorized to delete the Patient.</font>";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=registrationCensus.php?username=$username&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&type=$type&dept=$dept'>";
}

?>
