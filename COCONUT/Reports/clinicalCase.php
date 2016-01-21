<?php
include("../../myDatabase.php");

$registrationNo = $_GET['registrationNo'];

$ro = new database();

$ro->getPatientProfile($registrationNo);
$ro->getReportInformation(hmoSOA_name);
$ro->getReportInformation(hmoSOA_address);

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
  <table width="900" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><span class="style1">SANDIG MEDICAL CLINIC AND HOSPITAL </span></div></td>
    </tr>
    <tr>
      <td><div align="center"><span class="style2">Ledesma St. Tacurong City , Sultan kudarat </span></div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="900" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center"><strong>CLINICAL CASE RECORD </strong></div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="900" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="90">Case No. </td>
      <td width="401"><font size=3>echo $ro->getPatientProfile($registrationNo);</font></td>
      <td width="82">Date Admitted </td>
      <td width="309">&nbsp;</td>
    </tr>
    <tr>
      <td>Patient Name </td>
      <td><font size=3>echo $ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()." ".$ro->getPatientRecord_middleName();</font></td>
      <td>Time Admitted </td>
      <td>
      <td width="8">&nbsp;</td>
    </tr>
    <tr>
      <td>Age</td>
      <td>echo $ro->getPatientRecord_age();</td>
      <td>Sex</td>
      <td>$ro->getPatientRecord_gender();</td>
    </tr>
    <tr>
      <td>Company</td>
      <td>echo $ro->getRegistrationDetails_company();</td>
      <td>Philheath No. </td>
      <td>echo $ro->getPatientRecord_PHIC();</td>
    </tr>
    <tr>
      <td>Height</td>
      <td>echo $ro->getRegistrationDetails_height();</td>
      <td>Weight</td>
      <td>echo $ro->getRegistrationDetails_weight();</td>
    </tr>
    <tr>
      <td>Temperature</td>
      <td>$ro->getRegistrationDetails_temperature()</td>
      <td>Height</td>
      <td>echo $ro->getRegistrationDetails_height();</td>
    </tr>
    <tr>
      <td>Admitting Diagnosis</td>
      <td>$ro->getRegistrationDetails_IxDx();</td>
      <td>Blood Pressure </td>
      <td>echo $ro->getRegistrationDetails_bloodPressure();</td>
    </tr>
    <tr>
      <td>Final Diagnosis </td>
      <td>&nbsp;</td>
      <td>Attending Physician </td>
      <td>echo $ro->getAttendingDoc($registrationNo)</td>
    </tr>
    <tr>
      <td>Birthdate</td>
      <td>echo $ro->getPatientRecord_Birthdate()</td>
      <td>Admitting Physiscian </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Address</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="checkbox" checked="checked" />
          <font size="3">HOUSE CASE</font> </td>
      <td>&nbsp;&nbsp;&nbsp;
          <input type="checkbox" />
        <font size="3">PRIVATE</font> </td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>
