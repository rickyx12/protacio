<?php
include("../../myDatabase.php");



$ro = new database();

echo "

<style type='text/css'>

.desc{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 240px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

.preparation{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 167px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}


.qty{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 67px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}


.phicTotal{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 125px;
	border-color:white white white white;
	font-size:15px;
	text-align:center;
}

.boxes{
	border: 1px solid #000;
	color: #000;
	height: 23px;
	width: 25px;
	border-color:white black black black;
	font-size:15px;
	text-align:center;
}

.boxes1{
	border: 1px solid #000;
	color: #000;
	height: 23px;
	width: 25px;
	border-color:white black black white;
	font-size:15px;
	text-align:center;
}

.part4 {
font-size:17px;
}

.myFont {
font-size:17px;
}

</style>

";


echo "<center><div style='border:1px solid #000000; width:860px; height:auto; border-color:black black white black;'>";
echo "<font size=3><b>PART II - DRUGS AND MEDICINES (use additional sheet if necessary)</b></font>";
echo "</div>";

echo "<table align='center' width='860' border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td width='35%'><center><font size=4>Generic/Brand Name</font></center></td>";
echo "<td width='20%'><center><font size=4>Preparation</font><br><font size=1>(dose/cap/syrup/injectible<br>/tab with ml/mg/gm content)</font></center></td>";
echo "<Td width='5%'><center><font size=4>Qty</font></center></tD>";
echo "<td width='10%'><center><font size=4>Unit Price</font></center></td>";
echo "<td width='10%'><Center><font size=3>Actual<br>Charges</font></center></td>";
echo "<td width='10%'><center><font size=3>PhilHealth<br>Benefit</font></center></td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='LIDOCAINE 2%' class='desc'></td>";
echo "<tD><input type='text' value='POLYAMP' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";


echo "<Tr>";
echo "<tD><input type='text' value='SENSORCAINE' class='desc'></td>";
echo "<tD><input type='text' value='AMP' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='EPINEPHRINE' class='desc'></td>";
echo "<tD><input type='text' value='AMP' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='BSS PLUS' class='desc'></td>";
echo "<tD><input type='text' value='SOLUTION' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='TOBRADEX' class='desc'></td>";
echo "<tD><input type='text' value='OINTMENT' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='PHENYLEPHRINE HCL/MYDFRIN' class='desc'></td>";
echo "<tD><input type='text' value='2.5/5 ML DROPS' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='TROPICAMIDE' class='desc'></td>";
echo "<tD><input type='text' value='AMP' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='VANCOMYCIN IV' class='desc'></td>";
echo "<tD><input type='text' value='AMP' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='BETADINE' class='desc'></td>";
echo "<tD><input type='text' value='30CC/VIAL' class='preparation'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td><center><font size=4><b>TOTAL</b></font></center></td>";
echo "<td><input type=text class='phicTotal' value=''></td>";
echo "<td><input type=text class='phicTotal' value=''></td>";
echo "</tr>";
echo "</table>";


echo "<Br>";
echo "<center><div style='border:1px solid #000000; width:860px; height:auto; border-color:black black white black;'>";
echo "<font size=3><b>PART III - X-RAY, LABORATORIES, SUPPLIES AND OTHERS (use additional sheet if necessary)
</b></font>";
echo "</div>";
echo "<table border=1 width='860' cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Td width='45%'><center><Font size=4>Particulars</font></center></td>";
echo "<Td><center><Font size=3>Qty</font></center></td>";
echo "<Td><center><Font size=3>Unit Price</font></center></td>";
echo "<Td><center><Font size=3>Actual<br>Charges</font></center></td>";
echo "<Td><center><Font size=3>PhilHealth<Br>Benefit</font></center></td>";
echo "</tr>";
echo "<tr>";
echo "<Td width='45%'>&nbsp;<Font size=4>A. X-Ray (Imaging)</font></td>";
echo "<Td width='10%'><center><Font size=3></font></center></td>";
echo "<Td width='15%'><center><Font size=3></font></center></td>";
echo "<Td width='15%'><center><Font size=3></font></center></td>";
echo "<Td width='15%'><center><Font size=3></font></center></td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='' class='desc'></td>";
echo "<tD><input type='text' value='' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<tr>";
echo "<Td width='45%'>&nbsp;<Font size=4>B. Laboratories/Diagnostics</font></td>";
echo "<Td width='10%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2></font></center></td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='' class='desc'></td>";
echo "<tD><input type='text' value='' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<tr>";
echo "<Td width='45%'>&nbsp;<Font size=4>C. Supplies and Others</font></td>";
echo "<Td width='10%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2></font></center></td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='DISP. CAP & MASK' class='desc'></td>";
echo "<tD><input type='text' value='2' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='USE OF CAUTERY' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='USE OF CAUTERY' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='EYEPAD' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='DISP. GLOVES' class='desc'></td>";
echo "<tD><input type='text' value='2' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='DISP. NEEDLE G.27' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";

echo "<Tr>";
echo "<tD><input type='text' value='MACROSET' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";


echo "<Tr>";
echo "<tD><input type='text' value='100CC/5CC/T-SYRINGE' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";


echo "<Tr>";
echo "<tD><input type='text' value='10-0 NYLON SUTURE' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";


echo "<Tr>";
echo "<tD><input type='text' value='FEATHER BLADE NO. 11 & 15' class='desc'></td>";
echo "<tD><input type='text' value='1' class='qty'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "<tD><input type='text' value='' class='phicTotal'> </td>";
echo "</tr>";


//$ro->phicBack_part3("MISCELLANEOUS",$registrationNo);
//$ro->phicBack_part3("NURSING-CHARGES",$registrationNo);
echo "<tr>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td width='45%'>&nbsp;</td>";
echo "<Td width='10%'><center><Font size=2></font></center></td>";
echo "<Td width='15%'><center><Font size=2><b>TOTAL</b></font></center></td>";
echo "<Td width='15%'><input type=text class='phicTotal' value='".number_format($ro->phicBack_actualCharges(),2)."'></td>";
echo "<Td width='15%'><input type=text class='phicTotal' value='".number_format($ro->phicBack_phicBenefits(),2)."'></td>";
echo "</tr>";
echo "</table>";
echo "<Table align='center' width='860' cellpadding=0 cellspacing=0 border=0>";
echo "<tr>";
echo "<Td><input type=checkbox checked='checked'><font class='myFont'>Official receipts for drugs and medicines / supplies purchased by member from external sources as well as laboratory procedures done<br>&nbsp;&nbsp;&nbsp;&nbsp;
outside the hospital which are necessary for the confinement are attached to this claim
</font></td>";
echo "</tr>";
echo "</table>";
echo "<center><div style='border:2px solid #000000; width:860px; height:auto; border-color:black black black black;'>";
echo "<font size=3><b>PART IV - CERTIFICATION OF INSTITUTIONAL HEALTH CARE PROVIDER
</b></font>";
echo "</div>";
echo "<center><div style='border:2px solid #000000; width:860px; height:auto; border-color:white white white white;'>";
echo "<font class='part4'><b>I certify that services rendered were recorded in the patient's chart and hospital records and that the herein information given are true and correct.
<br>
The foregoing items and charges are in compliance with the applicable laws, rules and regulations.
</b></font><br><br>";
echo "</div>";
echo "<Br>";
echo "<Table width='860' border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Td width='40%'><u>SHIRLY UY RICALDE</u><Br><font size=2>Signature Over Printed Name of Authorized Representative
</font></td>";
echo "<td width='30%'><u>PHILHEALTH CLERK</u><br><font size=2>Official Capacity / Designation
</font></tD>";
echo "<Td width='40%'>&nbsp;&nbsp;<input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'>-<input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'>-<input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'><input type=text maxlength=1 class='boxes1'><input type=text maxlength=1 class='boxes1'><br>
&nbsp;&nbsp;&nbsp;<font size=2>Date Signed (month-day-year)</font>
</td>";
echo "</tr>";
echo "</table>";
echo "<center><br><div style='border:2px solid #000000; width:860px; height:auto; border-color:black black black black;'>";
echo "<font size=2><b>PART V - CONSENT TO ACCESS PATIENT RECORD/S
</b></font>";
echo "</div>";
echo "<center><div style='border:2px solid #000000; width:860px; height:auto; border-color:white white white white;'>";
echo "<font class='part4'>
<b>
I hereby consent to the examination by PhilHealth of the patient's medical records for the sole purpose of verifying the veracity of this claim.
<br>
I hereby hold PhilHealth or any of its officers, employees and/or representatives free from any and all liabilities relative to the herein-mentioned
<br>
consent which I have voluntarily and willingly given in connection with this claim for reimbursement before PhilHealth.

</b>
</font><br><br>";
echo "</div>";
echo "<Table align='center' width='860' cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Td width='25%'>____________________________<Br><font size=2>Signature Over Printed Name of Patient
</font><br><input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'>-<input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'>-<input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'><input type=text maxlength=1 class='boxes1'><input type=text maxlength=1 class='boxes1'><br><font size=2>Date Signed (month-day-year)
</font></tD>";
echo "<Td width='34%'>____________________________________<br><font size=2>Signature Over Printed Name of Patient's Representative
</font><br><input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'>-<input type=text class='boxes' maxlength=1><input type=text maxlength=1 class='boxes1'>-<input type=text maxlength=1 class='boxes'><input type=text maxlength=1 class='boxes1'><input type=text maxlength=1 class='boxes1'><input type=text maxlength=1 class='boxes1'><br><font size=2>Date Signed (month-day-year)
</font></tD>";
echo "<td width='35%'><font size=2>Relationship of the Representative to the Patient:
</font>
<br>
<input type=checkbox style='outline: 1px solid #000000;' ><font size=2>Spouse</font>&nbsp;&nbsp;<input type=checkbox style='outline: 1px solid #000000;'><font size=2>Child</font>&nbsp;&nbsp;<input type=checkbox style='outline: 1px solid #000000;'><font size=2>Parent</font>&nbsp;&nbsp;<input type=checkbox style='outline: 1px solid #000000;' ><font size=2>Guardian/<font size=2>Next of<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kin</font>
</td>";
echo "</tr>";
echo "</table>";
echo "<center><br><div style='border:0px solid #000000; width:860px; height:auto; border-color:white white white white;'>";
echo "<font size=3>Reason for Signing on Behalf of the Patient:
</font>";
echo "</div>";
echo "<br>";
echo "<table width='860px' border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td width='30%'></td>";
echo "<td width='30%'><input type=checkbox style='outline: 1px solid #000000;' ><font size=2>Patient is Incapacitated
</font></td>";
echo "<td width='50%'><input type=checkbox style='outline: 1px solid #000000;' ><font size=2>Other Reasons:
____________________________
</font></td>";
echo "</tr>";
echo "</table>";


?>


