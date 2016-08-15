<?php
include("../../../myDatabase.php");
include "../../../myDatabase4.php";

$fromRegistered = $_POST['fromRegistered'];
$toRegistered = $_POST['toRegistered'];
$type = $_POST['type'];
$dept = $_POST['dept'];

$ro = new database();
$ro4 = new database4();

echo "<center>";
//echo "<font size=6>".$ro->getReportInformation("hmoSOA_name")."</font>";
//echo "<br><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font>";
//echo "<Br><font size=3>($branch)</font>";

echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='60%' height='20%'></center>";

echo "<font size=5>Registration Census For $type</font>";
echo "<br><font size=2>(".$ro4->formatDate($fromRegistered)." to ".$ro4->formatDate($toRegistered).")</font>";


//$ro->censusRegistered($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type,$dept,$username);

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
}
</style>
";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($ro->myHost(), $ro->getUser(), $ro->getPass()));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $ro->getDB()));
/*
$fromRegistered = $fromYear."-".$fromMonth."-".$fromDay;
$toRegistered = $toYear."-".$toMonth."-".$toDay;
*/
if( $dept != "" ) {
if($type == "IPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE rd.patientNo = pr.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered' ) and rd.type in ('IPD','ER','OR/DR','ICU') and rd.registeredFrom='$dept' order by dateRegistered,timeRegistered asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE rd.patientNo = pr.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered') and rd.type='$type' and rd.registeredFrom='$dept' and rd.pxCount > 0 order by dateRegistered,timeRegistered asc ");
}
}else {

if($type == "IPD") {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE rd.patientNo = pr.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered' ) and rd.type in ('IPD','ER','OR/DR','ICU') order by dateRegistered,timeRegistered asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,upper(pr.middleName) as middleName,rd.*,pr.Age,pr.Gender,pr.phic FROM patientRecord pr,registrationDetails rd WHERE rd.patientNo = pr.patientNo and (dateRegistered between '$fromRegistered' and '$toRegistered') and rd.type='$type' and rd.pxCount > 0 order by dateRegistered,timeRegistered asc ");
}

}


echo "<br>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Name");
$ro->coconutTableHeader("Age");
$ro->coconutTableHeader("Gender");
$ro->coconutTableHeader("Service");
$ro->coconutTableHeader("PHIC");
$ro->coconutTableHeader("Insurance");
$ro->coconutTableHeader("Attending");
$ro->coconutTableHeader("Registered");
$ro->coconutTableHeader("Registered By");
//$ro->coconutTableHeader("");
$ro->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
if($row['firstName']=="N/A"){
}
else{
echo "<Tr id='rowz'>";
$ro->censusRegistered_patient += 1;
$ro->coconutTableData($row['lastName']." ".$row['firstName']." ".$row['middleName']);
$ro->coconutTableData($row['Age']);
$ro->coconutTableData($row['Gender']);
$ro->coconutTableData($ro->selectNow("Doctors","Specialization1","Name",$ro->getAttendingDoc($row['registrationNo'],"ATTENDING")));

if( $row['phic'] == "YES" ) {
$ro->coconutTableData("NH");
}else {
$ro->coconutTableData("NN");
}
$ro->coconutTableData($row['Company']);
$ro->coconutTableData($ro->getAttendingDoc($row['registrationNo'],"ATTENDING"));
$ro->coconutTableData($row['timeRegistered']."@".$row['dateRegistered']);
$ro->coconutTableData($row['registeredBy']);
//$ro->coconutTableData("<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/Census/registrationCensusDelete.php?registrationNo=$row[registrationNo]&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&type=$type&dept=$dept'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
echo "</tr>";

  }
}
$ro->coconutTableData("<b>TOTAL PATIENT</b>");
$ro->coconutTableData("<b>".$ro->censusRegistered_patient."</b>");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableStop();


?>
