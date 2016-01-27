<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$wr=new database();

$wr->getPatientChargesToEdit($itemNo);

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
body {
	background-color: #FFFFFF;
}
body,td,th {
	color: #000000;
}
-->
</style>
</head>

<body>
<table width="800" border="0" cellspacing="1" cellpadding="1" >
  <tr>
    <td><div align="center" class="style1">CLINICAL CHEMISTRY </div></td>
  </tr>
</table>
<form name="adddonor" method="get"
action="http://<?php echo $wr->getmyURL(); ?>/COCONUT/Laboratory/sandigLabResIn.php"> 
  <input type="hidden" name="regno" value="<?php echo $registrationNo; ?>"> 
  <input type="hidden" name="itemNo" value="<?php echo $itemNo; ?>"> 
   <input type="hidden" name="resultType" value="clinchem">
   <input type="hidden" name="procMonth" value="<?php echo date('M'); ?>">
   <input type="hidden" name="procDay" value="<?php echo date('d'); ?>">
   <input type="hidden" name="procYear" value="<?php echo date('Y'); ?>">
<input type="hidden" name="testno">
 <input type="hidden" name="reqdate" value="<?php echo $wr->patientCharges_dateCharge(); ?>">
 <input type="hidden" name="testdate"> 
   <input type="hidden" name="reqphy"> 
 <input type="hidden" name="medtech">
 <input type="hidden" name="lab9">
 <input type="hidden" name="lab26">
   <input type="hidden" name="lab28">
    <input type="hidden" name="lab29">
	<input type="hidden" name="patname">
	<input type="hidden" name="specimen">
	<input type="hidden" name="gender">
	<input type="hidden" name="gender1">
	<input type="hidden" name="medtech">
	<input type="hidden" name="examination"> 
  <table width="800" border="2" cellspacing="0" cellpadding="0" rules="all">
    <tr>
      <td width="154">Lab. No. </td>
      <td colspan="3"><input type="labno" name="textfield" /></td>
    </tr>
    <tr>
      <td>Test No. </td>
      <td colspan="3"><input type="testno" name="textfield2" /></td>
    </tr>
    <tr>
      <td>Req. Physician </td>
      <td colspan="3"><input type="reqphy" name="textfield3" /></td>
    </tr>
    <tr>
      <td>Pathologist</td>
      <td colspan="3"><input name="patho" type="text" id="NOIMA BARTOLOME" value="NOIMA BARTOLOME" /></td>
    </tr>
    <tr>
      <td>MedTech</td>
      <td colspan="3"><select name="select">
          <option>Grace T. Larozza, RMT</option>
          <option>2</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Specimen</td>
      <td colspan="3"><input type="text" name="textfield6" /></td>
    </tr>
    <tr>
      <td>Examination</td>
      <td colspan="3"><input type="text" name="textfield7" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="231">&nbsp;</td>
      <td width="197">&nbsp;</td>
      <td width="205">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center">TEST</div></td>
      <td><div align="center">RESULT</div></td>
      <td><div align="center">TEST</div></td>
      <td><div align="center">RESULT</div></td>
    </tr>
    <tr>
      <td>Glucose</td>
      <td><input name="lab1" type="text" id="lab1" autocomplete="off" /></td>
      <td>Globulin</td>
      <td><input name="lab2" type="text" id="lab2" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Urea</td>
      <td><input name="lab3" type="text" id="lab3" autocomplete="off" /></td>
      <td>A/G Ratio </td>
      <td><input name="lab4" type="text" id="lab4" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Urate</td>
      <td><input name="lab5" type="text" id="lab5" autocomplete="off" /></td>
      <td>SGOT</td>
      <td><input name="lab6" type="text" id="lab6" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Total Cholesterol </td>
      <td><input name="lab7" type="text" id="lab7" autocomplete="off" /></td>
      <td>SGPT</td>
      <td><input name="lab8" type="text" id="lab8" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>HDL</td>
      <td><input name="lab9" type="text" id="lab9" autocomplete="off" /></td>
      <td>GGT</td>
      <td><input name="lab10" type="text" id="lab10" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>LDL</td>
      <td><input name="lab11" type="text" id="lab11" autocomplete="off" /></td>
      <td>LDH</td>
      <td><input name="lab12" type="text" id="lab12" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Triglyceride</td>
      <td><input name="lab13" type="text" id="lab13" autocomplete="off" /></td>
      <td>Alkaline Phosphatase </td>
      <td><input name="lab14" type="text" id="lab14" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Creatinine</td>
      <td><input name="lab15" type="text" id="lab15" autocomplete="off" /></td>
      <td>Acid Phosphatase </td>
      <td><input name="lab16" type="text" id="lab16" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Total Bilirubin </td>
      <td><input name="lab17" type="text" id="lab17" autocomplete="off" /></td>
      <td>CK-MB</td>
      <td><input name="lab18" type="text" id="lab18" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Direct Bilirubin </td>
      <td><input name="lab19" type="text" id="lab19" autocomplete="off" /></td>
      <td>Amylase</td>
      <td><input name="lab20" type="text" id="lab20" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>InDirect Bilirubin </td>
      <td><input name="lab21" type="text" id="lab21" autocomplete="off" /></td>
      <td>Calcium</td>
      <td><input name="lab22" type="text" id="lab22" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Total Protein </td>
      <td><input name="lab23" type="text" id="lab23" autocomplete="off" /></td>
      <td>Sodium</td>
      <td><input name="lab24" type="text" id="lab24" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>Albmin</td>
      <td><input name="lab25" type="text" id="lab25" autocomplete="off" /></td>
      <td>Potassium</td>
      <td><input name="lab26" type="text" id="lab6" autocomplete="off" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Chloride</td>
      <td><input name="lab27" type="text" id="lab27" autocomplete="off" /></td>
    </tr>
    <tr>
      <td><input name="submit" type="submit" id="submit" value="Submit" />
        &nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
