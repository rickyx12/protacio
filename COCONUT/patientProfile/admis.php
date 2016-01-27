<?php
include("../../myDatabase2.php");
$registrationNo=$_GET['registrationNo'];
$ro=new database2();

$patientNo=$ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);

$birthplace=$ro->selectNow("patientRecord2","birthPlace","registrationNo",$registrationNo);
$nationality=$ro->selectNow("patientRecord2","nationality","registrationNo",$registrationNo);
$occupation=$ro->selectNow("patientRecord2","pxOccupation","registrationNo",$registrationNo);
$fathersname=$ro->selectNow("patientRecord2","fathersName","registrationNo",$registrationNo);
$mothersname=$ro->selectNow("patientRecord2","mothersName","registrationNo",$registrationNo);
$address=$ro->selectNow("patientRecord2","address","registrationNo",$registrationNo);
$spousename=$ro->selectNow("patientRecord2","spouseName","registrationNo",$registrationNo);
$religion=$ro->selectNow("patientRecord","religion","patientNo",$patientNo);
$completename=$ro->selectNow("patientRecord","completeName","patientNo",$patientNo);
$address1=$ro->selectNow("patientRecord","Address","patientNo",$patientNo);
$birthdate=$ro->selectNow("patientRecord","Birthdate","patientNo",$patientNo);
$age=$ro->selectNow("patientRecord","Age","patientNo",$patientNo);
$gender=$ro->selectNow("patientRecord","Gender","patientNo",$patientNo);
$contactno=$ro->selectNow("patientRecord","contactNo","patientNo",$patientNo);
$civilstatus=$ro->selectNow("patientRecord","civilStatus","patientNo",$patientNo);
$phic=$ro->selectNow("patientRecord","phic","patientNo",$patientNo);
$dateregistered=$ro->selectNow("registrationDetails","dateRegistered","patientNo",$patientNo);
$timeregistered=$ro->selectNow("registrationDetails","timeRegistered","patientNo",$patientNo);
$room=$ro->selectNow("registrationDetails","room","patientNo",$patientNo);
$admittedby=$ro->selectNow("registrationDetails","registeredBy","patientNo",$patientNo);
$type=$ro->selectNow("registrationDetails","type","patientNo",$patientNo);
$dateunregistered=$ro->selectNow("registrationDetails","dateUnregistered","patientNo",$patientNo);
$timeunregistered=$ro->selectNow("registrationDetails","timeUnregistered","patientNo",$patientNo);
$finaldiagnosis=$ro->selectNow("registrationDetails","finalDiagnosis","patientNo",$patientNo);
$company=$ro->selectNow("registrationDetails","company","patientNo",$patientNo);


$attendingdoc=$ro->getAttendingDoc($registrationNo,"ATTENDING")


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>In Patient Information</title>
<style type="text/css">
.H1 {
	text-align: center;
}
#form1 table tr td {
}
.A {
	text-align: center;
}
.A {
	font-weight: bold;
}
.B {
	text-align: center;
	font-weight: bold;
}
.C {
	font-weight: bold;
	text-align: center;
}
#form4 table tr td {
	font-weight: bold;
	font-size: 12px;
}
</style>
</head>

<body>

<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="1000" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="327" height="29">ADMISSION AND DISCHARGE RECORD</td>
      <td width="103">Patient No:</td>
      <td width="129"><?php echo $patientNo ?></td>
      <td width="78">Case No:</td>
      <td width="151"><?php echo $registrationNo ?></td>
    </tr>
  </table>
</form>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="A">IN-PATIENT INFORMATION </td>
  </tr>
</table>

<p>&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
  <table width="1000" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="117">Patient's Name:</td>
      <td colspan="13"><?php echo $completename; ?></td>
    </tr>
    <tr>
      <td>Address:</td>
      <td colspan="5"><?php echo $address1; ?></td>
      <td width="77">Phone No:</td>
      <td colspan="2"><?php echo $contactno; ?></td>
      <td width="59">Sex:</td>
      <td width="41"><?php echo $gender; ?></td>
      <td colspan="2">Status:</td>
      <td colspan="3"><?php echo $civilstatus; ?></td>
    </tr>
    <tr>
      <td>Date Of Birth:</td>
      <td width="54"><?php echo $birthdate; ?></td>
      <td width="28">Age:</td>
      <td width="25"><?php echo $age; ?></td>
      <td width="64">Birthplace:</td>
      <td width="75"><?php echo $birthplace; ?>;</td>
      <td colspan="2">Nationality:</td>
      <td><?php echo $nationality; ?></td>
      <td>Religion:</td>
      <td colspan="4"><?php echo $religion; ?></td>      
      <td width="80">Occupation</td>
      <td width="130"><?php echo $occupation; ?></td>
    </tr>
    <tr>
      <td>Father's Name:</td>
      <td colspan="7"><?php echo $fathersname; ?></td>
      <td>Address:</td>
      <td colspan="3">&nbsp;</td>
      <td width="52">Tel No:</td>
      <td width="92">&nbsp;</td>
    </tr>
    <tr>
      <td>Mother's Name:</td>
      <td colspan="7"><?php echo $mothersname; ?></td>
      <td width="60">Address:</td>
      <td colspan="3">&nbsp;</td>
      <td>Tel No:</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Spouse/Guardians:</td>
      <td colspan="7"><?php echo $spousename; ?></td>
      <td>Address:</td>
      <td colspan="3"><?php echo $address; ?></td>
      <td>Tel No:</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="B">ADMISSION</td>
  </tr>
</table>
<form id="form3" name="form3" method="post" action="">
  <table width="1000" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="140">Admitted By:</td>
      <td width="187"><?php echo $admittedby; ?></td>
      <td width="194">Date/Time Admitted:</td>
      <td width="84"><?php echo $dateregistered; ?></td>
      <td width="85"><?php echo $timeregistered; ?></td>
      <td width="118">Room No:</td>
      <td width="178"><?php echo $room; ?></td>
    </tr>
    <tr>
      <td>Type of Admission:</td>
      <td><?php echo $type; ?></td>
      <td>Social Service Classification:</td>
      <td colspan="2">&nbsp;</td>
      <td>Ward/Service</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Attending Physician:</td>
      <td colspan="6"><?php echo $attendingdoc; ?></td>
    </tr>
    <tr>
      <td>Name Of Employer:</td>
      <td>&nbsp;</td>
      <td>Health Insurance Name:</td>
      <td colspan="2"><?php echo $company; ?></td>
      <td>Philhealth:</td>
      <td><?php echo $phic; ?></td>
    </tr>
    <tr>
      <td>Data Given By:</td>
      <td>&nbsp;</td>
      <td>Address of Informant:</td>
      <td colspan="2">&nbsp;</td>
      <td>Relation To Patient:</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="C">DISCHARGE</td>
  </tr>
</table>
<form id="form4" name="form4" method="post" action="">
  <table width="1000" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td width="162" height="21">Date/Time Discharge:</td>
      <td width="71"><?php echo $dateunregistered; ?></td>
      <td width="67"><?php echo $timeunregistered; ?></td>
      <td width="358">&nbsp;</td>
      <td width="162">Discharge By:</td>
      <td width="166">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Final Diagnosis:</td>
      <td colspan="3"><p><?php echo $finaldiagnosis; ?></p>
      <p>&nbsp;</p></td>
      <td valign="top">ICD Code No.</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Operational Procedures:</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td>Disposition:</td>
      <td colspan="2">Result:</td>
      <td>&nbsp;</td>
      <td colspan="2">ATTENDING PHYSICIAN</td>
    </tr>
    <tr>
      <td><input type="radio" name="radio" id="radio9" value="radio" />
        <label for="radio9"></label>
        Transferred:</td>
      <td colspan="2"><input type="radio" name="radio" id="radio10" value="radio" />
        Improved   </td>
      <td colspan="3"><input type="radio" name="radio" id="radio11" value="radio" /> 
        Not Treated
</td>
    </tr>
    <tr>
      <td><input type="radio" name="radio" id="radio" value="radio" />
        <label for="radio"></label>
      Discharge</td>
      <td colspan="2"><input type="radio" name="radio" id="radio3" value="radio" />
        <label for="radio3"></label> 
        Recovered
 </td>
      <td><input type="radio" name="radio" id="radio12" value="radio" /> 
        Diagnostic Only</td>
      <td>&nbsp;</td>
      <td>MD</td>
    </tr>
    <tr>
      <td><input type="radio" name="radio" id="radio16" value="radio" />
        DAMA/HAMA</td>
      <td colspan="2"><input type="radio" name="radio" id="radio17" value="radio" />
        Died</td>
      <td><input type="radio" name="radio" id="radio18" value="radio" />
        Autopsy</td>
      <td colspan="2">Signature over printed name</td>
    </tr>
    <tr>
      <td><input type="radio" name="radio" id="radio2" value="radio" />
        Absconded</td>
      <td colspan="2"><input type="radio" name="radio" id="radio4" value="radio" />
        Unimprove</td>
      <td colspan="3"><input type="radio" name="radio" id="radio5" value="radio" />
        No Autopsy</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
