<?php
include("../../../myDatabase.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];
$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$type = $_GET['type'];
$dept = $_GET['dept'];

$ro = new database();
$ro->getPatientProfile($registrationNo);


mysql_connect($ro->myHost(),$ro->getUser(),$ro->getPass());
mysql_select_db($ro->getDB());

$asql=mysql_query("SELECT * FROM patientCharges WHERE registrationNo='$registrationNo' AND status NOT LIKE 'DELETED_%%%%'");
$acount=mysql_num_rows($asql);

if($acount!=0){
$ro->coconutFormStart("get","selectShift_registered.php?username=$username");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
echo "<Br><Br><br><br><br><Br>";
$ro->coconutBoxStart_red("600","120");
echo "<br>	";
echo "<font size=3 color=red>Unable to delete ".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." with a registration No#: ".$registrationNo.".<br>You must delete all charges before you can delete this patient.</font>";
echo "<br><br>";
$ro->coconutButton("Back");
$ro->coconutBoxStop();
$ro->coconutFormStop();
}
else{
$ro->coconutFormStart("post","registrationCensusDelete1.php?registrationNo=$registrationNo&username=$username&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&type=$type&dept=$dept");
echo "<Br><Br><br><br><br><Br>";
$ro->coconutBoxStart_red("600","148");
echo "<br>	";
echo "<font size=3 color=red>You are about to delete the record of ".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." <br>with a registration No#: ".$registrationNo." and register by ".$ro->getRegistrationDetails_registeredBy()."</font>";
echo "<br><br>Enter Authorized Username and Password to Delete Patient<br>";
echo "<input type='text' name='uname' placeholder='Username' autocomplete='off' value='' size='10' /><input type='password' name='delpass' placeholder='Password' autocomplete='off' value='' size='10' /><br /><br />";
$ro->coconutButton("Delete");
$ro->coconutBoxStop();
$ro->coconutFormStop();
}

?>
