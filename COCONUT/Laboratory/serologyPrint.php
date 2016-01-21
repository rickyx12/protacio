<?php
include("sandigLabDatabase.php");
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];


$wr=new sandigLab();
$ro=new database();
$ro->getPatientProfile($registrationNo);
$ro->getPatientChargesToEdit($itemNo);
$wr->showLabResult($registrationNo,$itemNo,"serology");

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
      <td></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <pre align="center" class="style1">                  Serology
</pre>
 
<table border=1 cellspacing=0 width='60%'>

<Tr>
<th>Description</th>
<th>Result</th>
<th>Normal Values</th>
</tr>
<?php if($wr->lab1 != "") { ?>
<tr>
<tD><b>PSA</b></tD>
<td>&nbsp;<?php echo $wr->lab1(); ?></tD>
<Td><?php echo $wr->lab20(); ?></tD>
</tr>

<?php } else {  } ?>


<?php if($wr->lab2() != "" ) { ?>
<tr>
<td><b>AFP</b></tD>
<td>&nbsp;<?php echo $wr->lab2(); ?></tD>
<Td><?php echo $wr->lab21(); ?></td>
</tr>
<?php } else { } ?>


<?php if($wr->lab3() != "") {  ?>
<tr>
<td><b>TSH</b></tD>
<td>&nbsp;<?php echo $wr->lab3(); ?></tD>
<td><?php echo $wr->lab22(); ?></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab4() != "") { ?>
<Tr>
<tD><b>T4</b></tD>
<Td>&nbsp;<?php echo $wr->lab4(); ?></tD>
<td><?php echo $wr->lab23(); ?></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab5() != "" ) { ?>
<Tr>
<tD>&nbsp;<b>T3</b></tD>
<Td><?php echo $wr->lab5(); ?></tD>
<td><?php echo $wr->lab24(); ?></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab6() != "") { ?>
<Tr>
<tD><b>ASO</b></tD>
<Td>&nbsp;<?php echo $wr->lab6(); ?></tD>
<td><?php echo $wr->lab25(); ?></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab7() != "" ) { ?>
<Tr>
<tD><b>APTT</b></tD>
<Td>&nbsp;<?php echo $wr->lab7(); ?></tD>
<td><?php echo $wr->lab26(); ?></td>
</tr>
<?php } else { } ?>


<?php if($wr->lab8() != "") { ?>
<Tr>
<tD><b>PT</b></tD>
<Td>&nbsp;<?php echo $wr->lab8(); ?></tD>
<td><?php echo $wr->lab27(); ?></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab9() != "") { ?>
<Tr>
<tD><b>HBSAG</b></tD>
<Td>&nbsp;<?php echo $wr->lab9(); ?></tD>
<td>&nbsp;</tD>
</tr>
<?php }else { } ?>



<?php if($wr->lab10() != "" ) { ?>
<Tr>
<tD><b>SYPHILLIS TP</b></tD>
<Td>&nbsp;<?php echo $wr->lab10(); ?></tD>
<tD>&nbsp;</tD>
</tr>
<?php }else { } ?>



<?php if($wr->lab11() != "") { ?>
<Tr>
<tD><b>HIV</b></tD>
<Td>&nbsp;<?php echo $wr->lab11(); ?></tD>
<tD>&nbsp;</tD>
</tr>
<?php } else { } ?>


<?php if($wr->lab12() != "") { ?>
<Tr>
<tD><b>TYPHIDOT</b></tD>
<Td>&nbsp;<?php echo $wr->lab12(); ?></tD>
<td><?php echo $wr->lab28(); ?></td>
</tr>
<?php }else { } ?>

<?php if($wr->lab13() != "") { ?>
<Tr>
<tD><b>RF</b></tD>
<Td>&nbsp;<?php echo $wr->lab13(); ?></tD>
<td><?php echo $wr->lab29(); ?></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab14() != "" ) { ?>
<Tr>
<tD><b>FTI</b></tD>
<Td>&nbsp;<?php echo $wr->lab14(); ?></tD>
<td><?php echo $wr->patname(); ?></td>
</tr>
<?php }else { } ?>

<?php if($wr->lab15() != "" ) { ?>
<Tr>
<tD><b>H.PYLORI</b></tD>
<Td>&nbsp;<?php echo $wr->lab15(); ?></tD>
<td></td>
</tr>
<?php }else { } ?>


<?php if($wr->lab16() != "") { ?>
<Tr>
<tD><b><font size=2>HBSAg(V2) quanti</font></b></tD>
<Td>&nbsp;<?php echo $wr->lab16(); ?></tD>
<td>&nbsp;</td>
</tr>
<?php }else { } ?>

<?php if($wr->lab17() != "") { ?>
<Tr>
<tD><b><font size=2>AUSAB(Anti-hbs)</font></b></tD>
<Td>&nbsp;<?php echo $wr->lab17(); ?></tD>
<td>&nbsp;</td>
</tr>
<?php }else { } ?>


<?php if($wr->lab18() != "") { ?>
<Tr>
<tD><b><font size=2>CORE TM-M (Igm Anti HBC)</font></b></tD>
<Td>&nbsp;<?php echo $wr->lab18(); ?></tD>
<td>&nbsp;</td>
</tr>
<?php }else { } ?>


<?php if($wr->lab19() != "") { ?>
<Tr>
<tD><b><font size=2>HAVAB (Igm Anti-Hav) </font></b></tD>
<Td>&nbsp;<?php echo $wr->lab19(); ?></tD>
<td>&nbsp;</td>
</tr>
<?php }else { } ?>


</table>

  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>

