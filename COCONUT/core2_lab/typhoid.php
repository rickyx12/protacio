<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>miniVidasform</title>
<style type="text/css">
body,td,th {
	font-family: "Times New Roman", Times, serif;
	font-size: 14px;
}
</style>
</head>
<?php

include("../CORE/core2.php");


$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];

$ro = new core2();

$ro->getPatientProfile($registrationNo);

?>
<body>
<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="14" align="center" valign="top"><?php echo $ro->getReportInformation("hmoSOA_name"); ?>    
  </tr>
  <tr>
    <td height="9" align="center" valign="top">LABORATORY DEPARTMENT   
  </tr>
  <tr>
    <td height="8" align="center" valign="top"><?php echo $ro->getReportInformation("hmoSOA_address"); ?>  
  </tr>
   <tr>
    <td height="8" align="center" valign="top">Tel. No. 062-2143237  
  </tr>
</table>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="800" border="0">
    <tr>
      <td width="59">Name:</td>
      <td width="297"><input name="textfield" type="text" id="TEST" size="40" maxlength="40" /></td>
      <td width="44">Age:</td>
      <td width="197"><input name="textfield3" type="text" id="textfield3" size="30" maxlength="30" /></td>
      <td width="49">Date:</td>
      <td width="128"><input name="textfield5" type="text" id="textfield5" size="20" maxlength="20" /></td>
    </tr>
    <tr>
      <td>Physician:</td>
      <td><input name="textfield2" type="text" id="textfield2" size="40" maxlength="40" /></td>
      <td>D.O.B::</td>
      <td><input name="textfield4" type="text" id="textfield4" size="30" maxlength="30" /></td>
      <td>Ward:</td>
      <td><input name="textfield6" type="text" id="textfield6" size="20" maxlength="20" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
<table width="800" border="0">
    <tr>
      <td align="center">Mini Vidas</td>
    </tr>
    <tr>
      <td align="center">LABORATORY DEPARTMENT</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
    <table width="800" border=".5" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="center">TUBEX TYPHOID RAPID TEST</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="391" align="center">SCORE</td>
        <td width="409" align="center">INTERPRETATION</td>
      </tr>
      <tr>
        <td>Equal or less than 2        </td>
        <td>NEGATIVE- no indication of current typhoid fever</td>
      </tr>
      <tr>
        <td>4</td>
        <td>WEAK POSITIVE - indication of current typhoid fever infection</td>
      </tr>
      <tr>
        <td>6-10</td>
        <td>POSITIVE- strong indication of current typhoid</td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
