<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database2();


echo "<style type='text/css'>

.editable{
	border: 1px solid #000;
	color: #000;
	height: 15px;
	width: 80px;
	border-color:white white white white;
	font-size:10px;
	text-align:center;
}


</style>";


$ro->getPatientProfile($registrationNo);

echo "<center><font size=4>".$ro->getReportInformation("hmoSOA_name")."</font></center>";
echo "<center><font size=3>".$ro->getReportInformation("hmoSOA_address")."</font></center>";
echo "<center><font size=2>Tel no. (062) 2143237</font></center>";

echo "<br><Br><Br><br>";
echo "<table border=0 cellspacing=0>";
echo "<tr>";
echo "<td><b>PATIENT:</b></td>";
echo "<tD>".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td><b>DATE DISCHARGED:</b></tD>";
echo "<td>".$ro->getRegistrationDetails_dateUnregistered()."</td>";
echo "</tr>";


echo "<tr>";
echo "<td><b>DATE ADMITTED:</b>&nbsp;</td>";
echo "<tD>".$ro->getRegistrationDetails_dateRegistered()."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td><b>TIME DISCHARGED:</b></tD>";
echo "<td>".$ro->getRegistrationDetails_timeUnregistered()."</td>";
echo "</tr>";


echo "<tr>";
echo "<td><b>TIME ADMITTED:</b></td>";
echo "<tD>".$ro->getRegistrationDetails_timeRegistered()."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td><b>ROOM:</b></tD>";
$romz = preg_split ("/\-/", $ro->getRegistrationDetails_room() ); 
echo "<td>".$romz[0]."</td>";
echo "</tr>";

echo "<tr>";
echo "<Td><b>PHYSICIAN:</b>&nbsp;</tD>";
echo "<tD>".$ro->getAttendingDoc($registrationNo,"Attending")."</tD>";
echo "</tr>";
echo "</table>";

echo "<Br><Br><Br><Br>";


echo "<Table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HOSPITAL CHARGES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;&nbsp;ACTUAL&nbsp;&nbsp;</th>";
echo "<th>&nbsp;&nbsp;MEDICARE&nbsp;&nbsp;</th>";
echo "<th>&nbsp;&nbsp;EXCESS&nbsp;&nbsp;</th>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b>A.&nbsp;ROOM</b> ".$ro->doubleSelectNow("patientCharges","quantity","registrationNo",$registrationNo,"description",$ro->selectNow("registrationDetails","room","registrationNo",$registrationNo))." DAYS AT ".$ro->selectNow("room","rate","Description",$ro->getRegistrationDetails_room())."</td>";

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

echo "<td>&nbsp;".number_format($ro->doubleSelectNow("patientCharges","total","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room()),2)."</tD>";

echo "<td>&nbsp;".number_format($ro->doubleSelectNow("patientCharges","phic","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room()),2)."</tD>";

echo "<td>&nbsp;".number_format($ro->doubleSelectNow("patientCharges","company","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room()),2)."</tD>";

echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b>B.&nbsp; DRUGS AND MEDICINES</b></tD>";
echo "<tD>&nbsp;<b>QTY</b></tD>";
echo "<tD>&nbsp;<b>UNIT COST</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tR>";

$ro->hmo_meds($registrationNo);

echo "<tr>";
echo "<Td>&nbsp;<b>SUBTOTAL</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value='".number_format($ro->hmo_meds_total(),2)."'></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value=''></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value=''></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<B>C.XRAY,LABORATORY TEST AND OTHERS</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";

$ro->hmo_others($registrationNo);

echo "<tr>";
echo "<Td>&nbsp;<b>SUBTOTAL</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value='".number_format($ro->hmo_others_total(),2)."'></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value='' ></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value='' ></tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;<b>D.OPERATING ROOM FEE</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->doubleSelectNow("patientCharges","hmoPrice","registrationNo",$registrationNo,"description","OPERATING ROOM FEE")."</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<b>E.MISCELLANEOUS</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getTotal("hmoPrice","MISCELLANEOUS",$registrationNo)."</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getTotal("company","MISCELLANEOUS",$registrationNo)."</tD>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<b>F.OXYGEN</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getTotal("hmoPrice","OXYGEN",$registrationNo)."</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<b>G.NURSING CARE</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;".$ro->getTotal("hmoPrice","NURSING-CHARGES",$registrationNo)."</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;<b>H.PROFESSIONAL FEE</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value='".$ro->getTotal("hmoPrice","PROFESSIONAL FEE",$registrationNo)."'></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value=''></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value=''></tD>";
echo "</tr>";


echo "<tr>";
echo "<td><center>SURGEON</center></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<td><center>ASSISTANT</center></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";


echo "<tr>";
echo "<td><center>ANESTHESIOLOGIST</center></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";

$grandTotal = ( $ro->doubleSelectNow("patientCharges","total","registrationNo",$registrationNo,"description",$ro->getRegistrationDetails_room()) + $ro->hmo_meds_total() + $ro->hmo_others_total() + $ro->doubleSelectNow("patientCharges","hmoPrice","registrationNo",$registrationNo,"description","OPERATING ROOM FEE") + $ro->getTotal("hmoPrice","MISCELLANEOUS",$registrationNo) + $ro->getTotal("hmoPrice","OXYGEN",$registrationNo) + $ro->getTotal("hmoPrice","NURSING-CHARGES",$registrationNo) + $ro->getTotal("hmoPrice","PROFESSIONAL FEE",$registrationNo) );

echo "<tr>";
echo "<td><center><B>GRAND TOTAL</b></center></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value='".number_format($grandTotal,2)."'></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value=''></tD>";
echo "<Td>&nbsp;<input type='text' class='editable' value=''></tD>";
echo "</tr>";


echo "</table>";


?>
