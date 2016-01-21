<?php  
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];

$wr =new database;

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
	background-color: lightyellow;
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
.style24 {
	font-size: 18px;
	color: #000000;
	font-weight: bold;
}
.style32 {
	color: #000000;
	font-weight: bold;
}
.style34 {font-size: 24px; color: #000000; font-weight: bold; }
-->
</style>
</head>
<SCRIPT LANGUAGE="JavaScript">
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
<form name="adddonor" method="get"
action="http://<?php echo $wr->getmyURL(); ?>/COCONUT/Laboratory/sandigLabResIn.php"> 
<input type="hidden" name="regno" value="<?php echo $registrationNo; ?>">
<input type="hidden" name="reqdate" value="<?php echo ''; ?>">
<input type="hidden" name="itemNo" value="<?php echo $itemNo; ?>">
<input type="hidden" name="procMonth" value="<?php echo date('M'); ?>">
<input type="hidden" name="procDay" value="<?php echo date('d'); ?>">
<input type="hidden" name="procYear" value="<?php echo date('Y'); ?>">
<input type="hidden" name="testdate">
<input type="hidden" name="reqphy">
<input type="hidden" name="patho">
<input type="hidden" name="lab13">
<input type="hidden" name="gender">
<input type="hidden" name="gender1">
<input type="hidden" name="patname">
 <input type="hidden" name="resultType" value="urinalysis" 

<body text="#000000" alink="#666600"><BODY OnLoad="placeFocus()">

<span class="style34">Urinalysis</span>
<table width="461" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#EAEAEA">
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td class="style17">LAB NO. </td>
      <td><strong><font color="#000000">
        <input name="labno" type="text" class="style7" value='' " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" >
      </font></strong></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td class="style17">Urinalysis No. </td>
      <td><strong><font color="#000000">
        <input name="testno" type="text" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
     <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td class="style17">Enter Date </td>
      <td><strong><font color="#000000">
        <input name="dateresult" type="text" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td width="201" class="style17">PHYSICIAN</td>
      <td width="244"><strong><font color="#000000">
        <input name="physician" type="text" id="physician" value='$ap' "class="style7" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
  </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td class="style17">PATHOLOGIST</td>
      <td><select name="pathologist" class="style17" id="pathologist"  style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>NOEMIA D. BARTOLOME, M.D.,FPSP</option>
      </select></td>
  </tr>
   <td class="style18"><span class="style17">MEDICAL TECHNOLOGIST </span></td>
      <td><label>
      <select name="medtech" class="style7" id="physician" " style="background-color:#FFC4E1" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <option></option>
        <option>Grace T. larroza, R.M.T.</option>
        <option>Ginalyn L. Eslava, R.M.T.</option>
        <option>Helen Grace P. Umipig, M.T.</option>
        <option>Emjie P. Pantorilla, M.T.</option>
        <option>Janice S. Tutanes, M.T., RN</option>
        <option>Judith Anne A. Sandig , M.T.</option>
        <option>Rey D. Larroza, R.M.T.</option>

      </select>
      <input name="examrequested" type="hidden" value="Urinalysis">
      </label></td>
  </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td class="style18"><span class="style17">Specimen</span><span class="style24">&nbsp;&nbsp;&nbsp;</span></td>
      <td><strong>
        <input name="specimen" type="text" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </strong></td>
    </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td class="style32">Examination</td>
      <td><input name="examination" type="text" value="" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
  </tr>
</table>
  <br>
  <label></label>

  
  <table width="85%" border="1" cellpadding="0" cellspacing="0" bgcolor="#EAEAEA">
 <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td width="32%"><strong><font color="#000000"><u>Cast</u>&nbsp;</font></strong></td>
   <td width="20%">&nbsp;</td>
 </tr>
 <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td width="19%">&nbsp;</td>
      <td width="29%">&nbsp;</td>
      <td><strong><font color="#000000">&nbsp;Hyaline Cast </font></strong></td>
      <td><input name="lab2" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
 </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Color</font></strong></td>
      <td><input name="lab1" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fine 
        Granular</font></strong></td>
      <td><input name="lab3" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
   </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Character</font></strong></td>
      <td><strong><font color="#000000">
        <select name="lab4" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="clear">clear</option>
          <option value="Sl. cloudy">Sl. cloudy</option>
          <option value="cloudy">cloudy</option>
          <option value="turbid">turbid</option>
        </select>
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Coarse 
        Granular</font></strong></td>
      <td><input name="lab5" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
   </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Reaction(pH)</font></strong></td>
      <td><strong><font color="#000000">
        <select name="lab6" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="5.0">5.0</option>
          <option value="6.0">6.0</option>
          <option value="6.5">6.5</option>
           <option value="7.0">7.0</option>
          <option value="7.5">7.5</option>
          <option value="8.0">8.0</option>
        </select>
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>waxy cast </strong></td>
      <td><input name="lab7" type="text" class="style17" id="waxy" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="15"></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Specific Gravity</font></strong></td>
      <td><strong><font color="#000000">
        <select name="lab8" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="1.000">1.000</option>
          <option value="1.005">1.005</option>
          <option value="1.010">1.010</option>
          <option value="1.015">1.015</option>
          <option value="1.020">1.020</option>
          <option value="1.025">1.025</option>
          <option value="1.030">1.030</option>
        </select>
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>wbc cast </strong></td>
      <td><input name="lab9" type="text" class="style17" id="wbc" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="15"></td>
    </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Albumin</font></strong></td>
      <td><strong><font color="#000000">
        <input name="lab10" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>rbc cast </strong></td>
      <td><input name="lab11" type="text" class="style17" id="rbcc" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="15"></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Sugar</font></strong></td>
      <td><strong><font color="#000000">
        <input name="lab12" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
      <td><strong><font color="#000000"><u>Crystals</u></font></strong></td>
      <td>&nbsp;</td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Acetone</font></strong></td>
      <td><strong><font color="#000000">
        <input name="lab14" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uric Acid </font></strong></td>
      <td><select name="lab15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="few">few</option>
          <option value="+">+</option>
          <option value="++">++</option>
          <option value="+++">+++</option>
          <option value="++++">++++</option>
      </select></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong>Bile</strong></td>
      <td><strong><font color="#000000">
        <input name="lab16" type="text" class="style17" id="ketone" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="15">
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Calcium 
        Oxalate</font></strong></td>
      <td><select name="lab17" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="few">few</option>
           <option value="+">+</option>
          <option value="++">++</option>
          <option value="+++">+++</option>
          <option value="++++">++++</option>
      </select></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Bilirubin</font></strong></td>
      <td><strong><font color="#000000">
        <input name="lab18" type="text" class="style17" id="urobilinogen" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="15">
        <label></label>
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amorphous 
        Urates</font></strong></td>
      <td><select name="lab19" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="few">few</option>
            <option value="+">+</option>
          <option value="++">++</option>
          <option value="+++">+++</option>
          <option value="++++">++++</option>
      </select></td>
    </tr>
     
<TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Urobilinogen</font></strong></td>
      <td><strong><font color="#000000">
        <input name="lab20" type="text" class="style17" id="urobilinogen" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="15">
        <label></label>
      </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amorphous Phosphates 
       </font></strong></td>
      <td><select name="lab21" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="few">few</option>
            <option value="+">+</option>
          <option value="++">++</option>
          <option value="+++">+++</option>
          <option value="++++">++++</option>
      </select></td>
    </tr>

   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000"><u>Microscopic</u></font></strong></td>
      <td><strong><font color="#000000"> </font></strong></td>
      <td><strong><font color="#000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Triple 
        Phosphates</font></strong></td>
      <td><select name="lab22" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          <option value=""></option>
          <option value="few">few</option>
          <option value="+">+</option>
          <option value="++">++</option>
          <option value="+++">+++</option>
          <option value="++++">++++</option>
      </select></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong>wbc</strong></td>
      <td><input name="lab23" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong>rbc</strong></td>
      <td><input name="lab24" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Epithelial Cells</font></strong></td>
      <td><input name="lab25" type="text" size="15"class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
      <td><strong><font color="#000000">Bacteria</font></strong></td>
      <td><input name="lab26" type="text" size="15"class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
    <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td><strong><font color="#000000">Mucous Threads</font></strong></td>
      <td><input name="lab27" type="text" size="15"class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
      <td><strong><font color="#000000">Yeast Cells</font></strong></td>
      <td><input name="lab28" type="text" size="15" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></td>
    </tr>
</table>
  <table width="398" border="0" bgcolor="#EAEAEA">
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
     <td><strong>OTHERS:<br>
         <font color="#000000">
         <textarea name="lab29" cols="50" rows="8" class="style17" id="remarks" style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"></textarea>
      </font>
       <label><br>
       </label>
     </strong></td>
   </tr>
   <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td width="388"><font color="#000000"><strong>Patient</strong>&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="patient" type="text" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="$patient" size="50">
      <br>
    
    </tr>
  </table>

     <TR bgcolor="#EAEAEA" onMouseOver="this.bgColor='gold';" onMouseOut="this.bgColor='#FFFFFF';">
      <td width="388"><font color="#000000"><strong>Refno</strong>&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="refno" type="text" value = "$refno" class="style17" " style="background-color:#D7FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;"  size="10">
      <br>
      <span class="style20"> <br>
      <input name="Submit" type="submit" class="style17" " style="background-color:#D7FFFF" value="Submit">
      <label>
      <input name="Submit2" type="reset" class="style17" " style="background-color:#D7FFFF" value="Reset">
      </label>
      </span> </font></td>
    </tr>
  </table>


  <span class="style20"><strong><font color="#000000"></font></strong></span><span class="style18"><strong><font color="#000000"><br>
          </font></strong></span><span class="style20">
          </p>
          </span>
</body>

</html>
