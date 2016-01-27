<?php
include("sandigLabDatabase.php");
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];


$wr=new sandigLab();
$ro=new database();
$ro->getPatientProfile($registrationNo);
//$ro->getPatientChargesToEdit($itemNo);
$wr->showLabResult($registrationNo,$itemNo,"fecalysis");

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
  <table width="800" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="100" height="27"><b>Name:</b></td>
      <td width="230"><?php echo $ro->getPatientRecord_completeName(); ?></td>
      <td width="70"><b>Age:</b></td>
      <td width="157"><?php echo $ro->getPatientRecord_Age(); ?></td>
      <td width="101"><b>Room:</b></td>
      <td width="123"><?php echo $ro->getregistrationdetails_room(); ?></td>
    </tr>
    <tr>
      <td><b>Reg. No:</b> </td>
      <td><?php echo $registrationNo; ?></td>
      <td><B>Sex:</b></td>
      <td><?php echo $ro->getPatientRecord_gender(); ?></td>
      <td><b>Request Date:</b> </td>
      <td><?php //echo $ro->patientCharges_dateCharge(); ?></td>
    </tr>
    <tr>
      <td><b>Specimen:</b></td>
      <td>Stool</td>
      <td><b>Company:</b></td>
      <td><?php echo $ro->getRegistrationDetails_company(); ?></td>
      <td><b>Time:</b></td>
      <td><?php //echo $ro->patientCharges_timeCharge(); ?></td>
    </tr>
    <tr>
      <td><b>Physician:</b></td>
      <td></tD>
    </tr>
  </table>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=5><b>Fecalysis</b></font>
  <table width="380" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <th>General</th>
      <th>Result</th>
    </tr>
    
<tr>
<Td>Color</tD>
<td><?php echo $wr->lab1(); ?></tD>
</tr>

<tr>
<tD>Consistency</tD>
<td><?php echo $wr->lab2(); ?> </tD>
</tr>

<tr>
<tD><B>Parasitic Ova:</b></tD>
<td>&nbsp;</tD>
</tr>

<tr>
<tD>Ascaris</tD>
<td><?php echo $wr->lab3(); ?> </tD>
</tr>

<tr>
<tD>Trichiuris</tD>
<td><?php echo $wr->lab4(); ?> </tD>
</tr>

<tr>
<tD>Hookworm</tD>
<td><?php echo $wr->lab5(); ?> </tD>
</tr>

<tr>
<tD><b><font size=2>ENTAMOEBA HYSTOLYTICA:</font></b></tD>
<td></tD>
</tr>

<tr>
<tD>Cryst</tD>
<td><?php echo $wr->lab6(); ?> </tD>
</tr>

<tr>
<tD>Throphozite</tD>
<td><?php echo $wr->lab7(); ?></tD>
</tr>

<tr>
<tD><b><font size=2>E. COLI::</font></b></tD>
<td></tD>
</tr>

<tr>
<tD>Cryst</tD>
<td><?php echo $wr->lab8(); ?></tD>
</tr>

<tr>
<tD>Throphozite</tD>
<td><?php echo $wr->lab9(); ?></tD>
</tr>


<tr>
<tD>Pus Cells</tD>
<td><?php echo $wr->lab10(); ?></tD>
</tr>


<tr>
<tD>Red Blood Cells</tD>
<td><?php echo $wr->lab11(); ?></tD>
</tr>

<tr>
<tD>Charcot Leyden Crystals</tD>
<td><?php echo $wr->lab12(); ?></tD>
</tr>

<tr>
<tD>Fat Globules </tD>
<td><?php echo $wr->lab13(); ?></tD>
</tr>

<tr>
<tD>Bacteria </tD>
<td><?php echo $wr->lab14(); ?></tD>
</tr>

<tr>
<tD>Occult Blood </tD>
<td><?php echo $wr->lab15(); ?></tD>
</tr>
</table>
<br>
<font size=3><b>Remark's</b></font><br>
<?php echo $wr->lab19(); ?>


</body>
</html>

