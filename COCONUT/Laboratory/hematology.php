<?php
include("../../myDatabase.php");
$reqdate=$_GET['reqdate'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$itemNo = $_GET['itemNo'];
$wr=new database();

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
	background-image: url();
	background-color: #FFFFFF;
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
.style55 {
	color: #000000;
	font-size: 24px;
	font-weight: bold;
}
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
action="http://<?php echo $wr->getMyUrl(); ?>/COCONUT/Laboratory/sandigLabResIn.php">
 <input type="hidden" name="regno" value="<?php echo $registrationNo; ?>">
   <input type="hidden" name="itemNo" value="<?php echo $itemNo ?>">
  <input type="hidden" name="lab19">
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
	  <input type="hidden" name="resultType" value="hematology"> 
<body text="#000000" alink="#666600"> <BODY OnLoad="placeFocus()">
<h3 align="left" class="style55"> HEMATOLOGY</h3>
<table width="600" border="0" cellpadding="0" cellspacing="0" bgcolor="">
    
    <tr>
      <td class="style17">Hema No. </td>
      <td><strong><font color="#000000">
        <input name="testno" type="text" id="testno"class="style7" " style="" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="30">
      </font></strong></td>
    </tr>
     <tr>
      <td class="style17">Requesition date </td>
      <td><strong><font color="#000000">
        <input name="reqdate" type="text" class="style7" id="reqdate" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="<?php echo $reqdate ?>">
      </font></strong></td>
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
      <td width="201" class="style17">Requesting PHYSICIAN</td>
      <td width="244"><strong><font color="#000000">
        <input name="reqphy" type="text" id="reqphy" value='' "class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="30">
      </font></strong></td>
    </tr>
    <tr>
      <td class="style18"><span class="style17">PATHOLOGIST</span></td>
  <td><strong><font color="#000000">
      <select name="patho"  class="style7" " style="background-color:#CCE6E6" onkeydown="if(event.keyCode==13) event.keyCode=9;">
          
          <option>NOEMIA D. BARTOLOME, M.D.,FPSP</option>
  </select>    </tr>
    <tr>
      <td class="style18"><span class="style52">MEDICAL TECHNOLOGIST </span></td>
       <td><strong><font color="#000000">
        <select name="medtech"  class="style7" " style="background-color:#CCE6E6" onkeydown="if(event.keyCode==13) event.keyCode=9;">
          <option></option>
          <option value="Grace T. larroza, R.M.T.">Grace T. larroza, R.M.T.</option>
          <option value="Ginalyn L. Eslava, R.M.T.">Ginalyn L. Eslava, R.M.T.</option>
        <option value="Helen Grace P. Umipig, M.T.">Helen Grace P. Umipig, M.T.</option>
        <option value= "Emjie P. Pantorilla, M.T.">Emjie P. Pantorilla, M.T.</option>
        <option value="Janice S. Tutanes, M.T., RN">Janice S. Tutanes, M.T., RN</option>
        <option value="Janice S. Tutanes, M.T., RN">Judith Anne A. Sandig , M.T.</option>
        <option value="Rey D. Larroza, R.M.T.">Rey D. Larroza, R.M.T.</option>
        </select>
      </font></strong></td>
      <input name="medtech" type="hidden" id="medtech" value="medtech" class="style7" " style="background-color:#CCE6E6" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </label></td>
    </tr>
    <tr>
      <td class="style18"><strong><font color="#000000">Specimen&nbsp;</font></strong></td>
      <td><strong><font color="#000000"><strong><font color="#000000">
        <input name="specimen" type="text" value='Blood' "class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" size="30">
      </font></strong></font></strong></td>
    </tr>
    <tr>
      <td class="style18"><strong>Examination</strong></td>
      <td><input name="examination" type="text"class="style7" id="examination" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="hematology" size="30"></td>
    </tr>
</table>
  <label></label>
 
  <font size="2">
  <table width="600" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="">
    <tr>
      <td width="213">&nbsp;</td>
      <td width="386"><strong><font color="#000000" size="3">&nbsp;</font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab1" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Hemoglobin Mass</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab1" autocomplete="off" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" >
        <label>
        <input name="gender" type="radio" class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="140-170 g/L" checked>
        </label>
      male
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="gender" type="radio" value="120-140 g/L" class="style7" " check style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      female</font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab2"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Erythrocyte Count</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab2" autocomplete="off" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab3"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Hematocrit</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab3" autocomplete="off" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        <input name="gender1" type="radio" class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;" value="0.37-0.60" checked>
        male      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="gender1" type="radio" value="0.37-0.40" class="style7" " check style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
        female
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab3"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Leucocyte Count</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab4" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><div align="left"><strong><font color="#000000" size="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Differential 
      Count</u></font></strong></div></td>
      <td><strong><font color="#000000" size="2">&nbsp; </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2"><input type="checkbox" name="testlist" value="lab4"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          &nbsp;Myelocyte</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab5" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab5"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          &nbsp;&nbsp;Juveniles</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab6" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab6"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          &nbsp;Stabs</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab7" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab7"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          Segmenters</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab8" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab8"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          &nbsp;Lymphocytes</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab9" type="text"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab9"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          &nbsp;Monocytes</font></strong></li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab10" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab10"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          Eosinophils</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab11" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><ul>
        <li><strong><font color="#000000" size="2">
          <input type="checkbox" name="testlist" value="lab11"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
          &nbsp;Basoniphils</font></strong>
        </li>
      </ul></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab12" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab12"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Platelet Count</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab13" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab13"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      ESR</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab14" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab14"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Bleeding Time</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab15" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab15"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Clotting Time</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab16" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab16"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Blood Group</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab17" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab17"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      RH Type</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab18" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
      <td><strong><font color="#000000" size="2">
        <input type="checkbox" name="testlist" value="lab18"size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      Smear for Malaria Parasite</font></strong></td>
      <td><strong><font color="#000000" size="2">
        <input name="lab19" type="text" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>
    <tr>
       <td><strong><font color="#000000" size="2">
        <input name="refno" type="hidden" value = "" size="10"class="style7" " style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      </font></strong></td>
    </tr>


  </table>
</font>
  <table width="600" border="0" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" bgcolor="" class="style7">
    <tr>
      <td width="598" height="30" class="style18"><font color="#000000"> </font>
      <input name="patname" type="hidden" value="" size="30"class="style7" style="background-color:#C4FFFF" onKeyDown="if(event.keyCode==13) event.keyCode=9;">
      
      <span class="style20">
      </p>
      
      </span><span class="style20"> 
     

      <br>
      <br>
      <input name="Submit" type="submit" class="style17" style="background-color:#C4FFFF" value="Submit" >
      <label></label>
      </span> </td></tr>
</table>  
  <span class="style20"><strong><font color="#000000"></font></strong></span><span class="style18"><strong><font color="#000000"><br>
          </font></strong></span>
</body>

</html>

