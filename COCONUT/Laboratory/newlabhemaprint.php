<?php
include("sandigLabDatabase.php");
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];


$wr=new sandigLab();
$ro=new database();
$ro->getPatientProfile($registrationNo);
$ro->getPatientChargesToEdit($itemNo);
$wr->showLabResult($registrationNo,$itemNo,"hematology");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<table width="800" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td><div align="center"><Strong>SANDIG MEDICAL CLINIC AND HOSPITAL</strong> </div></td>
  </tr>
  <tr>
    <td><div align="center"><strong>Tacurong City, Sultan Kudarat</strong> </div></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="800" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="100" height="27"><b>Name:</b></td>
      <td width="230"><Strong><?php echo $ro->getPatientRecord_completeName(); ?></strong></td>
      <td width="70"><b>Age:</b></td>
      <td width="157"><strong><?php echo $ro->getPatientRecord_Age(); ?></strong></td>
      <td width="101"><b>Room:</b></td>
      <td width="123"><strong><?php echo $ro->getregistrationdetails_room(); ?></strong></td>
    </tr>
    <tr>
      <td><b>Reg. No.:</b> </td>
      <td><strong><?php echo $registrationNo ?></strong> </td>
      <td><b>Sex:</b></td>
      <td><strong><?php echo $ro->getPatientRecord_gender(); ?></strong> </td>
      <td><b>Request Date</b> </td>
      <td><strong><?php echo $ro->patientCharges_dateCharge(); ?></strong></td>
    </tr>
    <tr>
      <td><b>Specimen:</b></td>
      <td><strong>Blood</strong></td>
      <td><b>Company:</b></td>
      <td><strong><?php echo $ro->getRegistrationDetails_company(); ?></strong> </td>
      <td><b>Time</b></td>
      <td><Strong><?php echo $ro->patientCharges_timeCharge(); ?></strong></td>
    </tr>
    <tr>

      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <pre align="center" class="style1">                  HEMATOLOGY <font size=6><?php echo "(".$ro->patientCharges_Description().")"; ?></font></pre>
  <table width="800" border="0" cellpadding="1" cellspacing="2" bordercolor="#00FFCC">
    <tr>
      <td colspan="3">&nbsp;  </td>
      <td width="149"><div align="center"><strong>RESULTS</strong></div></td>
      <td width="383"><div align="center"><strong>NORMAL VALUES</strong> </div></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Hemoglobin</strong></td>
      <td><strong><?php echo $wr->lab1(); ?></strong></td>
      <td colspan="2"><Strong>140-170 g/L g/L</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Erythrocyte Count</strong> </td>
      <td><strong><?php echo $wr->lab2(); ?></strong></td>
      <td colspan="2"><strong>4.5-5.5 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x             10 12/1</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Hematocrit</strong></td>
      <td><strong><?php echo $wr->lab3(); ?></strong></td>
      <td colspan="2"><strong>0.37-0.60</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Leukocyte Count</strong> </td>
      <td><strong><?php echo $wr->lab4(); ?></strong></td>
      <td colspan="2"><strong>5.0 - 10,0 &nbsp;&nbsp;&nbsp;&nbsp;x           10 9/1</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Differential Count</strong> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="152">&nbsp;</td>
      <td colspan="2"><strong>Myelocyte</strong></td>
     <td><strong><?php echo $wr->lab5(); ?></strong></td>
      <td>&nbsp;</td>
      <td width="13">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Juveniles</strong></td>
      <td><strong><?php echo $wr->lab6(); ?></strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Stabs</strong></td>
      <td><strong><?php echo $wr->lab7(); ?></strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Segmenters</strong></td>
      <td><strong><?php echo $wr->lab8(); ?></strong></td>
      <td colspan="2"><strong>0,55-0.65</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Lymphocytes</strong></td>
     <td><strong><?php echo $wr->lab9(); ?></strong></td>
      <td colspan="2"><strong>0,25 - 0,35</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Monocytes</strong></td>
     <td><strong><?php echo $wr->lab10(); ?></strong></td>
      <td colspan="2"><strong>0.03 - 0,06</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Eosinophils</strong></td>
      <td><strong><?php echo $wr->lab11(); ?></strong></td>
      <td colspan="2"><strong>0.02 - 0.04</strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><strong>Basophils</strong></td>
      <td><strong><?php echo $wr->lab12(); ?></strong></td>
      <td colspan="2"><strong>0-0.03</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Platelet Count</strong> </td>
      <td><strong><?php echo $wr->lab13(); ?></strong></td>
      <td colspan="2"><strong>150 - 350 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x           10 9/1</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>ESR</strong></td>
      <td><strong><?php echo $wr->lab14(); ?></strong></td>
      <td colspan="2"><strong>(F) 0-20 &nbsp;mm/hr &nbsp;(M) 0-9&nbsp;           m/hr</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Bleeding Time</strong> </td>
      <td><strong><?php echo $wr->lab15(); ?></strong></td>
      <td colspan="2"><strong>1-3&nbsp;&nbsp;min.</strong></td>
    </tr>
    <tr>
      <td colspan="3"><strong>Clotting Time</strong> </td>
      <td><strong><?php echo $wr->lab16(); ?></strong></td>
      <td colspan="2">2-8 &nbsp;min.</td>
    </tr>
    <tr>
      <td colspan="3"><strong>RH Type</strong> </td>
      <td><strong><?php echo $wr->lab17(); ?></strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><strong>Smear for Malaria Parasite</strong> </td>
      <td><strong><?php echo $wr->lab18(); ?></strong></td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
  <table width="800" border="0" cellspacing="1" cellpadding="1"><!--DWLayoutTable-->
    <tr>
      <td width="40">&nbsp;</td>
      <td width="189">&nbsp;</td>
      <td width="86">&nbsp;</td>
      <td width="124">&nbsp;</td>
      <td width="38">&nbsp;</td>
      <td width="204">&nbsp;</td>
      <td width="67">&nbsp;</td>
      <td width="27">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     <td></div></td>
      <div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	
    <tr>
      <td>&nbsp;</td>
      <td width='40%'><div align="center"><Strong><u><?php echo $wr->doc(); ?></u></strong><br><strong>PATHOLOGIST</strong></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width='30%'><div align="center"><strong><u><?php echo $wr->medtech(); ?></u></strong><Br><strong>MEDICAL TECHNOLOGIST</strong> </div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>

