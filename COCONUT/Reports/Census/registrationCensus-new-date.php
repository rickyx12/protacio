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

?>

<script src="../../js/jquery-2.1.4.min.js"></script>
<script src="../../js/open.js"></script>
<script>
	$(document).ready(function(){


		var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

		if( isChrome == true ) {
			$("#export").click(function(result){
				var data='<table>'+$("#census").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
				var reportName = '<? echo 'Census '.$type.' ['.$ro4->formatDate($fromRegistered).' to '.$ro4->formatDate($toRegistered).' ]' ?>';
				/*
				$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ><input type='text' name='reportName' value='"+reportName+"'></form>");
				*/
				
				$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><textarea name='tableData'>"+data+"</textarea><input type='text' name='reportName' value='"+reportName+"'></form>");
				
				 $('#ReportTableData').submit().remove();
				 return false;	
			});	
		}else {
			$("#export").hide();
		}


	});
</script>

<?php

echo "<center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='60%' height='20%'></center>";

echo "<font size=5>Registration Census For $type</font>";
echo "<br><font size=2>(".$ro4->formatDate($fromRegistered)." to ".$ro4->formatDate($toRegistered).")</font>";


//$ro->censusRegistered($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type,$dept,$username);

echo "
<style type='text/css'>
#rowz:hover {
background-color:yellow;
}

.header {
	background-color:#3b5998;
	color:#ffffff;
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

echo "<a href='#' id='export'><img src='../../../export-to-excel/excel-icon.png'></a>";
echo "<br>";
echo "<Table id='census' border=1 cellpadding=0 rules=all cellspacing=0 >";
echo "<tr>";
	echo "<th class='header'>Name</th>";
	echo "<th class='header'>Age</th>";
	echo "<th class='header'>Gender</th>";
	echo "<th class='header'>Service</th>";
	echo "<th class='header'>PHIC</th>";
	echo "<th class='header'>Insurance</th>";
	echo "<th class='header'>Attending</th>";
	echo "<th class='header'>Registered</th>";
	echo "<th class='header'>Registered By</th>";
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
			if( $row['phic'] == "YES" ) {
				echo "<td>NH</td>";
			}else {
				echo "<td>NN</td>";
			}
			echo "<td>".$row['Company']."</td>";
			echo "<td>".$ro->getAttendingDoc($row['registrationNo'],"ATTENDING")."</td>";
			echo "<td>".$row['timeRegistered']."@".$row['dateRegistered']."</td>";
			echo "<td>".$row['registeredBy']."</td>";
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
	echo "</tr>";

?>
