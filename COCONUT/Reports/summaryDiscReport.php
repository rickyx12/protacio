<?php 
include("../../myDatabase.php");
include ("../../COCONUT/Laboratory/sandigLabDatabase.php");
$wr = new database();
$wi = new sandigLab();





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style8 {font-size: 11px; font-weight: bold; }
.style10 {font-size: 12px; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="1400" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td><h1 align="center">SANDIG MDICAL CLINIC AND HOSPITAL </h1></td>
  </tr>
  <tr>
    <td><div align="center">
      <h3>Tacurong City, Sultan Kudarat </h3>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="1400" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="136"><div align="center"><span class="style8">Patient Name </span></div></td>
    <td width="54"><div align="center"><span class="style8">CoH</span></div></td>
    <td width="54"><div align="center"><span class="style8">Disc</span></div></td>
    <td width="41"><div align="center"><span class="style8">D/P</span></div></td>
    <td width="56"><div align="center"><span class="style8">AR-PHIC</span></div></td>
    <td width="63"><div align="center"><span class="style8">AR-HMO</span></div></td>
    <td width="39"><div align="center"><span class="style8">AR-MI</span></div></td>
    <td width="57"><div align="center"><span class="style8">AR-Trade</span></div></td>
     <td width="52"><div align="center"><span class="style10">Debit</span></div></td>
   <td width="51"><div align="center"><span class="style8">Medicine</span></div></td>
    <td width="52"><div align="center"><span class="style8">Supplies</span></div></td>
    <td width="31"><div align="center"><span class="style8">Lab</span></div></td>
    <td width="38"><div align="center"><span class="style8">Radio</span></div></td>
    <td width="38"><div align="center"><span class="style8">OR/DR</span></div></td>
    <td width="34"><div align="center"><span class="style8">Misc</span></div></td>
    <td width="33"><div align="center"><span class="style8">ECG</span></div></td>
    <td width="41"><div align="center"><span class="style8">Ultra</span></div></td>
    <td width="32"><div align="center"><span class="style8">Resp</span></div></td>
    <td width="44"><div align="center"><span class="style8">Dietary</span></div></td>
    <td width="40"><div align="center"><span class="style8">RN-Fee</span></div></td>
    <td width="39"><div align="center"><span class="style8">Room</span></div></td>
    <td width="42"><div align="center"><span class="style8">Cert</span></div></td>
    <td width="47"><div align="center"><span class="style8">CSR</span></div></td>
    <td width="52"><div align="center"><span class="style8">Ap-RoD</span></div></td>
    <td width="46"><div align="center"><span class="style8">AP-PF</span></div></td>
    <td width="21"><div align="center"></div></td>
    <td width="56"><div align="center"><span class="style10">Credit</span></div></td>
  </tr>
  <?php $wi->getDischarged("Jun","01","2012","Jun","10","2012"); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
