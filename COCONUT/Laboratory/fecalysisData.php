<?php 
include ("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$wr = new database;

$wr->getPatientProfile($registrationNo);
$wr->getPatientChargesToEdit($itemNo);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><!-- InstanceBegin template="/Templates/beta.dwt" codeOutsideHTMLIsLocked="true" -->
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
.style18 {font-size: 12px}
.style20 {font-size: 10px}
.style7 {	color: #FF0000;
	font-weight: bold;
}
.style59 {font-size: 14px; font-weight: bold; color: #FF0080; }
.style62 {font-size: 14px; font-weight: bold; color: #FF0080; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style63 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style65 {font-size: 12px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style66 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style67 {font-size: 14px}
.style68 {
	color: #FF0080;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style70 {
	color: #000000;
	font-weight: bold;
}
.style72 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-weight: bold;
}
.style74 {font-size: 12px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; }
.style75 {font-size: 14px; font-weight: bold; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; }
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
<form name="adddonor" method = "get"
action="http://<?php echo $wr->getMyUrl(); ?>/COCONUT/Laboratory/sandigLabResIn.php">;
<input type="hidden" name="regno" value="<?php echo $registrationNo; ?>">
     <input type="hidden" name="itemNo" value="<?php echo $itemNo ?>">
     
<input type="hidden" name="lab17">
<input type="hidden" name="lab18">
<input type="hidden" name="patname">
<input type="hidden" name="gender">
<input type="hidden" name="gender1">
 <input type="hidden" name="lab19">
       <input type="hidden" name="lab16">
        <input type="hidden" name="lab20">
	  <input type="hidden" name="lab21">
          <input type="hidden" name="lab22">
	    <input type="hidden" name="lab23">
          <input type="hidden" name="lab23">
	  <input type="hidden" name="lab24">
        <input type="hidden" name="lab25">
	<input type="hidden" name="lab26">
      <input type="hidden" name="lab27">
     <input type="hidden" name="lab28">
      <input type="hidden" name="lab29">
<input type="hidden" name="lab32">
<input type="hidden" name="lab33">
<input type="hidden" name="lab29">

    <input type="hidden" name="resultType" value="fecalysis">

<body text="#000000" alink="#666600">
<div align="center">
  <h1><strong>FECALYSIS</strong>
  </h1>
</div>
<table width="610" border="0" cellpadding="0" cellspacing="0" bgcolor="">
    <tr>
      <td>Lab No </td>
      <td><span class="style63"><font color="#000000">
        <input name="labno" type="text" class="style59" value='$labno' " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></span></td>
    </tr>
    <tr>
      <td>Fecalysis No. </td>
      <td><span class="style63"><font color="#000000">
        <input name="testno" type="text" id="testno" class="style59" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></span></td>
    </tr>
     <tr>
      <td>Req Date </td>
      <td><span class="style63"><font color="#000000">
                <input name="reqdate" type="text" class="style7" id="reqdate" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="<?php echo $wr->patientCharges_dateCharge(); ?>">   
 </tr>
	 <tr>
      <td class="style17">Process Date </td>
      <td><form name="form1" action="">
          <select name="procMonth">
	<?php echo "<option value='".date("M")."'>".date("M")."</option>" ?>
            <option>Jan</option>
            <option>Feb</option>
            <option>March</option>
            <option>April</option>
            <option>May</option>
            <option>Jun</option>
            <option>Jul</option>
            <option>Aug</option>
            <option>Sep</option>
            <option>Oct</option>
            <option>Nov</option>
            <option>Dec</option>
          </select>
          <select name="procDay" size="1">
	<?php echo "<option value='".date("d")."'>".date("d")."</option>" ?>
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>14</option>
            <option>15</option>
            <option>16</option>
            <option>17</option>
            <option>18</option>
            <option>19</option>
            <option>20</option>
            <option>21</option>
            <option>22</option>
            <option>23</option>
            <option>24</option>
            <option>25</option>
            <option>26</option>
            <option>27</option>
            <option>28</option>
            <option>29</option>
            <option>30</option>
            <option>31</option>
          </select>
          <select name="procYear">
	<?php echo "<option value='".date("Y")."'>".date("Y")."</option>" ?>
            <option>2012</option>
            <option>2013</option>
            <option>2015</option>
            <option>2016</option>
            <option>2017</option>
          </select>
        </form>
       <strong><font color="#000000">        </font></strong></td>
    </tr>
    <tr>
      <td width="208">PHYSICIAN</td>
      <td width="402"><span class="style63"><font color="#000000">
        <input name="reqphy" type="text" id="physician" value='$ap' "class="style59"  " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></span></td>
    </tr>
    <tr>
      <td>PATHOLOGIST</td>
      <td><select name="patho"  class="style62" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
       <option>Noemia D. Bartolome, M.D.,FPSP</option>

      </select></td>
    </tr>
    <tr>
      <td>MEDICAL TECHNOLOGIST </td>
      <td><span class="style66">
        <label>
  <select name="medtech" class="style59" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
    <option></option>
    <option>Grace T. larroza, R.M.T.</option>
        <option>Helen Grace P. umipig, M.T.</option>
        <option>Emjie P. Pantorilla, M.T.</option>
        <option>Janice S. Tutanes, M.T., RN</option>
        <option>Judith Anne A. Sandig , M.T.</option>
        <option>Rey D. Larroza, R.M.T.</option>

    
  </select>
  <input name="examination" type="hidden" id="examrequested" value="Fecalysis">
        </label>
      </span></td>
    </tr>
    <tr>
      <td>SPECIMEN</td>
      <td><span class="style66"><strong><font color="#000000"><strong><font color="#000000">
        <input name="specimen" type="text" class="style59" id="testno" value='Stool' " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></font></strong></span></td>
    </tr>
    <tr>
      <td>Examination</td>
      <td><input name="Examination" type="text" class="style67" id="Examination" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="fecalysis"></td>
    </tr>
    <tr>
      <td class="style59">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</table>
  <label></label>
 
  
  <table width="84%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
    <!--DWLayoutTable-->
    <tr>
      <td width="24%" class="style65"><span class="style68">Color</span></td>
      <td width="24%" class="style65"><span class="style66"><font color="#000000"><strong>
        <input name="lab1" type="text" class="style59" id="lab1" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </strong></font></span></td>
      <td width="296" class="style65"><span class="style68">ENTAMOEBA HYSTOLYTICA:</span></td>
      <td width="23%" class="style65"><span class="style66" ></span></td>
    </tr>
    <tr>
      <td class="style65"><span class="style68">Consistency</span></td>
      <td class="style65"><span class="style66"><font color="#000000"><strong>
        <input name="lab2" type="text" class="style59" id="lab2" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </strong></font></span></td>
      <td class="style65"><span class="style68">   Cyst</span></td>
      <td class="style65"><input name="lab6" type="text" class="style67" id="lab6"" style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <tr>
      <td class="style65"><span class="style68">Parasitic Ova:</span></td>
      <td class="style65">&nbsp;</td>
      <td class="style65"><span class="style68">Throphozite</span></td>
      <td class="style65"><input name="lab7" type="text" class="style67" id="lab7" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>

      <td width="24%" class="style65"><span class="style68">&nbsp; Ascaris</span></td>
      <td width="24%" class="style65"><span class="style66"><font color="#000000"><strong>
        <input name="lab3" type="text" class="style59" id="lab3" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </strong></font></span></td>
      <td class="style65"><span class="style68">E. COLI:</span></td>
      <td width="23%" class="style65"><span class="style66"></span></td>
    </tr>
    <tr>
      <td class="style65"><span class="style68">&nbsp;&nbsp;Trichiuris</span></td>
      <td class="style65"><span class="style66"><font color="#000000"><strong>
        <input name="lab4" type="text" class="style59" id="lab4" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </strong></font></span></td>
      <td class="style65"><span class="style68">   Cyst</span></td>
      <td class="style65"><input name="lab8" type="text" class="style67" id="lab8" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <tr>
      <td class="style65"><span class="style68">&nbsp;&nbsp;Hookworm</span></td>
      <td class="style65"><span class="style66"><font color="#000000"><strong>
        <input name="lab5" type="text" class="style59" id="lab5" " style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </strong></font></span></td>
      <td class="style65"><span class="style68">Throphozite</span></td>
      <td class="style65"><input name="lab9" type="text" class="style67" id="lab9" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>

    <tr>
      <td class="style65"><span class="style68">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
      <td class="style65">&nbsp;</td>
      <td class="style65"><span class="style68">Pus Cells</span></td>
      <td class="style65"><input name="lab10" type="text" class="style67" id="lab10" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <tr>
      <td class="style65"><span class="style68">&nbsp;&nbsp;</span></td>
      <td class="style65">&nbsp;</td>
      <td class="style65"><span class="style68">Red Blood Cells</span></td>
      <td class="style65"><input name="lab11" type="text" class="style67" id="lab11" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <tr>
      <td class="style65"><span class="style68">&nbsp;</span></td>
      <td class="style65">&nbsp;</td>
      <td class="style65"><span class="style68">Charcot Leyden Crystals</span></td>
      <td class="style65"><input name="lab12" type="text" class="style67" id="lab12" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <tr>
      <td class="style65">&nbsp;</td>
      <td class="style65">&nbsp;</td>
      <td class="style65"><span class="style68">Fat Globules </span></td>
      <td class="style65"><span class="style66">
        <input name="lab13" type="text" class="style67" id="lab13" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </span></td>
    </tr>
    <tr>
      <td class="style65"><span class="style66"></span></td>
      <td class="style65"><span class="style66"></span></td>
      <td class="style65"><span class="style66"><span class="style68">Bacteria</span></span></td>
      <td class="style65"><input name="lab14" type="text" class="style67" id="lab14" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <tr>
      <td rowspan="2" class="style65"><span class="style66"></span></td>
      <td rowspan="2" class="style65"><span class="style66"></span></td>
      <td height="26" valign="top" class="style65"><span class="style68">Occult Blood</span></td>
      <td rowspan="2" class="style65"><input name="lab15" type="text" class="style67" id="lab15" " style="background-color:#B1FB17; font-weight: bold; color: #FF0080;" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <form name="form1" method="post" action="">
          <input type="text" name="textfield">
        </form>      </td>
    </tr>
    <tr>
      <td height="38">&nbsp;</td>
    </tr>
    <tr>
      <td class="style65">&nbsp;</td>
      <td class="style65">&nbsp;</td>
      <td class="style65">&nbsp;</td>
      <td class="style65">&nbsp;</td>
    </tr>
</table>
  <table width="784" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF" class="style7">
    <!--DWLayoutTable-->
    <tr>
      <td width="784" height="30" class="style18"><span class="style66">Remarks:</span><font color="#000000"><strong>
        <textarea name="lab19" cols="100" rows="8" class="style59" id="lab19" style="background-color:#B1FB17" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></textarea>
      </strong></font></td>
    </tr>
     <tr>
      <td height="30">&nbsp;</td>
    </tr>
    <tr>
      <td height="30" class="style18">
        <p><font color="#000000">&nbsp;</font></p>
      <p><span class="style20">        </p>
      <span class="style20">
      <input name="Submit" type="submit" class="style59" style="background-color:#B1FB17" value="Submit">
      <label>
      <input type="reset" name="Submit2" value="Reset"  class="style59" style="background-color:#B1FB17">
      </label>
      </span> </p></td>
    </tr>
</table>
  <span class="style20"><strong><font color="#000000"></font></strong></span><span class="style18"><strong><font color="#000000"><br>
          </font></strong></span>
</body>

</html>

