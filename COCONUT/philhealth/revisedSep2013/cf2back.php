<?php
include("../../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();

$dateOut = preg_split ("/\-/", $ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo)); 

$monthOut=$dateOut[1];

$monthOut_output1 = substr($monthOut,0,1);
$monthOut_output2 = substr($monthOut,1,1);

$dayOut_output1 = substr($dateOut[2],0,1);
$dayOut_output2 = substr($dateOut[2],1,1);

$yearOut_output1 = substr($dateOut[0],0,1);
$yearOut_output2 = substr($dateOut[0],1,1);
$yearOut_output3 = substr($dateOut[0],2,1);
$yearOut_output4 = substr($dateOut[0],3,1);

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
	font-size:13px;
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
echo "<Td><center> <font size=2><b>PART III-CERTIFICATION OF CONSUMPTION OF BENEFITS AND CONSENT TO ACCESS PATIENT RECORD/S</b><br>NOTE: Member/Patient should sign only after the applicable charges have been filled-out</font> </center> </td>";
echo "</tr>";
echo "</table>";
echo "<center><table style='width:860px; border-right:0px; border-left:0px; border-bottom:0px; border-top:0px solid #000;' >";
echo "<Tr>";
echo "<Td> <font size=2><b><i>A.CERTIFICATION OF CONSUMPTION OF BENEFITS</i></b></font></td>";
echo "</tr>";
echo "<Tr>";
echo "<td><input type='checkbox'><font size=2>PhilHealth benefit is enough to cover HCI and PF Charges</font> <br> &nbsp;&nbsp; <font size=2> No purchases of drugs/medicines,supplies,diagnostics, and co-pay for professional fees by the member/patient </font> </td>";
echo "</tr>";
echo "</table>";

$ro->phic_DrugsMeds("1",$registrationNo);
$ro->phic_OTHERS($registrationNo);
$actualCharges = ( $ro->getRoomPHIC_total($registrationNo) + $ro->phic_DrugsMeds_totalCharges() + $ro->phic_OTHERS_totalCharges() );
$phicCharges = ( $ro->getRoomPHIC_cover($registrationNo) + $ro->phic_DrugsMeds_totalPHIC() + $ro->phic_OTHERS_totalPHIC() );
$unpaidCharges = ( $actualCharges - $phicCharges );

echo "<center><table style='width:860px;' cellspacing=0 cellpadding=1 border=1 >";
echo "<Tr>";
echo "<Td width='430px;' >&nbsp; </td>";
echo "<td width='430px;'> <center><font size=2>Total Actual Charges*</font></center> </td>";
echo "</tr>";

if( $ro->getTotal("cashUnpaid","",$registrationNo) > 0 ) {

echo "<Tr>";
echo "<td> &nbsp; <font size=2>Total Health Care Institution Fees</font> </td>";
echo "<td> <Center> <input type='text' class='amount' value=''> </center> </td>";
echo "</tr>";

echo "<Tr>";
echo "<td> &nbsp; <font size=2>Total Professional Fees</font> </td>";
echo "<td> <Center> <input type='text' class='amount' value=''> </center> </td>";
echo "</tr>";

echo "<Tr>";
echo "<td> &nbsp; <font size=2> Grand Total </font> </td>";
echo "<td> <Center> <input type='text' class='amount' value=''> </center> </td>";
echo "</tr>";

}else {

echo "<Tr>";
echo "<td> &nbsp; <font size=2>Total Health Care Institution Fees</font> </td>";
echo "<td> <Center> <input type='text' class='amount' value='".number_format($actualCharges,2)."'> </center> </td>";
echo "</tr>";

echo "<Tr>";
echo "<td> &nbsp; <font size=2>Total Professional Fees</font> </td>";
echo "<td> <Center> <input type='text' class='amount' value='".number_format($ro->getTotalPF($registrationNo,"total"),2)."'> </center> </td>";
echo "</tr>";

echo "<Tr>";
echo "<td> &nbsp; <font size=2> Grand Total </font> </td>";
echo "<td> <Center> <input type='text' class='amount' value='".number_format($actualCharges+$ro->getTotalPF($registrationNo,"total"),2)."'> </center> </td>";
echo "</tr>";

}

echo "</table>";



echo "<center><table style='width:860px;' border=0 >";
echo "<Tr>";
echo "<Td><input type='checkbox'><font size=2>The benefit of the member/patient was completely consumed prior to co-pay OR the benefit of the member/patient is not completely consumed BUT with purchases/expenses for drugs/medicines,supplies,diagnostics and others</font> </td>";
echo "</tr>";
echo "<Tr>";
echo "<Td><font size=2>a.) The total co-pay for the following are:</font></td>";
echo "</tr>";
echo "</table>";

echo "<center><table style='width:860px;' border=1 cellspacing=0 >";



echo "<Tr>";
echo "<Td> &nbsp; </td>";
echo "<td> <font size=1>Total Actual Charges*</font> </td>";
echo "<td> <font size=1>Amount after application of<Br> Discount (i.e., Personal <Br>Discount,Senior Citizen/PWD)</font> </td>";
echo "<TD><font size=1> PhilHealth Benefit </font></tD>";
echo "<td><font size=1> Amount after PhilHealth Deduction </font></td>";
echo "</tr>";


if( $ro->getTotal("cashUnpaid","",$registrationNo) < 1 ) {
echo "<Tr>";
echo "<Td style='vertical-align:top;'> <font size=2> Total Health Care<Br> Institution Fees </font> </td>";
echo "<td> <input type='text' class='amount1' value=''> </td>";
echo "<td> <input type='text' class='amount1'> </td>";
echo "<td> <input type='text' class='amount1' value=''> </td>";
echo "<td> <font size=2>Amount P<input type='text' class='amount1' value=''></font><br><font size=2> Paid By (Check all that applies)</font> 
<br>
<input type='checkbox'><font size=1>Member/Patient</font> <input type='checkbox'><font size=1>HMO</font>
<Br>
<input type='checkbox'><font size=1>Others(i.e,PCSO,Promisorry Note,etc.)</font>

</td>";
echo "</tr>";
}else {

echo "<Tr>";
echo "<Td style='vertical-align:top;'> <font size=2> Total Health Care<Br> Institution Fees </font> </td>";
echo "<td> <input type='text' class='amount1' value='".number_format($actualCharges,2)."'> </td>";
echo "<td> <input type='text' class='amount1'> </td>";
echo "<td> <input type='text' class='amount1' value='".number_format($phicCharges,2)."'> </td>";
echo "<td> <font size=2>Amount P<input type='text' class='amount1' value='".number_format($unpaidCharges,2)."'></font><br><font size=2> Paid By (Check all that applies)</font> 
<br>
<input type='checkbox'><font size=1>Member/Patient</font> <input type='checkbox'><font size=1>HMO</font>
<Br>
<input type='checkbox'><font size=1>Others(i.e,PCSO,Promisorry Note,etc.)</font>

</td>";
echo "</tr>";

}



if( $ro->getTotal("cashUnpaid","",$registrationNo) < 1 ) {

echo "<Tr>";
echo "<Td style='vertical-align:top;'> <font size=2> Total Professional<Br> Fees (Accredited and non-<Br>accredited professionals) </font> </td>";
echo "<td> <input type='text' class='amount1' value=''> </td>";
echo "<td> <input type='text' class='amount1'> </td>";
echo "<td> <input type='text' class='amount1' value='' > </td>";
echo "<td> <font size=2>Amount P<input type='text' class='amount1' value='' ></font><br><font size=2> Paid By (Check all that applies)</font> 
<br>
<input type='checkbox'><font size=1>Member/Patient</font> <input type='checkbox'><font size=1>HMO</font>
<Br>
<input type='checkbox'><font size=1>Others(i.e,PCSO,Promisorry Note,etc.)</font>

</td>";
echo "</tr>";

}else {

echo "<Tr>";
echo "<Td style='vertical-align:top;'> <font size=2> Total Professional<Br> Fees (Accredited and non-<Br>accredited professionals) </font> </td>";
echo "<td> <input type='text' class='amount1' value='".number_format($ro->getTotalPF($registrationNo,"total"),2)."'> </td>";
echo "<td> <input type='text' class='amount1'> </td>";
echo "<td> <input type='text' class='amount1' value='".number_format($ro->getTotalPF($registrationNo,"phic"),2)."' > </td>";
echo "<td> <font size=2>Amount P<input type='text' class='amount1' value='".number_format(($ro->getTotalPF($registrationNo,"total") - $ro->getTotalPF($registrationNo,"phic") ),2)."' ></font><br><font size=2> Paid By (Check all that applies)</font> 
<br>
<input type='checkbox'><font size=1>Member/Patient</font> <input type='checkbox'><font size=1>HMO</font>
<Br>
<input type='checkbox'><font size=1>Others(i.e,PCSO,Promisorry Note,etc.)</font>

</td>";
echo "</tr>";

}

echo "</table>";

echo "<center><table style='width:860px;' border=0 >";
echo "<Tr>";
echo "<Td><font size=2>b.) Purchases/Expenses <b>NOT</b> included in the Health Care Intitution Charges </font></td>";
echo "</tr>";
echo "</table>";


echo "<center><table style='width:860px;' cellspacing=0 cellpadding=1 border=1 >";
echo "<Tr>";
echo "<Td width='430px;' ><font size=2> The cost of purchase/s for drugs/medicines and/or medical supplies bought by <Br> the patient/member within/outside the HCI during confinement </font> </td>";
echo "<td width='430px;'> <input type='checkbox'><font size=2> None </font>&nbsp; <input type='checkbox'><font size=2> Total Amount P</font><input type='text' class='amount1'> </td>";
echo "</tr>";


echo "<Tr>";
echo "<Td width='430px;' ><font size=2> Total cost of diagnostic/laboratory examinations paid for by the patient/member <Br> done within/outside the HCI during confinement </font> </td>";
echo "<td width='430px;'> <input type='checkbox'><font size=2> None </font>&nbsp; <input type='checkbox'><font size=2> Total Amount P</font><input type='text' class='amount1'> </td>";
echo "</tr>";

echo "</table>";


echo "<center><table style='width:860px;' border=0 >";
echo "<Tr>";
echo "<Td><font size=2>*NOTE: Total Actual Charges should be based on Statement of Account (SoA) </font></td>";
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
<br><br>
<input type='text' class='signature1'>
<Br>
<font size=1> Signature Over Printed Name of Patient/Authrorized Representative </font>
<br><br>
<font size=2>Date Signed</font> <input type='text' class='box' value='$monthOut_output1'><input type='text' class='box1' value='$monthOut_output2'>-<input type='text' class='box' value='$dayOut_output1'><input type='text' class='box1' value='$dayOut_output2'>-<input type='text' class='box' value='$yearOut_output1'><input type='text' class='box1' value='$yearOut_output2'><input type='text' class='box1' value='$yearOut_output3'><input type='text' class='box1' value='$yearOut_output4'>
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
<input type='text' class='signature2' value='&nbsp;'>
<br>
<font size=1>Signature Over Printed Name of Authrorized <br>HCI Representative</font>
</td>";

echo "
<Td> 
<input type='text' class='signature2' value='HOSPITAL REPRESENTATIVE'>
<br>
<font size=1>Official Capacity/Designation</font>
</td>";

echo "
<Td> 
<font size=2>Date Signed:</font> <input type='text' class='box' value='$monthOut_output1'><input type='text' class='box1' value='$monthOut_output2'>-<input type='text' class='box' value='$dayOut_output1'><input type='text' class='box1' value='$dayOut_output2'>-<input type='text' class='box' value='$yearOut_output1'><input type='text' class='box1' value='$yearOut_output2'><input type='text' class='box1' value='$yearOut_output3'><input type='text' class='box1' value='$yearOut_output4'>
<Br>
<span style='margin:0 0 0 130px;'><font size=1>month-day-year</font></span>
</td>";

echo "</tr>";
echo "</table>";


?>
