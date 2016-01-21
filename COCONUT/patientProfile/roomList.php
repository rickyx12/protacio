<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();
$ro->getPatientProfile($registrationNo);

//if( $ro->getRegistrationDetails_dateUnregistered() == "" ) {
//echo "<br><Br><Br><Br><BR><center><font color=red>Pls Discharge the patient first before you add a room</font></center>";
//}else {
$ro->coconutDesign();
$ro->getPatientProfile($registrationNo);
echo "<br><Br><br><Br>";
$ro->coconutBoxStart("600","100");
echo "<br>";
$ro->coconutFormStart("get","roomList1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("originalRoom", $ro->getRegistrationDetails_room() );
echo "<table border=0>";
echo "<td>".$ro->coconutText("Available Rooms:&nbsp;")."</tD>";
echo "<Td>";
echo "<select name='roomz' class='comboBox'>";
echo "<option value='".$ro->getRegistrationDetails_room()."'>".$ro->getRegistrationDetails_room()."</option>";
$ro->showVacantRoom($ro->getRegistrationDetails_branch());
echo "</select>";
echo "</td>";
echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutBoxStop();
//}
?>
