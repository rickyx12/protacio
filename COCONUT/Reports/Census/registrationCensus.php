<?php
include("../../../myDatabase.php");
include "../../../myDatabase4.php";

$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$toMonth = $_GET['toMonth'];
$toDay = $_GET['toDay'];
$toYear = $_GET['toYear'];
$type = $_GET['type'];
$dept = $_GET['dept'];

$ro = new database();
$ro4 = new database4();

echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />";
echo "<center>";
//echo "<font size=6>".$ro->getReportInformation("hmoSOA_name")."</font>";
//echo "<br><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font>";
//echo "<Br><font size=3>($branch)</font>";

echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='60%' height='20%'></center>";

echo "<font size=5>Registration Census For $type</font>";
echo "<br><font size=2>($fromMonth $fromDay, $fromYear - $toMonth $toDay, $toYear)</font>";

$fromRegistered = $fromYear."-".$fromMonth."-".$fromDay;
$toRegistered = $toYear."-".$toMonth."-".$toDay;

//$ro->censusRegistered($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type,$dept,$username);
?>

<script src="../../js/jquery-2.1.4.min.js"></script>
<script>
	$(document).ready(function(){


		var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

		if( isChrome == true ) {
			$("#export").click(function(){
				var data='<table>'+$("#census").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
				var reportName = '<? echo 'Census '.$type.' ['.$ro4->formatDate($fromRegistered).' to '.$ro4->formatDate($toRegistered).' ]' ?>';

				$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ><input type='text' name='reportName' value='"+reportName+"'></form>");
				 $('#ReportTableData').submit().remove();
				 return false;				
			});	
		}else {
			$("#export").hide();
		}


	});
</script>

<?php
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


echo "<a href='#' id='export'><img src='../../../export-to-excel/excel-icon.png'></a>";
echo "<br>";
echo "<Table id='census' border=1 cellpadding=0 rules=all cellspacing=0 >";
echo "<tr>";
echo "<th bgcolor='#3b5998'><font color='white'>Name</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Age</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Gender</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Service</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>PHIC</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Insurance</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Attending</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Registered</font></th>";
echo "<th bgcolor='#3b5998'><font color='white'>Registered By</font></th>";
echo "<th bgcolor='#3b5998'></th>";
/*
$ro->coconutTableHeader("Name");
$ro->coconutTableHeader("Age");
$ro->coconutTableHeader("Gender");
$ro->coconutTableHeader("Service");
$ro->coconutTableHeader("PHIC");
$ro->coconutTableHeader("Insurance");
$ro->coconutTableHeader("Attending");
$ro->coconutTableHeader("Registered");
$ro->coconutTableHeader("Registered By");
$ro->coconutTableHeader("");
*/
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
if($row['firstName']=="N/A"){
}
else{
echo "<Tr id='rowz'>";
$ro->censusRegistered_patient += 1;
echo "<td>".$row['lastName']." ".$row['firstName']." ".$row['middleName']."</td>";
echo "<td>".$row['Age']."</td>";
echo "<td>".$row['Gender']."</td>";
echo "<td>".$ro->selectNow("Doctors","Specialization1","Name",$ro->getAttendingDoc($row['registrationNo'],"ATTENDING"))."</td>";
//$ro->coconutTableData($row['lastName']." ".$row['firstName']." ".$row['middleName']);
//$ro->coconutTableData($row['Age']);
//$ro->coconutTableData($row['Gender']);
//$ro->coconutTableData($ro->selectNow("Doctors","Specialization1","Name",$ro->getAttendingDoc($row['registrationNo'],"ATTENDING")));

if( $row['phic'] == "YES" ) {
//$ro->coconutTableData("NH");
echo "<td>NH</td>";
}else {
//$ro->coconutTableData("NN");
echo "<td>NN</td>";
}
echo "<td>".$row['Company']."</td>";
echo "<td>".$ro->getAttendingDoc($row['registrationNo'],"ATTENDING")."</td>";
echo "<td>".$row['timeRegistered']."@".$row['dateRegistered']."</td>";
echo "<td>".$row['registeredBy']."</td>";
echo "<td><a href='http://".$ro->getMyUrl()."/COCONUT/Reports/Census/registrationCensusDelete.php?registrationNo=$row[registrationNo]&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&type=$type&dept=$dept'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a></td>";
/*
$ro->coconutTableData($row['Company']);
$ro->coconutTableData($ro->getAttendingDoc($row['registrationNo'],"ATTENDING"));
$ro->coconutTableData($row['timeRegistered']."@".$row['dateRegistered']);
$ro->coconutTableData($row['registeredBy']);
$ro->coconutTableData("<a href='http://".$ro->getMyUrl()."/COCONUT/Reports/Census/registrationCensusDelete.php?registrationNo=$row[registrationNo]&fromMonth=$fromMonth&fromDay=$fromDay&fromYear=$fromYear&toMonth=$toMonth&toDay=$toDay&toYear=$toYear&type=$type&dept=$dept'><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
*/
echo "</tr>";

  }
}
echo "<tr>";
echo "<td>Total Patient</td>";
echo "<td>".$ro->censusRegistered_patient."</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "</table>";
/*
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
*/


?>
