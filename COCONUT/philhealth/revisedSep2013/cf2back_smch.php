<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();

echo "

<style type='text/css'>
.amount{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width:200px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;
}

.amount1{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width:120px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;
}

.signature1{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 350px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;
}


.signature2{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 200px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;
}


</style>

";

echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><b>10.Professional Fees / Charges (use addditional Sheet if necessary)</b></font></td>";
echo "</tr>";
echo "</table>";
$ro->getChargesAndPFinNewCF2($registrationNo);
echo "<br><center><table style='width:860px; border:1px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><b>PART III-CERTIFICATION OF CONSUMPTION OF BENEFITS AND CONSENT TO ACCESS PATIENT RECORD/S</b></font></td>";
echo "</tr>";
echo "</table>";
echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><b>A.CERTIFICATION OF CONSUMPTION OF BENEFITS</b></font></td>";
echo "</tr>";
echo "<tr>";
echo "<Td>&nbsp;&nbsp;&nbsp;<font size=2><B><i>Statement of Account (SOA) is attached mounting to P</i></b></font><input type='text' class='amount'></td>";
echo "</tr>";
echo "<tr>";
echo "<td> &nbsp;&nbsp; <font size=2><b>(tick one that applies)</b></font> </td>";
echo "</tr>";
echo "<tr>";
echo "<Td><input type='checkbox'><font size=2>No outside purchases of drugs/medicines,supplies,diagnostics, and co-pay for professional fees from member/patient.<br> &nbsp;&nbsp;&nbsp;&nbsp;PhilHealth benefit is enough to cover facility and PF chargess. </font></td>";
echo "</tr>";
echo "<tr>";
echo "<Td><input type='checkbox'><font size=2> The benefits of the member/patient was completely used up prior to co-pay<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The total co-pay for the following is/are: </font></td>";
echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size=2>HCI Charges</font> </td>";
echo "<td> P<input type='text' class='amount1'> <input type='checkbox'>None  </td>";
echo "</tr>";

echo "<Tr>";
echo "<Td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size=2>Outside purchase/s for drugs/medicine and/or medical supplies not paid for by the HCI</font> </td>";
echo "<td> P<input type='text' class='amount1'> <input type='checkbox'>None  </td>";
echo "</tr>";

echo "<Tr>";
echo "<Td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size=2>Cost of diagnostic/laboratory examinations done outside not paid for by the HCI</font> </td>";
echo "<td> P<input type='text' class='amount1'> <input type='checkbox'>None  </td>";
echo "</tr>";

echo "<Tr>";
echo "<Td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size=2> Total Co-pay for Professional Fee/s (including non-accredited health care professionals) </font> </td>";
echo "<td> P<input type='text' class='amount1'> <input type='checkbox'>None  </td>";
echo "</tr>";

echo "<Tr>";
echo "<Td align='right'> <font size=3> TOTAL CO-PAY </font>&nbsp;&nbsp;&nbsp;&nbsp; </td>";
echo "<td> P<input type='text' class='amount1'> <input type='checkbox'>None  </td>";
echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><b>B.<i>CONSENT TO ACCESS PATIENT RECORD/S</i></b></font> </td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=2>I hereby consent to the examination by PhilHealth of the patient's medical records for the sole purpose of verifying the veracity of this claim</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=2> I hereby hold PhilHealth or any of its officers,employees and/or representatives free from any and all liabilities relative to the herein-mentioned consent which I have voluntarily and willingly give-in connection with this claim for reimbursement before PhilHealth:  </font></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font size=2><b> Conforme of patient/authorized representative: </b></font>
<br>
<input type='text' class='signature1'>
<Br>
<font size=1> Signature Over Printed Name of Patient/Authrorized Representative </font>
<br><br>
<font size=2>Date Signed</font> <input type='text' class='box'><input type='text' class='box1'>-<input type='text' class='box'><input type='text' class='box1'>-<input type='text' class='box'><input type='text' class='box1'><input type='text' class='box1'><input type='text' class='box1'>
<Br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <font size=1>month-day-year</font>
</td>";
echo "</tr>";
echo "</table>";

echo "<br>";

echo "<table style='width:560px; float:center-left; display:inline-block;' border='0px;' >";
echo "<Tr>";
echo "<Td><font size=2>Relationship of the<Br>representative to the patient:</font></td><td> <input type='checkbox'><font size=2>Spouse</font> &nbsp;<input type='checkbox'><font size=2>Child</font>&nbsp;<input type='checkbox'><font size=2>Parent</font>
<br>
<input type='checkbox'><font size=2>Sibling</font>&nbsp;
<input type='checkbox'><font size=2>Others,Specify</font><input type='text' class='amount1'>
 </td>";
echo "</tr>";

echo "<tr>";
echo "<Td><font size=2>Reason for signing on <Br on behalf of the patient:</font></td>";
echo "<td><input type='checkbox'><font size=2>Patient is Incapacitated</font>
<br>
<input type='checkbox'><font size=2>Other Reasons:<input type='text' class='amount1'></font>
</td>";
echo "</tr>";

echo "</table>";



echo "<table style='width:300px; float:center-right; display:inline-block;' border='0px;' >";
echo "<Tr>";
echo "<Td>
<font size=1>
If patient/representative is unable to write put right thumbmark.patient/representative<Br>should be assisted by an HCI representative.
Check the appropriate box:
</font>
<br>
<input type='checkbox'><font size=1>Patient</font>
&nbsp;
<input type='checkbox'><font size=1>Representative</font>
</td>";
echo "<td>
<div style='border:1px solid #000; width:120px; height:120px;'>
</div>
</td>";
echo "</tr>";

echo "</tr>";

echo "</table>";

echo "<center><table style='width:860px; border:1px solid #000;' >";
echo "<Tr>";
echo "<Th> <font size=2><b>PART IV - CERTIFICATION OF HEALTH CARE INSTITUTION</b></font> </th>";
echo "</tr>";
echo "</table>";

echo "<center><table style='width:860px;' >";
echo "<Tr>";
echo "<Td> <font size=2><b><i>I certify that services rendered were recorded in the patient's chart and health care institution records and that the herein information given are true and correct</i></b></font> </td>";
echo "</tr>";
echo "</table>";

echo "<center><table style='width:860px;' >";
echo "<Tr>";
echo "
<Td> 
<input type='text' class='signature2' value='MARIBETH B. SANDIG'>
<br>
<font size=1>Signature Over Printed Name of Authrorized <br>HCI Representative</font>
</td>";

echo "
<Td> 
<input type='text' class='signature2' value='HOSPITAL ADMINISTRATOR'>
<br>
<font size=1>Official Capacity/Designation</font>
</td>";

echo "
<Td> 
<font size=2>Date Signed:</font> <input type='text' class='box'><input type='text' class='box1'>-<input type='text' class='box'><input type='text' class='box1'>-<input type='text' class='box'><input type='text' class='box1'><input type='text' class='box1'><input type='text' class='box1'>
<Br>
<span style='margin:0 0 0 130px;'><font size=1>month-day-year</font></span>
</td>";

echo "</tr>";
echo "</table>";


?>
