<?php
include("sandigLabDatabase.php");
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];


$wr=new sandigLab();
$ro=new database();
$ro->getPatientProfile($registrationNo);
$ro->getPatientChargesToEdit($itemNo);
$wr->showLabResult($registrationNo,$itemNo,"urinalysis");

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
    <td><div align="center">SANDIG MEDICAL CLINIC AND HOSPITAL </div></td>
  </tr>
  <tr>
    <td><div align="center">Tacurong City, Sultan Kudarat </div></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="800" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="100" height="27"><b>Name:</b></td>
      <td width="230"><?php echo $ro->getPatientRecord_completeName(); ?></td>
      <td width="70"><b>Age:</b></td>
      <td width="157"><?php echo $ro->getPatientRecord_Age(); ?></td>
      <td width="101"><b>Room:</b></td>
      <td width="123"><?php echo $ro->getRegistrationDetails_room(); ?></td>
    </tr>
    <tr>
      <td><b>Reg. No:</b> </td>
      <td><?php echo $registrationNo; ?></td>
      <td><B>Sex:</b></td>
      <td><?php echo $ro->getPatientRecord_gender(); ?></td>
      <td><b>Request Date:</b> </td>
      <td><?php echo $ro->patientCharges_dateCharge(); ?></td>
    </tr>
    <tr>
      <td><b>Specimen:</b></td>
      <td>Urine</td>
      <td><b>Company:</b></td>
      <td><?php echo $ro->getRegistrationDetails_company(); ?></td>
      <td><b>Time:</b></td>
      <td><?php echo $ro->patientCharges_timeCharge(); ?></td>
    </tr>
    <tr>
      <td><b>Physician:</b></td>
      <td><?php echo $ro->getAttendingDoc($registrationNo,"Attending"); ?></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <pre align="center" class="style1">                  URINALYSIS
</pre>
 
<table>
<tr>
<td><b>Color:</b></tD><td>&nbsp;<?php echo $wr->lab1(); ?></td>
<td width="40%">&nbsp;&nbsp;</tD>
<td><b>Hyaline Cast:</b></td><td>&nbsp;<?php echo $wr->lab2(); ?></td>
</tr>
<tr>
<td><b>Character:</b></tD><td>&nbsp;<?php echo $wr->lab4(); ?></td>
<td width='40%'>&nbsp;&nbsp;</tD>
<td><b>Fine Granular</b></td><td>&nbsp;<?php echo $wr->lab3(); ?></td>
</tr>
<tr>
<td><b>Reaction(pH):</b></tD><td>&nbsp;<?php echo $wr->lab6();?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Coarse Granular</b></td><td>&nbsp;<?php echo $wr->lab5(); ?></td>
</tr>
<tr>
<td><b>Specific Gravity:</b></tD><td>&nbsp;<?php echo $wr->lab8(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Waxy Cast</b></td><td>&nbsp;<?php echo $wr->lab7(); ?></td>
</tr>
<tr>
<td><b>Albumin:</b></tD><td>&nbsp;<?php echo $wr->lab10(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>RBC Cast</b></td><td>&nbsp;<?php echo $wr->lab11(); ?></td>
</tr>
<tr>
<td><b>Sugar:</b></tD><td>&nbsp;<?php echo $wr->lab12(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>WBC Cast</b></td><td>&nbsp;<?php echo $wr->lab9(); ?></td>
</tr>
<tr>
<td><b>Acetone:</b></tD><td>&nbsp;<?php echo $wr->lab14(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b><font size=4><u>Crystals</u></font></b></td><td></td>
</tr>
<tr>
<td><b>Bile</b></tD><td>&nbsp;<?php echo $wr->lab16(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Uric Acid</b></td><td><?php echo $wr->lab15(); ?></td>
</tr>
<tr>
<tr>
<td><b>Bilirubin</b></tD><td>&nbsp;<?php echo $wr->lab18(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Calcium Oxalate</b></td><td><?php echo $wr->lab17(); ?></td>
</tr>
<tr>
<td><b>Urobilinogen:</b></tD><td>&nbsp;<?php echo $wr->lab20(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Amorphous Urates</b></td><td><?php echo $wr->lab19(); ?></td>
</tr>
<tr>
<td><font size=4><b><u>Microscopic</u></b></font></tD><td>&nbsp;</td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Amorphous Phosphate</b></td><td><?php echo $wr->lab21(); ?></td>
</tr>
<tr>
<td><b>WBC:</b></tD><td>&nbsp;<?php echo $wr->lab23(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Triple Phosphate</b></td><td><?php echo $wr->lab22(); ?></td>
</tr>
<tr>
<td><b>RBC:</b></tD><td>&nbsp;<?php echo $wr->lab24(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Bacteria</b></td><td><?php echo $wr->lab26(); ?></td>
</tr>
<tr>
<td><b>Epithelial Cells:</b></tD><td>&nbsp;<?php echo $wr->lab25(); ?></td>
<td width='40%'>&nbsp;&nbsp;</td>
<td><b>Yeast Cells</b></td><td><?php echo $wr->lab26(); ?></td>
</tr>
<tr>
<td><b>Mucous Threads:</b></tD><td>&nbsp;<?php echo $wr->lab28(); ?></td>
</tr>
</table>
<br><br>
<centeR>
<table>
<tr>
<td><font size=3><?php echo $wr->doc(); ?></font><br><b><font size=3>Pathologist</font></b></tD>
<tD width='60%'></tD>
<tD><font size=3><?php echo $wr->medtech(); ?></font><br><b><font size=3>Medical Technician</font></b></tD>
</tr>
</table>
</body>
</html>

