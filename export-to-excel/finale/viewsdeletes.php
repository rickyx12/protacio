<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("system");
	
	if(empty($_SESSION['LOGIN']))
	{
		header ("location:patients.php");
	}
	
	if(isset($_POST['del']))
	{
		if(empty($_POST['checkbox']))
		{
			print "<script language='javascript'>alert('Please check a box');</script>";
		}
		else
		{
			foreach($_POST['checkbox'] as $id)
			{
				mysql_query("DELETE FROM pt_info WHERE id='$id'");
			}
		}
	}
	
	elseif(isset($_POST['SUB']))
	{
		$a1 = $_POST['T1'];
		$a2 = $_POST['T2'];
		$a3 = $_POST['T3'];
		$a4 = $_POST['T4'];
		$a5 = $_POST['T5'];
		$a6 = $_POST['T6'];
		$a7 = $_POST['T7'];
		$a8 = $_POST['T8'];
		$a9 = $_POST['T9'];
		$a10 = $_POST['T10'];
		$a11 = $_POST['T11'];
		$a12 = $_POST['T12'];
		$a13 = $_POST['T13'];
		$a14 = $_POST['T14'];
		$a15 = $_POST['T15'];
		$a16 = $_POST['T16'];
		$a17 = $_POST['T17'];
		$a18 = $_POST['T18'];
		$a19 = $_POST['T19'];
		
		if (empty($a2))
			print "<script language='javascript'>alert('Please do not leave Room Number field empty');</script>";
		elseif (empty($a3))
			print "<script language='javascript'>alert('Please do not leave Physician field empty');</script>";
		elseif (empty($a4))
			print "<script language='javascript'>alert('Please do not leave Last Name field empty');</script>";
		elseif (empty($a5))
			print "<script language='javascript'>alert('Please do not leave First Name field empty');</script>";
		elseif (empty($a6))
			print "<script language='javascript'>alert('Please do not leave Middle Initial field empty');</script>";
		elseif (empty($a7))
			print "<script language='javascript'>alert('Please do not leave Diagnosis field empty');</script>";
		elseif (empty($a8))
			print "<script language='javascript'>alert('Please do not leave Permanent Add field empty');</script>";
		elseif (empty($a9))
			print "<script language='javascript'>alert('Please do not leave Date of Birth field empty');</script>";
		elseif (empty($a10))
			print "<script language='javascript'>alert('Please do not leave Gender field empty');</script>";
		elseif (empty($a11))
			print "<script language='javascript'>alert('Please do not leave Civil Status field empty');</script>";
		elseif (empty($a12))
			print "<script language='javascript'>alert('Please do not leave Occupation field empty');</script>";
		elseif (empty($a13))
			print "<script language='javascript'>alert('Please do not leave Religion field empty');</script>";
		elseif (empty($a14))
			print "<script language='javascript'>alert('Please do not leave Father's name field empty');</script>";
		elseif (empty($a15))
			print "<script language='javascript'>alert('Please do not leave Mother's name field empty');</script>";
		elseif (empty($a16))
			print "<script language='javascript'>alert('Please do not leave Date of Admission field empty');</script>";
		elseif (empty($a17))
			print "<script language='javascript'>alert('Please do not leave Time of Admission field empty');</script>";
		elseif (empty($a18))
			print "<script language='javascript'>alert('Please do not leave Date of Discharge field empty');</script>";
		elseif (empty($a19))
			print "<script language='javascript'>alert('Please do not leave Time of Discharge field empty');</script>";
		else
			{
				mysql_query ("UPDATE pt_info SET roomnum='$a2', physician='$a3', lname='$a4', fname='$a5', m_initial='$a6', diagnosis='$a7', permadd='$a8', dob='$a9', gender='$a10', civilstat='$a11', occup='$a12', religion='$a13', fathersname='$a14', mothersname='$a15', date_ad='$a16', time_ad='$a17', date_dis='$a18', time_dis='$a19' WHERE id='$a1'");
				
				header ("location : viewsdeletes.php?ID=". $a1 ."");
				
				print "<script language='javascript'>alert('Update complete');</script>";
			}
	}
?>
<?php
	$param = $_GET['ID'];
	$find = mysql_query ("SELECT * FROM pt_info WHERE id='$param'");
	$search = @mysql_fetch_array ($find);
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
<td width="2"> <td><a href="home.php" class="menu_bottom">Home</a></td>
<td width="24"><img src="images/spacer.gif" width="24" height="1"></td>
<td width="14"><img src="images/bull.jpg" width="14" height="26"></td>
<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                     <td><a href="services.php" class="menu_bottom">Services</a></td>
                      <td width="24">&nbsp;</td>
<td><img src="images/bull.jpg" width="14" height="26"></td>

<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                      <td><a href="about.php" class="menu_bottom">About&nbsp;Hospital</a></td>
<td width="2"><img src="images/spacer.gif" width="24" height="1"></td>
<td width="14"><img src="images/bull.jpg" width="14" height="26"></td>
<td width="2"><img src="images/spacer.gif" width="2" height="1"></td>
                      <td><class="menu_bottom">Patients</td>
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
<td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
<td width="259" valign="top">
<p>&nbsp;</p>
                  <p>&nbsp;
                  <table width="25%" height="29" border="0" align="center">
                    <tr>
                      <td><div align="center"><a href="administrator.php"><font size="4">Back</font></a></div></td>
                      <td><div align="center"><a href="patients.php"><font size="4">Log 
                          out</font></a></div></td>
                    </tr>
                  </table>
                  <p>&nbsp;</p>
                  </p>
                  <div style="border:#305F8C solid 1px;padding:4px 6px 2px 6px">
<form action="" method="post" name="F1" id="F1">
                      <table width="740" height="46" border="1">
                        <tr> 
                          <td width="14" align="center">&nbsp;</td>
                          <td width="95" align="center">Patient ID</td>
                          <td width="76" align="center">Room Number</td>
                          <td width="158" align="center">Last Name</td>
                          <td width="159" align="center">First Name</td>
                          <td width="231" align="center">Physician</td>
                          <td width="231" align="center">Diagnosis</td>
                        </tr>
<?php

	$RES = mysql_query("SELECT * FROM pt_info");
	while ($ROW = mysql_fetch_array($RES))
	{
		print "	<tr>
				<td width='14'><input type='checkbox' name='checkbox[]' value='". $ROW['id'] ."'></td>						
				<td width='95' title='Edit Info'><center><font face='Tahoma' size='2'><b><a href='viewsdeletes.php?ID=". $ROW['id'] ."'>" . $ROW['id'] . "</a></center></b></font></td>
    			 <td width='76'><center>" . $ROW['roomnum'] . "</center></td>
    			<td width='158'><center>" .  $ROW['lname'] . "<center></td>
				<td width='159'><center>" .  $ROW['fname'] . "<center></td>
    			<td width='231'><center>" .  $ROW['physician'] . "<center></td>
				<td width='231'><center>" .  $ROW['diagnosis'] . "<center></td>
  				</tr>";
	}
?>
              <input type="submit" value="Delete" name="del">
              </table>
              </form>
              </div></td>
<td width="322">
<form method="post" name="f2">
<table width="100%" border="1" align="right">
						<tr> 
                          <td colspan="2"><div align="center">Edit Patient's Info</div></td>
                        </tr>
                        <tr> 
                          <td width="21%"><div align="center">Patient's ID</div></td>
                          <td width="79%"><input readonly name="T1" value="<?php print $search['id']; ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Room Number</div></td>
                          <td><input name="T2" value="<?php print $search['roomnum'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Physician</div></td>
                          <td><input name="T3" value="<?php print $search['physician'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Last Name</div></td>
                          <td><input name="T4" value="<?php print $search['lname'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">First Name</div></td>
                          <td><input name="T5" value="<?php print $search['fname'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Middle Name</div></td>
                          <td><input name="T6" value="<?php print $search['m_initial'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Diagnosis</div></td>
                          <td><input name="T7" value="<?php print $search['diagnosis'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Permanent Address</div></td>
                          <td><input name="T8" value="<?php print $search['permadd'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Date of Birth</div></td>
                          <td><input name="T9" value="<?php print $search['dob'] ?>">yyyy/mm/dd</td>
                        </tr>
                        <tr> 
                          <td><div align="center">Gender</div></td>
                          <td>
						  <select name="T10">
                          <option><?php print $search['gender'] ?></option>
                          <option></option>
                          <option>Male</option>
                          <option>Female</option>
                            </select></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Civil Status</div></td>
                          <td><select name="T11" id="T11">
                           <option><?php print $search['civilstat'] ?></option>
                           <option></option>
                           <option>Single</option>
                           <option>Married</option>
                           <option>Widdow</option>
                            </select></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Occupation</div></td>
                          <td><input name="T12" value="<?php print $search['occup'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Religion</div></td>
                          <td><input name="T13" value="<?php print $search['religion'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Father's Name</div></td>
                          <td><input name="T14" value="<?php print $search['fathersname'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Mother's Name</div></td>
                          <td><input name="T15" value="<?php print $search['mothersname'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Date of Admission</div></td>
                          <td><input name="T16" value="<?php print $search['date_ad'] ?>">yyyy/mm/dd</td>
                        </tr>
                        <tr> 
                          <td><div align="center">Time of Admission</div></td>
                          <td><input name="T17" value="<?php print $search['time_ad'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center">Date of Discharged</div></td>
                          <td><input name="T18" value="<?php print $search['date_dis'] ?>">yyyy/mm/dd</td>
                        </tr>
                        <tr> 
                          <td><div align="center">Time of Discharged</div></td>
                          <td><input name="T19" value="<?php print $search['time_dis'] ?>"></td>
                        </tr>
                        <tr> 
                          <td><div align="center"></div></td>
                          <td><input name="SUB" type="submit" id="SUB" value="Submit"></td>
                        </tr>
                      </table>
                      </form>
</td>
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
