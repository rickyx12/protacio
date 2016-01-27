<?php
include("sandigLabDatabase.php");
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];


$wr=new sandigLab();
$ro=new database();
$ro->getPatientProfile($registrationNo);
//$ro->getPatientChargesToEdit($itemNo);
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
      <td>Urine</td>
      <td><b>Company:</b></td>
      <td><?php echo $ro->getRegistrationDetails_company(); ?></td>
      <td><b>Time:</b></td>
      <td><?php //echo $ro->patientCharges_timeCharge(); ?></td>
    </tr>
    <tr>
      <td><b>Physician:</b></td>
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <pre align="center" class="style1">                  URINALYSIS
</pre>
  <table width="800" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="123"><div align="left">General</div></td>
      <td width="270"><div align="center">Result</div></td>
      <td width="284"><div align="left">Microscopic</div></td>
      <td width="110"><div align="center">Result</div></td>
    </tr>
    <tr>
      <td> <div align="justify">
        <blockquote>
          <p><b>Color:</b> </p>
        </blockquote>
      </div></td>
      <td><?php echo $wr->lab1(); ?></td>
      <td>Pus Cells </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Transparency:</b></td>
      <td><?php echo $wr->lab4(); ?></td>
      <td>RBC</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Reaction:</b></td>
      <td><?php echo $wr->lab6(); ?></td>
      <td>Cast:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Specific Gravity:</b></td>
      <td><?php echo $wr->lab8(); ?></td>
      <td>Hyaline</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Coarse Granular </td>
      <td><?php echo $wr->lab5(); ?></td>
    </tr>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Fine Granular </td>
      <td><?php echo $wr->lab3(); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Waxy</td>
      <td><?php echo $wr->lab7(); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>WBC</td>
      <td><?php echo $wr->lab23(); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>rbc cast </td>
      <td><?php echo $wr->lab24(); ?></td>
    </tr>
    <tr>
      <td><b>Acetone:</b></td>
      <td><?php echo $wr->lab14(); ?></td>
      <td>Crystals</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Albumin:</b></td>
      <td><?php echo $wr->lab10(); ?></td>
      <td>Uric Acid </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Sugar:</b></td>
      <td><?php echo $wr->lab12(); ?></td>
      <td>Calcium Oxalate </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Bilirubin</td>
      <td><?php echo $wr->lab18(); ?></td>
      <td>Amorphous Urates </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Urobilinogen</td>
      <td><?php echo $wr->lab20(); ?></td>
      <td>Amorphous Phosphates </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Ketone</td>
      <td>&nbsp;</td>
      <td>Triple Phosphates </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Epithelial Cells </td>
      <td><?php echo $wr->lab25(); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Mucus Threads </td>
      <td><?php echo $wr->lab27(); ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Bacteria</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>Yeast Cells</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>

