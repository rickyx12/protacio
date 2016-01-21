<?php
include("../../myDatabase.php");

$fromMonth = $_GET['fromMonth'];
$fromDay = $_GET['fromDay'];
$fromYear = $_GET['fromYear'];
$type = $_GET['type'];


$ro = new database();

if($type == "GSIS") {
$transNo = 1;
}else if($type == "SSS") {
$transNo = 2;
}else {
$transNo =3;
}

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

$tn2=$fromYear."-".$fromMonth."-".$fromDay;

$tn2=strtotime($tn2);
$tn3=date("Ymd",$tn2);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Transmital</title>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana;
	font-size: 10px;
	color: #000000;
}
.style2 {
	font-family: Verdana;
	font-size: 12px;
	color: #000000;
	font-weight: bold;
}
.style3 {
	font-family: Verdana;
	font-size: 10px;
	color: #000000;
	font-weight: bold;
}
.style4 {
	font-family: Verdana;
	font-size: 9px;
	color: #000000;
}
-->
</style>
</head>

<body>

<?php

echo "
<div align='center'>
  <table width='1000' border='0' cellspacing='0' cellpadding='0'>
    <tr>
      <td height='92'><div align='center'><span class='style1'>Republic of the Philippines</span><br />
          <span class='style2'>PHILIPPINE HEALTH INSURANCE CORPORATION</span><br />
          <span class='style1'>14th Floor, Citystate Centre<br />
        709 Shaw Blvd., Pasig City</span><br />
        <br />
        <span class='style2'>TRANSMITTAL LETTER - $type</span></div></td>
    </tr>
    <tr>
      <td height='20'></td>
    </tr>
    <tr>
      <td height='450' valign='top'><div align='center'>
        <table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000'>
          <tr>
            <td height='35' colspan='4'><div align='left'><span class='style1'>&nbsp;&nbsp;&nbsp;NAME OF HOSPITAL</span><br />
                    <span class='style2'>&nbsp;&nbsp;&nbsp;".$ro->getReportInformation("hmoSOA_name")."</span></div></td>
            <td width='16%' rowspan='2'><div align='center'><span class='style1'>ACCREDITATION<br /><br /></span>
                    <span class='style3'>312432<br />
              / 312432 </span></div></td>
            <td colspan='2'><div align='left'><span class='style1'>&nbsp;&nbsp;&nbsp;DATE FILED:</span> <span class='style3'> $fromMonth $fromDay, $fromYear </span> </div></td>
          </tr>
          <tr>
            <td height='35' colspan='4'><div align='left'><span class='style1'>&nbsp;&nbsp;&nbsp;ADDRESS</span><br />
                    <span class='style3'>&nbsp;&nbsp;&nbsp;".$ro->getReportInformation("hmoSOA_address")."</span> </div></td>
            <td colspan='2'><div align='left'><span class='style1'>&nbsp;&nbsp;&nbsp;TRANSMITTAL NUMBER:</span> <span class='style3'>".date("His")." - $tn3</span> </div></td>
          </tr>
          <tr>
            <td height='25' colspan='2' class='style3'><div align='center'>PHI No. G/S </div></td>
            <td width='18%' class='style3'><div align='center'>Name of Member </div></td>
            <td width='18%' class='style3'><div align='center'>Name of Patient </div></td>
            <td class='style3'><div align='center'>Confinement Period </div></td>
            <td width='27%' class='style3'><div align='center'>Final Diagnosis </div></td>
            <td width='10%' class='style3'><div align='center'>Amount Claim </div></td>
          </tr>
";


$ro->phicTransmital($fromMonth,$fromDay,$fromYear,$type);

echo "
        </table>
      </div></td>
    </tr>
    <tr>
      <td height='70'><div align='left'>
        <table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td height='30' colspan='6'><div align='left' class='style1'>This is to certify that all claims and information stated above are true and correct based on my personal knowledge and on hospital records. </div></td>
          </tr>
          <tr>
            <td width='20%'><div align='left' class='style1'>PAGE NO.: 1</div></td>
            <td width='31%'></td>
            <td width='9%' class='style1'><div align='left'>Signature</div></td>
            <td width='2%' class='style1'><div align='center'>:</div></td>
            <td colspan='2' class='style1'>_________________________________</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td class='style1'><div align='left'>Name (Print) </div></td>
            <td class='style1'><div align='center'>:</div></td>
            <td colspan='2' class='style1'>________<u>Ricardo Osit</u>__________</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td class='style1'></td>
            <td class='style1'></td>
            <td width='20%' class='style4'><div align='center'>Quality Management Representative </div></td>
            <td width='18%' class='style1'></td>
          </tr>
        </table>
      </div></td>
    </tr>
	<tr>
	  <td colspan='7'>&nbsp;</td>
	</tr>
  </table>
</div>
";

?>
</body>
</html>
