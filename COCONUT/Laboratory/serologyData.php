<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$ro=new database();
$ro->getPatientProfile($registrationNo);
$ro->getPatientChargesToEdit($itemNo);



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>addaccount</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:473px;
	top:242px;
	width:237px;
	height:24px;
	z-index:1;
}
body {
	background-color: #FFFFFF;
	background-image: url();
}
#Layer2 {
	position:absolute;
	left:231px;
	top:834px;
	width:289px;
	height:22px;
	z-index:2;
}
#Layer3 {
	position:absolute;
	left:12px;
	top:18px;
	width:37px;
	height:29px;
	z-index:1;
}
a:link {
	color: #000000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: none;
	color: #002969;
}
a:active {
	text-decoration: none;
}
#Layer6 {position:absolute;
	left:411px;
	top:22px;
	width:39px;
	height:33px;
	z-index:1;
}
.style17 {font-size: 12px; font-weight: bold; }
.style18 {font-size: 12px}
.style20 {font-size: 10px}
.style7 {	color: #FF0000;
	font-weight: bold;
}
.style21 {
	color: #C0C0C0;
	font-weight: bold;
}
.style23 {color: #000000}
.style24 {
	font-size: 24px;
	font-weight: bold;
}
.style25 {font-size: 16px}
-->
</style>
</head><SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Tom Khoury (twaks@yahoo.com) -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}
//  End -->
</script>
</head>
<form method="get" 
action="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Laboratory/sandigLabResIn.php">
<?php

$ro->coconutHidden("regno",$registrationNo);
$ro->coconutHidden("procMonth",date("M"));
$ro->coconutHidden("procDay",date("d"));
$ro->coconutHidden("procYear",date("Y"));
$ro->coconutHidden("gender","");
$ro->coconutHidden("gender1","");
$ro->coconutHidden("itemNo",$itemNo);
$ro->coconutHidden("specimen","");
$ro->coconutHidden("examination","serology");


?>
 

<body text="#000000" alink="#666600"><BODY OnLoad="placeFocus()">
<div align="center"><span class="style24">SEROLOGY</span>
</div>
<table width="461" border="0" cellpadding="0" cellspacing="0" bgcolor="#EBEBD6">
    <tr>
      <td class="style18"><span class="style17">LAB NO. </span></td>
      <td><input name="labno" type="text" class="style7" value='' " style="background-color:" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="30"></td>
    </tr>
    <tr>
      <td class="style17">SEROLOGY  No </td>
      <td><input name="testno" type="text" class="style7" id="testno" " style="background-color:" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="30"></td>
    </tr>
    <tr>
      <td class="style17"> Request Date</td>
      <td><input name="reqdate" type="text" class="style7" id="testno" " style="background-color:" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="<?php echo $ro->patientCharges_dateCharge(); ?>" size="30"></td>
    </tr>
    <tr>
      <td width="201" class="style17">PHYSICIAN</td>
      <td width="244"><input name="reqphy" type="text" class="style7" id="physician" value='$ap' " style="background-color:" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="30"></td>
    </tr>
    <tr>
      <td class="style18"><span class="style17">PATHOLOGIST</span></td>
      <td><label>
      <select name="patho"  class="style7" " style="background-color:" onkeydown="if(event.keyCode==13) event.keyCode=9;">
          <option></option>
          <option>NOEMIA D. BARTOLOME, M.D.,FPSP</option>
  </select>
    </tr>
    <tr>
      <td class="style18"><span class="style17">MEDICAL TECHNOLOGIST </span></td>
      <td><label>
      <select name="medtech" class="style7" id="physician" " style="background-color:" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>Grace T. larroza, R.M.T.</option>
        <option>Helen Grace P. umipig, M.T.</option>
        <option>Emjie P. Pantorilla, M.T.</option>
        <option>Janice S. Tutanes, M.T., RN</option>
        <option>Judith Anne A. Sandig , M.T.</option>
        <option>Rey D. Larroza, R.M.T.</option>

      </select>
      </label></td>
    </tr>
</table>
  <input name="resultType" type="hidden" id="examrequested" value="serology">
  <label></label>


  <table border="0" cellpadding="2" cellspacing="2" bordercolor="#000000" bgcolor="">
    
<tr>
      <td><strong>Type of examination </strong></td>
      <td><div align="center" class="style21 style23">RESULT</div></td>
      <td><strong>NORMAL VALUES</strong> </td>
</tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" class="style7" " style="background-color:#FFC4E1" value="psa">
      PSA</font></strong></font></td>
      <td><div align="center">
        <input name="lab1" type="text" class="style7" autocomplete="off"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><label>
        <select name="lab20" class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
		<option></option>
          <option>0.0-4.Onanogram/ml</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="afp">
        AFP</font></strong></font></td>
      <td><div align="center">
        <input name="lab2" type="text" class="style7" id="afp" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab21" class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>0.0-15.Onanogram/ml</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="tsh">
        TSH
      </font></strong></font></td>
      <td><div align="center">
        <input name="lab3" type="text" class="style7" id="tsh" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab22"class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>0.47-5.01ulU/ml</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="t4">
        T4</font></strong></font></td>
      <td><div align="center">
        <input name="lab4" type="text" class="style7" id="t4" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab23" class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>4.5-12.0ug/dl</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="t3" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        T3</font></strong></font></td>
      <td><div align="center">
        <input name="lab5" type="text" class="style7" id="t3" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab24"class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>0.72-1.24uptake unit</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="aso" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        ASO</font></strong></font></td>
      <td><div align="center">
        <input name="lab6" type="text" class="style7" id="aso" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab25"class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>POSITIVE=>200LlU/ml</option>
		<option>NEGATIVE=>200LlU/ml</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="aptt" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        APTT</font></strong></font></td>
      <td><div align="center">
        <input name="lab7" type="text" class="style7" id="aptt" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab26" class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>26.7-37.0sec</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="lab8" value="" class="style7" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        PT</font></strong></font></td>
      <td><div align="center">
        <input name="lab8" type="text" class="style7" id="pt" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab27"class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>10-13.4sec</option>
      </select></td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="HBsAG" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        HBSAG</font></strong></font></td>
      <td><div align="center">
        <input name="lab9" type="text" class="style7" id="HBsAG" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="SYPHILLISTP" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        SYPHILLIS TP </font></strong></font></td>
      <td><div align="center">
        <input name="lab10" type="text" class="style7" id="syphillistp" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td>&nbsp;</td>
    </tr>
     <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="HIV" class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        HIV</font></strong></font></td>
      <td><div align="center">
        <input name="lab11" type="text" class="style7" id="HIV" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="TYPHIDOT"class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        TYPHIDOT</font></strong></font></td>
     <td><div align="center">
        <input name="lab12" type="text" class="style7" id="typhidot" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab28" class="style7" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      <option></option>
        <option>POSITIVE</option>
        <option>NEGATIVE</option>
      </select></td>
    </tr>
     <tr>
      <td><font size="2"><strong><font color="#000000">
        <input type="checkbox" name="" value="rf"class="style7" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        RF
      </font></strong></font></td>
      <td><div align="center">
        <input name="lab13" type="text" class="style7" id="rf" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60">
      </div></td>
      <td><select name="lab29" class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>POSITIVE->20IU/ml</option>
        <option>NEGATIVE->20IU/ml</option>
      </select></td>
    </tr>
      <tr>
        <td><font size="2"><strong><font color="#000000">
          <input name="" type="checkbox"class="style7" id="testlist" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="fti">
        FTI</font></strong></font></td>
        <td><input name="lab14" type="text" class="style7" id="fti" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60"></td>
        <td><select name="patname" class="style7"  style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option></option>
          <option>5.012-0ug/Dl</option>
        </select></td>
      </tr>
      <tr>
        <td><font size="2"><strong><font color="#000000">
          <input name="" type="checkbox"class="style7" id="testlist" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="h.pylori">
        </font></strong></font><strong>H.PYLORI</strong></td>
        <td><input name="lab15" type="text" class="style7" id="hpylori" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><font size="2"><strong><font color="#000000">
          <input name="" type="checkbox"class="style7" id="testlist" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="hbsag(v2)quanti">
        HBSAg(V2) quanti </font></strong></font></td>
        <td><input name="lab16" type="text" class="style7" id="hbsag2" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><font size="2"><strong><font color="#000000">
          <input name="" type="checkbox"class="style7" id="testlist" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="ausab(anti-hbs)">
        AUSAB(Anti-hbs)</font></strong></font></td>
        <td><input name="lab17" type="text" class="style7" id="ausab" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><font size="2"><strong><font color="#000000">
          <input name="" type="checkbox"class="style7" id="testlist" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="coretm-m(igm anti hbc)">
        CORE TM-M (Igm Anti HBC) </font></strong></font></td>
        <td><input name="lab18" type="text" class="style7" id="core" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><font size="2"><strong><font color="#000000">
          <input name="" type="checkbox"class="style7" id="testlist" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="havab(Igm Anti Hav)">
          HAVAB (Igm Anti-Hav)         </font></strong></font></td>
        <td><input name="lab19" type="text" class="style7" id="havab" autocomplete="off" style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="60"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
      <td><font size="2"><strong></strong></font></td>

      <td><div align="left">

      </div></td>
      <td>&nbsp;</td>
    </tr>
</table>
    <table width="318" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#EBEBD6" class="style7">
      <tr>
        <td width="318" height="30" class="style18"><span class="style25"></span>
            
            <span class="style20"> <br>
            <br>
            <input type="submit" name="Submit" value="Submit" class="style7" " style="background-color:#FFC4E1" >
            <label>
            <input type="reset" name="Submit2" value="Reset" class="style7" " style="background-color:#FFC4E1" >
            </label>
            </span> </td>
      </tr>
    </table>
    <br>
    <span class="style20"><strong><font color="#000000"></font></strong></span><span class="style18"><strong><font color="#000000"><br>
          </font></strong></span><span class="style20">
          </p>
          </span>
</body>

</html>
