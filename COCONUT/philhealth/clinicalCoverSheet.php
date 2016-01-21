<?php
include("../../myDatabase1.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database1();

$ro->getPatientProfile($registrationNo);

?>

<script type="text/javascript" src="http://<?php echo $ro->getMyUrl(); ?>/jquery1.11.1.js"></script>

<script>
$( document ).ready(function() {
$('input.pd').on('change', function() {
$('input.pd').not(this).prop('checked', false);  
$("#patientDisposition").submit();
});
});

</script>

<script type="text/javascript">


function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
</script>

<div id='printData'>
<a href="#" onClick="printF('printData');" style="text-decoration:none; color:black;"><b><?php echo "<center><font size=6>".$ro->getReportInformation("hmoSOA_name")."</font></center>"; ?></b></a>

<?php

echo " <style type='text/css'>  ";
echo "
.registrationNo {
border-color:transparent transparent black transparent;
width:150px;
font-size:17px;
color:black;
}

.patientName {
border-color:transparent transparent black transparent;
width:92%;
font-size:17px;
}

.age {
border-color:transparent transparent black transparent;
width:635px;
font-size:17px;
}


.address {
border-color:transparent transparent black transparent;
font-size:17px;
width:89%;
}

.dateAdmitted {
border-color:transparent transparent black transparent;
font-size:17px;
width:82%;
}


.dateDischarged {
border-color:transparent transparent black transparent;
font-size:17px;
width:80%;
}



.admittingDiagnosis {
border-color:transparent transparent black transparent;
font-size:17px;
width:75%;
}


.finalDiagnosis {
border-color:transparent transparent black transparent;
font-size:17px;
width:80%;
}


.icd10 {
border-color:transparent transparent black transparent;
font-size:16px;
width:90%;
}


.remarks {
border-color:transparent transparent black transparent;
font-size:16px;
width:560px;
}


.positi0n {
border-color:transparent transparent transparent transparent;
font-size:14px;
width:250px;
}


";
echo "</style>";

echo "<center>";

echo "<font size=2><b>\"YOUR CHOICE IN PASSIONATE AND QUALITY HEALTHCARE\"</b></font>";
echo "<br>";
echo "<font size=2><b>Ledesma St,Tacurong City,Sultan Kudarat,Philipines,9800</b></font>";
echo "<br>";
echo "<font size=2>TEL NO.(064) 200-3201 FAX NO.(064) 200-4472</font>";
echo "<br><br><br><Br>";
echo "<font size=4>Clinical Cover Sheet</font>";
echo "<br><br><br><br>";
echo "<table border=0 width=55% cellspacing=0>";
echo "<tr>";
echo "<td>Reg No: <input type='text' value='$registrationNo' class='registrationNo'> </td>";
echo "<td align='right'>Case No: <input type='text' value='' class='registrationNo'> </td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 width=55% >";
echo "<tr>";
echo "<td>Name: <input type='text' value='".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."' class='patientName'> </td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 width=55% cellspacing=0>";
echo "<tr>";
echo "<td>Age: <input type='text' value='".$ro->getPatientRecord_age()."' class='registrationNo'> </td>";
echo "<td>Sex: <input type='text' value='".$ro->getPatientRecord_gender()."' class='registrationNo'> </td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 width=55% >";
echo "<tr>";
echo "<td>Address: <input type='text' value='".$ro->getPatientRecord_address()."' class='address'> </td>";
echo "</tr>";

echo "<tr>";
echo "<td>Date Admitted: <input type='text' value='".$ro->getRegistrationDetails_dateRegistered()."' class='dateAdmitted'> </td>";
echo "</tr>";

echo "<tr>";
echo "<td>Date Discharged: <input type='text' value='".$ro->getRegistrationDetails_dateUnregistered()."' class='dateDischarged'> </td>";
echo "</tr>";

$ro->clinicalCoverSheet_atteding($registrationNo);

echo "<tr>";
echo "<td>Admitting Diagnosis: <input type='text' value='".$ro->getRegistrationDetails_IxDx()."' class='admittingDiagnosis'> </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color='white'>Admitting Diagnosis:</font> <input type='text' value='' class='admittingDiagnosis'> </td>";
echo "</tr>";



if( $ro->selectNow("patientICD","diagnosis","registrationNo",$registrationNo) != "" ) {
echo "<tr>";
echo "<td><font>Final Diagnosis:</font> <input type='text' value='".substr($ro->clinicalCoverSheet_finalDiagnosis($registrationNo),0,56)."' class='finalDiagnosis'> </td>";
echo "</tr>";


if( strlen($ro->clinicalCoverSheet_finalDiagnosis($registrationNo)) > 56 ) {
echo "<tr>";
echo "<td><font color='white'>Final Diagnosis:</font> <input type='text' value='".substr($ro->clinicalCoverSheet_finalDiagnosis($registrationNo),56,56)."' class='finalDiagnosis'> </td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td><font color='white'>Final Diagnosis:</font> <input type='text' value='' class='finalDiagnosis'> </td>";
echo "</tr>";
}





if( strlen($ro->clinicalCoverSheet_finalDiagnosis($registrationNo)) > 112 ) {
echo "<tr>";
echo "<td><font color='white'>Final Diagnosis:</font> <input type='text' value='".substr($ro->clinicalCoverSheet_finalDiagnosis($registrationNo),112,56)."' class='finalDiagnosis'> </td>";
echo "</tr>";
}else { }

if( strlen($ro->clinicalCoverSheet_finalDiagnosis($registrationNo)) > 168 ) {
echo "<tr>";
echo "<td><font color='white'>Final Diagnosis:</font> <input type='text' value='".substr($ro->clinicalCoverSheet_finalDiagnosis($registrationNo),168,56)."' class='finalDiagnosis'> </td>";
echo "</tr>";
}else { }

}else {

echo "<tr>";
echo "<td><font>Final Diagnosis:</font> <input type='text' value='' class='finalDiagnosis'> </td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color='white'>Final Diagnosis:</font> <input type='text' value='' class='finalDiagnosis'> </td>";
echo "</tr>";


}

if( $ro->selectNow("patientICD","icdCode","registrationNo",$registrationNo) != "" ) {
echo "<tr>";
echo "<td><font>ICD 10:</font> <input type='text' value='".$ro->clinicalCoverSheet_icdCode($registrationNo)."' class='icd10'> </td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td><font>ICD 10:</font> <input type='text' value='' class='icd10'> </td>";
echo "</tr>";
}

echo "</table>";

echo "<br>";
echo "<Table border=0 width=55%>";
echo "<tr>";
echo "<tD>Diagnostic on discharge</td>";
echo "</tr>";
echo "</table>";

$improved="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "improved" ) ? $improved="checked" : $improved="";

$transferred="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "transferred" ) ? $transferred="checked" : $transferred="";

$hama="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "hama" ) ? $hama="checked" : $hama="";

$absconded="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "absconded" ) ? $absconded="checked" : $absconded="";

$expired="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "expired" ) ? $expired="checked" : $expired="";

$unimproved="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "unimproved" ) ? $unimproved="checked" : $unimproved="";

$mgh_per_request="";
( $ro->selectNow("registrationDetails","patientDisposition","registrationNo",$registrationNo) == "mgh per request" ) ? $mgh_per_request="checked" : $mgh_per_request="";

echo "<form id='patientDisposition' method='get' action='http://".$ro->getMyUrl()."/COCONUT/philhealth/revisedSep2013/patientDisp.php'>";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("from","clinicalCoverSheet");
echo "<Table border=0 width=55%>";
echo "<tr>";
echo "<td><input name='patientDisp[]' type='checkbox' value='improved' class='pd' $improved> Improved</td>";
echo "<td><input name='patientDisp[]' type='checkbox' value='transferred' class='pd' $transferred > Transferred</td>";
echo "<td><input name='patientDisp[]' type='checkbox' value='hama' class='pd' $hama> Hama</td>";
echo "<td><input name='patientDisp[]' type='checkbox' value='absconded' class='pd' $absconded > Absconded</td>";
echo "</tr>";
echo "</table>";

echo "<Table border=0 width=55%>";
echo "<tr>";
echo "<td><input name='patientDisp[]' type='checkbox' value='expired' class='pd' $expired > Expired</td>";
echo "<td><input name='patientDisp[]' type='checkbox' value='unimproved' class='pd' $unimproved > Unimproved</td>";
echo "<td><input name='patientDisp[]' type='checkbox' value='mgh per request' class='pd' $mgh_per_request > MGH Per Request</td>";
echo "</tr>";
echo "</table>";
echo "</form>";

?>
</div>
