<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("system");
	
	if(empty($_SESSION['LOGIN']))
	{
		header ("location:patients.php");
	}
	
	if (isset($_GET['SUB']))
	{
		$id = $_GET['T1'];
		$roomnum = $_GET['T2'];
		$physician = $_GET['T3'];
		$lname = $_GET['T4'];
		$fname = $_GET['T5'];
		$m_initial = $_GET['T6'];
		$diagnosis = $_GET['T7'];
		$permadd = $_GET['T8'];
		$dob = $_GET['T9'];
		$gender = $_GET['T10'];
		$civilstat = $_GET['T11'];
		$occup = $_GET['T12'];
		$religion = $_GET['T13'];
		$fathersname = $_GET['T14'];
		$mothersname = $_GET['T15'];
		$date_ad = $_GET['T16'];
		$time_ad = $_GET['T17'];
		$date_dis = $_GET['T18'];
		$time_dis = $_GET['T19'];
		
		if(empty($id))
		{
			print"<script>alert('Please Dont Leave The ID Field Empty!!')</script>";
		}
		elseif (empty($roomnum))
		{
			 	print"<script>alert('Please Dont Leave The Room number Field Empty!!')</script>";
		}
		elseif (empty($physician))
		{
			 	print"<script>alert('Please Dont Leave The Physician Field Empty!!')</script>";
		}
		elseif (empty($lname))
		{
			 	print"<script>alert('Please Dont Leave The Last Name Field Empty!!')</script>";
		}
		elseif (empty($fname))
		{
			 	print"<script>alert('Please Dont Leave The First Name Field Empty!!')</script>";
		}
		elseif (empty($m_initial))
		{
			 	print"<script>alert('Please Dont Leave The Middle Initial Field Empty!!')</script>";
		}
		elseif (empty($diagnosis))
		{
			 	print"<script>alert('Please Dont Leave The Diagnosis Field Empty!!')</script>";
		}
		elseif (empty($permadd))
		{
			 	print"<script>alert('Please Dont Leave The Permanent Field Empty!!')</script>";
		}
		elseif (empty($dob))
		{
			 	print"<script>alert('Please Dont Leave The Date of Birth Field Empty!!')</script>";
		}
		elseif (empty($gender))
		{
			 	print"<script>alert('Please Dont Leave The Gender Field Empty!!')</script>";
		}
		elseif (empty($civilstat))
		{
			 	print"<script>alert('Please Dont Leave The Civil Status Field Empty!!')</script>";
		}
		elseif (empty($occup))
		{
			 	print"<script>alert('Please Dont Leave The Occupation Field Empty!!')</script>";
		}
		elseif (empty($religion))
		{
			 	print"<script>alert('Please Dont Leave The Religion Field Empty!!')</script>";
		}
		elseif (empty($fathersname))
		{
			 	print"<script>alert('Please Dont Leave The Father's Field Empty!!')</script>";
		}
		elseif (empty($mothersname))
		{
			 	print"<script>alert('Please Dont Leave The Mother's Name Field Empty!!')</script>";
		}
		elseif (empty($date_ad))
		{
			 	print"<script>alert('Please Dont Leave The Date of Admission Field Empty!!')</script>";
		}
		elseif (empty($time_ad))
		{
			 	print"<script>alert('Please Dont Leave The Time Of Admisiion Field Empty!!')</script>";
		}
		
		else
		{
			mysql_query("INSERT INTO pt_info VALUES ('$id','$roomnum','$physician','$lname','$fname','$m_initial','$diagnosis','$permadd','$dob','$gender','$civilstat','$occup','$religion','$fathersname','$mothersname','$date_ad','$time_ad','$date_dis','time_dis')");
			print"<script>alert('Record Registered!')</script>";
			$id ="";
			$roomnum ="";
			$physician ="";
			$lname ="";
			$fname ="";
			$m_initial ="";
			$diagnosis ="";
			$permadd ="";
			$dob ="";
			$gender ="";
			$civilstat ="";
			$occup ="";
			$religion ="";
			$fathersname ="";
			$mothersname ="";
			$date_ad ="";
			$time_ad  ="";
			$date_dis ="";
			$time_dis ="";
		}
	}	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Patient Registry System</title>
<meta name="description" content="Medical website">
<meta name="keywords" content="jewelry, watches">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="1" background="images/bg_1.jpg"><table width="100%" height="122"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="254"><table width="122%" height="122"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="23" colspan="4"><img src="images/spacer.gif" width="1" height="23"></td>

</tr>
<tr>
<td width="21" background="images/bg_2.jpg"><img src="images/spacer.gif" width="21" height="1"></td>
<td width="71" background="images/bg_2.jpg"><img src="images/logo.jpg" width="71" height="67"></td>
                <td width="67" background="images/bg_2.jpg" class="logo">PCMC 
                  System </td>
<td width="81" background="images/bg_2.jpg"><img src="images/el_1.jpg" width="28" height="67"></td>
</tr>
<tr>
<td height="31" colspan="4"><img src="images/spacer.gif" width="1" height="31"></td>
</tr>
<tr bgcolor="#FFFFFF">
<td height="1" colspan="4"><img src="images/spacer.gif" width="1" height="1"></td>
</tr>
</table></td>
<td><table width="100%" height="122"  border="0" cellpadding="0" cellspacing="0">
<tr>

<td background="images/bg_3.jpg" colspan="2"><table width="537"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="26" height="38" rowspan="3"><img src="images/el_4.jpg" width="26" height="38"></td>
<td height="4" colspan="20"><img src="images/spacer.gif" width="1" height="4"></td>
</tr>
<tr>
<td width="14" height="26"><img src="images/bull.jpg" width="14" height="26"></td>
<td width="2"> <td><a href="index.php" class="menu_bottom">Home</a></td>
<td width="24"><img src="images/spacer.gif" width="24" height="1"></td>
<td width="14"><img src="images/bull.jpg" width="14" height="26"></td>
<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                     <td><a href="services.php" class="menu_bottom">Services</a></td>
                      <td width="24">&nbsp;</td>
<td><img src="images/bull.jpg" width="14" height="26"></td>

<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                      <td>About&nbsp;Hospital</td>
<td width="2"><img src="images/spacer.gif" width="24" height="1"></td>
<td width="14"><img src="images/bull.jpg" width="14" height="26"></td>
<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                      <td><a href="login.php" class="menu_bottom">Patients</a></td>
<td width="24"><img src="images/spacer.gif" width="24" height="1"></td>
<td width="14"><img src="images/bull.jpg" width="14" height="26"></td>
<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                      <td><a href="contact.php" class="menu_bottom">Contact&nbsp;Us</a></td>
<td width="24"><img src="images/spacer.gif" width="24" height="8"></td>
</tr>

<tr>
<td height="8" colspan="20"><img src="images/el_5.jpg" width="78" height="8"></td>
</tr>
</table>
                  <img src="images/spacer.gif" width="24" height="1"></td>
</tr>
<tr>
<td width="100%" height="83" align="right"><img src="images/el_2.jpg" width="330" height="83"></td>
                <td width="166" height="84" rowspan="2">&nbsp;</td>
</tr>
<tr>
<td height="1" bgcolor="#FFFFFF"></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>

<td height="100%" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="1447" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#D9D9D9">
<td height="40" colspan="3"><table width="100%" height="40"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="41"><img src="images/spacer.gif" width="41" height="1"></td>
<td><h1>Welcome to Pagadian City Medical Center Patient Registry System!!</h1>
      <p><a href="http://www.jdoqocy.com/14100zw41w3JNNPMKTLJLKOORKQM" target="_blank" onMouseOver="window.status='http://www.dreamtemplate.com';return true;" onMouseOut="window.status=' ';return true;">

<td width="1" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="1" height="1"></td>
</tr>
</table></td>
</tr>
<tr>

<td height="12" colspan="3"><img src="images/spacer.gif" width="1" height="12"></td>
</tr>
<tr>
<td width="39"><img src="images/spacer.gif" width="39" height="1"></td>
<td width="474" valign="top">
<p>&nbsp;</p>
                  <table width="542" height="34" border="0" align="center">
                    <tr> 
                      <td width="249" align="center"><a href="viewsdeletes.php"> 
                        <font size="3">View / Delete Patient Records</font></a></td>
                      <td align="center"><a href="patients.php"><font size="3">Log 
                        out</font></a> </tr>
                  </table>
                  <p>&nbsp;</p>
                  <div style="border:#305F8C solid 1px;padding:4px 6px 2px 6px">
<form action="" method="get" name="F1" id="F1">
                      <table width="98%" border="1">
                        <tr> 
                          <td><div align="center"> 
                              <p>&nbsp;</p>
                              <p><strong><font size="6">Patient's Data Sheet</font></strong></p>
                            </div></td>
                        </tr>
                      </table>
                      <table width="100%" border="0">
                        <tr> 
                          <td width="21%"><div align="center">Patient's ID</div></td>
                          <td width="79%"><input name="T1" value="<?php print $id;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Room Number</div></td>
                          <td><input name="T2" value="<?php print $roomnum;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Physician</div></td>
                          <td><input name="T3" value="<?php print $physician;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Last Name</div></td>
                          <td><input name="T4" value="<?php print $lname;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">First Name</div></td>
                          <td><input name="T5" value="<?php print $fname;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Middle Name</div></td>
                          <td><input name="T6" value="<?php print $m_initial;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Diagnosis</div></td>
                          <td><input name="T7" value="<?php print $diagnosis;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Permanent Address</div></td>
                          <td><input name="T8" value="<?php print $permadd;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Date of Birth</div></td>
                          <td><input name="T9" value="<?php print $dob;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Gender</div></td>
                          <td>
						  <select name="T10">
                          <?php
						  if ($gender=='Male')
                              print "<option></option>
                              <option selected>Male</option>
							  <option>Female</option>";
						  else if ($gender=='Female')
						  	  print "<option></option>
							  <option>Male</option>
							  <option selected>Female</option>";
						  else
						  	  print "<option></option>
							  <option>Male</option>
							  <option>Female</option>";
						   ?>
                            </select></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Civil Status</div></td>
                          <td><select name="T11" id="T11">
                              <?php
						  if ($civilstat=='Single')
                              print "<option></option>
                              <option selected>Single</option>
							  <option>Married</option>
							  <option>Widdow</option>";
						  else if ($civilstat=='Married')
						  	  print "<option></option>
                              <option>Single</option>
							  <option selected>Married</option>
							  <option>Widdow</option>";
						  else if ($civilstat=='Widdow')
						  	  print "<option></option>
                              <option>Single</option>
							  <option>Married</option>
							  <option selected>Widdow</option>";
						  else
						  	  print "<option></option>
							  <option>Single</option>
							  <option>Married</option>
							  <option>Widdow</option>";
						   ?>
                            </select></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Occupation</div></td>
                          <td><input name="T12" value="<?php print $occup;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Religion</div></td>
                          <td><input name="T13" value="<?php print $religion;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Father's Name</div></td>
                          <td><input name="T14" value="<?php print $fathersname;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Mother's Name</div></td>
                          <td><input name="T15" value="<?php print $mothersname;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Date of Admission</div></td>
                          <td><input name="T16" value="<?php print $date_ad;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Time of Admission</div></td>
                          <td><input name="T17" value="<?php print $time_ad;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Date of Discharged</div></td>
                          <td><input name="T18" value="<?php print $date_dis;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Time of Discharged</div></td>
                          <td><input name="T19" value="<?php print $time_dis;?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center"></div></td>
                          <td><input name="SUB" type="submit" id="SUB" value="Update"></td>
                        </tr>
                      </table>
                      <p>&nbsp;</p>
                    </form>
                  </div></td>
<td width="107"><img src="images/spacer.gif" width="78" height="8"></td>
</tr>
<tr>
<td height="5" colspan="3"><img src="images/spacer.gif" width="1" height="5"></td>
</tr>
</table></td>
<td width="166" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
                <td height="125">&nbsp;</td>
</tr>
<tr>
<td height="22"><img src="images/spacer.gif" width="1" height="22"></td>
</tr>
<tr>
                <td valign="top">&nbsp; </td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td height="1"><table width="100%" height="80"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="12" bgcolor="#305F8C"><img src="images/spacer.gif" width="1" height="12"></td>
</tr>
<tr>
          <td align="center" valign="middle" bgcolor="#D4C58F"><font color="#000000"><br>
            </font></td>

</tr>
</table></td>

</tr>
</table>

</body>
</html>
