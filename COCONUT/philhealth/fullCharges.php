<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];

$ro = new database2();

$ro->getPatientProfile($registrationNo);

?>

<style type="text/css">

.underLine{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 740px;
	border-color:white white black white;
	font-size:17px;

}

.underLine1{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 270px;
	border-color:white white black white;
	font-size:17px;

}

</style>

<Center>
<font size=6>PAGADIAN CITY MEDICAL CENTER<font>
</center>
<center>
<font size=3>Cabrera St., San Francisco District. Pagadian City</font>
</center>
<center>
<font size=3>Tel No. (062) 2143237</font>
</center>
<br><br><Br>

<Center>
<u><font size=6>W A I V E R</font></u>
</center>

<center>
<font size=4>(Full Charges)</font>
</center>
<br>
<table border=0 width='100%'>
<tr>
<td width='70%'>&nbsp;</td>
<td>&nbsp;<?php echo "<font size=4>Date:&nbsp;<u>".date("M d, Y")."</u>____</font>" ?></td>
</tr>
</table>
<br>

<font size=4><b>TO WHOM IT MAY CONCERN:</b></font>
<br>
&nbsp;&nbsp;&nbsp;<font size=4>This is to certify that base on our record. <u><?php echo $ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName(); ?></u> who was confined/admitted at Pagadian City Medical Center from <?php echo "<u>".$ro->getRegistrationDetails_dateRegistered()."</u>"; ?> to <?php echo "<u>".$ro->getRegistrationDetails_dateUnregistered()."</u>"; ?> had no medicare deductions for hospital charges including professional fees to the amount of <input type=text class='underLine'> (<b>P</b><input type=text class='underLine1'>) were fully paid by the patient/member under Official Receipt No./s<input type=text class='underLine1'></font>
<br><Br>
&nbsp;&nbsp;&nbsp;<font size=3>This waiver is being issued upon the request of the above mentioned patient for whatever legal purpose it may serve</font>

<br><Br>

<table border=0 width='100%'>
<tr>
<td width='70%'>&nbsp;</td>
<td>&nbsp;<input type=text class='underLine1'><Br><Font size=2>Medical Director/Cashier/Finance .Mgr/Officer</font></td>
</tr>
</table>





