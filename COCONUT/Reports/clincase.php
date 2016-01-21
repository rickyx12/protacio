<?php
include("../../myDatabase.php");

$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->getPatientProfile($registrationNo);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 16px}
-->
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><span class="style1">SANDIG MEDICAL CLINIC AND HOSPITAL </span></div></td>
    </tr>
    <tr>
      <td><div align="center"><span class="style2">Ledesma St. Tacurong City , Sultan kudarat </span></div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><strong><font size=6>CLINICAL CASE RECORD</font> </strong></div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="900" border="0" cellspacing="0" cellpadding="1">
    <tr>
      <td width="240"><font size=5>Reg No.</font> </td>
      <td width="318"><font size=5><?php echo $registrationNo ?></font></td>
      <td width="205"><font size=5>Date Admitted</font> </td>
      <td width="118"><?php echo $ro->getRegistrationDetails_dateRegistered(); ?></td>
    </tr>
    <tr>
      <td><font size=5>Patient Name</font> </td>
      <td><font size=5><?php echo $ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName(); ?></font></td>
      <td><font size=5>Time Admitted</font> </td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_timeRegistered(); ?></font></td>
      <td width="9">&nbsp;</td>
    </tr>
    <tr>
      <td><font size=5>Age</font></td>
      <td><font size=5> <?php echo $ro->getPatientRecord_age(); ?></font></td>
      <td><font size=5>Sex</font></td>
      <td><font size=5><?php echo $ro->getPatientRecord_gender(); ?></font></td>
    </tr>
    <tr>
      <td><font size=5>Company</font></td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_company(); ?></font></td>
      <td><font size=5>Philhealth No.</font> </td>
      <td><font size=5><?php echo $ro->getPatientRecord_PHIC(); ?></font></td>
    </tr>
    <tr>
      <td><font size=5>Admitting Staff</font></td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_registeredBy(); ?></font></td>
      <td><font size=5>Weight</font></td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_weight(); ?></font></td>
    </tr>
    <tr>
      <td><font size=5>Temperature</font></td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_temperature(); ?></font></td>
      <td><font size=5>Height</font></td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_height();?></font></td>
    </tr>
    <tr>
      <td><font size=5>Admitting Diagnosis</font></td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_IxDx(); ?></font></td>
      <td><font size=5>Blood Pressure</font> </td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_bloodPressure();?></font></td>
    </tr>
    <tr>
      <td><font size=5>Final Diagnosis</font> </td>
      <td><font size=5><?php echo $ro->getRegistrationDetails_finalDiagnosis(); ?></font></td>
      <td><font size=5>Attending Physician</font> </td>
      <td><font size=5><?echo $ro->getAttendingDoc($registrationNo,"Attending");?></font></td>
    </tr>
    <tr>
      <td>Birthdate</td>
      <td><?php echo $ro->getPatientRecord_Birthdate(); ?></td>
      <td><font size=5>Admitting Physiscian</font> </td>
      <td><font size=5><?echo $ro->getAttendingDoc($registrationNo,"Admitting");?></font></td>
    </tr>
    <tr>
      <td><font size=5>Address</font></td>
      <td colspan="2"><font size=4><?php echo $ro->getPatientRecord_Address(); ?></font></td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="checkbox" checked="checked" />
          <font size="5">HOUSE CASE</font> </td>
      <td>&nbsp;&nbsp;&nbsp;
          <input type="checkbox" />
        <font size="5">PRIVATE</font> </td>
    </tr>
  </table>
  <p>&nbsp;</p>

<?php $ro->soap_setter($registrationNo); ?>
  <table width="900" height="125" border="1" cellpadding="0" cellspacing="0">
<tr>
<th><font size=4>SUBJECTIVE</font></tH>
<th><font size=4>OBJECTIVE</font></tH>
<th><font size=4>ASSESSMENT</font></tH>
<th><font size=4>PLAN</font></tH>
</tR>    
<tr>
      <td width="247"><textarea name="textarea" cols="20" rows="15" style='font-size:22px'><?php echo $ro->soap_subjectivez(); ?></textarea></td>
      <td width="247"><textarea name="textarea2" cols="20" rows="15" style='font-size:22px;' ><?php echo $ro->soap_objectivez(); ?></textarea></td>
      <td width="247"><textarea name="textarea3" cols="20" rows="15" style='font-size:22px;'><?php echo $ro->soap_assessmentz(); ?></textarea></td>
      <td width="247"><textarea name="textarea4" cols="20" rows="15" style='font-size:22px;'><?php echo $ro->soap_planz(); ?> 
------------------
<?php echo $ro->soap_charges_auto($registrationNo,"LABORATORY"); ?> 
<?php echo $ro->soap_charges_auto($registrationNo,"RADIOLOGY"); ?>
<?php echo $ro->soap_charges_auto($registrationNo,"MEDICINE"); ?>
<?php echo $ro->soap_charges_auto($registrationNo,"SUPPLIES"); ?>   
</textarea></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>

