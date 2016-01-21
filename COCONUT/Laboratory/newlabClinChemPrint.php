<?php 
include("sandigLabDatabase.php");
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$wi=new sandigLab();
$ro=new database();
$ro->getPatientProfile($registrationNo);
$ro->getPatientChargesToEdit($itemNo);
$wi->showLabResult($registrationNo,$itemNo,"clinchem");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style6 {font-family: "Times New Roman", Times, serif; font-size: 27px; }
.style8 {font-size: 18; font-family: "Times New Roman", Times, serif; }
.style9 {font-size: 18}
.style12 {font-size: 16px}
.style13 {font-size: 18px; font-family: "Times New Roman", Times, serif; }
.style15 {font-size: 17px}
.style16 {font-size: 16px; font-family: "Times New Roman", Times, serif; }
.style18 {font-size: 15px}
.style20 {font-size: 12px; }
-->
</style>
</head>

<body>
<table width="900" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td><div align="center" class="style6">SANDIG MEDICAL CLINIC AND HOSPITAL </div></td>
  </tr>
  <tr>
    <td><div align="center">Tacurong City, Sultan Kudarat </div></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="900" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="112" height="27"><span class="style8"><b>Name:</b></span></td>
      <td width="258"><span class="style8"><strong><?php echo $ro->getPatientRecord_completeName(); ?></strong></span></td>
      <td width="79"><span class="style8"><strong><b>Age:</b></strong></span></td>
      <td width="176"><span class="style8"><strong><?php echo $ro->getPatientRecord_Age(); ?></strong></span></td>
      <td width="131"><span class="style8"><strong><b>Room:</b></strong></span></td>
      <td width="125"><span class="style8"><strong><?php echo $ro->getregistrationdetails_room(); ?></strong></span></td>
    </tr>
    <tr>
      <td><span class="style8"><b><strong><b>Reg. No:</b></strong> </span></td>
      <td><span class="style9"><storng><b><?php echo $ro->getregistrationdetails_registrationNo(); ?></b></strong></span></td>
      <td><span class="style8"><strong><b>Sex:</b></strong></span></td>
      <td><span class="style9"><strong><?php echo $ro->getPatientRecord_gender(); ?></strong></span></td>
      <td><span class="style8"><strong><b>Request Date:</b></strong> </span></td>
      <td><span class="style8"><strong><?php echo $ro->patientCharges_dateCharge(); ?></strong></span></td>
    </tr>
    <tr>
      <td><span class="style8"><strong><b>Specimen:</b></strong></span></td>
      <td><span class="style8"><strong><b>Blood</b></strong></span></td>
      <td><span class="style8"><strong><b>Company:</b></strong></span></td>
      <td><span class="style9"><strong><b><?php echo $ro->getRegistrationDetails_company(); ?><b></strong></span></td>
      <td><span class="style8"><strong><b>Time:</b></strong></span></td>
      <td><span class="style9"><strong><b><?php echo $ro->patientCharges_timeCharge(); ?></b></strong></span></td>
    </tr>
    <tr>
      <td><span class="style8"><b>Physician:</b></span></td>
      <td><span class="style8"></span></td>
      <td><span class="style9"></span></td>
      <td><span class="style9"></span></td>
      <td><span class="style9"></span></td>
      <td><span class="style9"></span></td>
    </tr>
</table>
  <blockquote>
    <blockquote>
      <blockquote>
        <blockquote>
          <blockquote>
            <blockquote>
              <h3 align="justify"><strong> CLINICAL CHEMISTRY </strong></h3>
            </blockquote>
          </blockquote>
        </blockquote>
      </blockquote>
    </blockquote>
  </blockquote>
  <table width="900" border="0" cellpadding="" cellspacing="" >
    <tr>
      <td width="10" height="24">&nbsp;</td>
      <td width="115"><div align="center" class="style13"><strong><b>TEST</b></strong></div></td>
      <td width="72"><div align="center" class="style8"><strong><b>RESULT</b></strong></div></td>
      <td width="286"><div align="center"><strong><b>NORMAL VALUES</b> </strong></div></td>
      <td width="170"><div align="center" class="style8">
        <div align="center"><strong><b>TEST</b></strong></div>
      </div></td>
      <td width="66"><div align="left" class="style8">
        <div align="center"><strong><b>RESULT</b></strong></div>
      </div></td>
      <td width="181"><div align="center" class="style12"><strong><b>NORMAL VALUES</b> </strong></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong><b>Glucose</b></strong></div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab1(); ?></strong></u></div></td>
      <td><div align="center" class="style20"><strong>3.9-5.8mmol/L/70-105mg/dl</strong></div></td>
      <td><span class="style16"><strong>Globulin</strong></span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab2(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Uric Acid</strong> </div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab3(); ?></strong></u></div></td>
      <td><div align="center" class="style20"><strong>M .208-0.428 mmol/L F 0.155-0.357mmol/L </strong></div></td>
      <td><span class="style16"><strong>A/G Ratio</strong> </span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab4(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Urate</strong></div></td>
      <td><div align="center" class="style8"><strong><u><?php echo $wi->lab5(); ?></u></strong></div></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16"><strong>SGOT</strong></span></td>
      <td><div align="center" class="style8"><strong><u><?php echo $wi->lab6(); ?></u></strong></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Total Cholesterol</strong> </div></td>
      <td><div align="center" class="style8"><strong><u><?php echo $wi->lab7(); ?></u></strong></div></td>
      <td><div align="center" class="style20"><strong> 5.17 mmol/L </stong></div></td>
      <td><span class="style16"><strong>SGPT</strong></span></td>
      <td><div align="center" class="style8"><strong><u><?php echo $wi->lab8(); ?></u></strong></div></td>
      <td><div align="center" class="style20"><strong>M up to 41U/L F up to 31U/L</strong> </div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>HDL</strong></div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab9(); ?></strong></u></div></td>
      <td><div align="center" class="style20"><strong>M 1.06-1.52mmol/L F 1.26-1.94mmol/L</strong> </div></td>
      <td><span class="style16"><strong>GGT</strong></span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab10(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>LDL</strong></div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab11(); ?></strong></u></div></td>
      <td><div align="center" class="style20"><strong> 3.38 mmol/L </strong></div></td>
      <td><span class="style16"><strong>LDH</strong></span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab12(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Triglyceride</strong></div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab13(); ?></strong></u></div></td>
      <td><div align="center" class="style20"><strong>M 0.45-1.82mmol/L F 0.41.54mmol/L </strong></div></td>
      <td><span class="style16"><strong> Alkaline Phosphatase </strong></span></td>
      <td><div align="center" class="style8"><u><?php echo $wi->lab14(); ?></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Creatinine</strong></div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab15(); ?></strong></u></div></td>
      <td><div align="center" class="style20"><strong>M 80-133 umol/L F 62-115 umol/L<strong></div></td>
      <td><span class="style16"><strong>Acid Phosphatase</strong> </span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab16(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Total Bilirubin</strong> </div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab17(); ?></strong></u></div></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16"><strong>CK-MB</strong></span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab18(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Direct Bilirubin</strong> </div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab19(); ?></strong></u></div></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16"><strong>Amylase</strong></span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab20(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>InDirect Bilirubin</strong> </div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab21(); ?></strong></u></div></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16"><strong>Calcium</strong></span></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab22(); ?></strong></u></div></td>
      <td><div align="center"><span class="style12"><span class="style18"><span class="style20"></span></span></span></div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16"><strong>Total Protein</strong> </div></td>
      <td><div align="center" class="style8"><u><strong><?php echo $wi->lab23(); ?><strong></u></div></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16">Sodium</span></td>
      <td><div align="center" class="style8"><u><?php echo $wi->lab24(); ?></u></div></td>
      <td><div align="center" class="style20">135-145 mmol/L </div></td>
    </tr>
    <tr>
      <td><span class="style12"></span></td>
      <td><div align="left" class="style16">Albmin</div></td>
      <td><div align="center" class="style8"><u><?php echo $wi->lab25(); ?></u></div></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16">Potassium</span></td>
      <td><div align="center" class="style8"><u><?php echo $wi->lab26(); ?></u></div></td>
      <td><div align="center" class="style20">3.50-5.50 mmol/L </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style15"></span></td>
      <td><span class="style9"></span></td>
      <td><div align="center"><span class="style9"><span class="style18"><span class="style20"></span></span></span></div></td>
      <td><span class="style16">Chloride</span></td>
      <td><div align="center" class="style8"><u><?php echo $wi->lab27(); ?></u></div></td>
      <td><div align="center" class="style20">96-106 mmol/L </div></td>
    </tr>
</table>
  <table width="900" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="238">&nbsp;</td>
      <td width="345">&nbsp;</td>
      <td width="193">&nbsp;</td>
      <td width="114">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center"><u><?php echo $wi->doc(); ?></u><br>PATHOLOGIST</div></td>
      <td>&nbsp;</td>
      <td><div align="center"><?php echo $wi->medtech();  ?><br>MEDTECH</div></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</body>
</html>

