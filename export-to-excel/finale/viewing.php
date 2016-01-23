<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("system");
	if(empty($_SESSION['LOGIN']))
	{
		header ("location:login.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<BODY BACKGROUND="Admin.jpg">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><a href="patients.php">Log out</a></p>
  <form name="f1" method="post">
  <table width="411" height="38" border="0">
    <tr>
      <td width="130" align="center">Enter Patient ID</td>
      <td width="148"><input type="text" name="myt1" id="textfield" /></td>
      <td width="117"><input type="submit" name="SEARCH" id="SEARCH" value="Search" /></td>
    </tr>
    
    <?php
		
		if(isset($_POST['SEARCH']))
		{
			
			print"<table width='380' border='0'>
					<tr>
					<td colspan='5'><hr></td>
					</tr>
					<tr>
					<td>Room Number</td>
					<td>Last Name</td>
					<td>Physician</td>
					<td>Diagnosis</td>
					</tr>
					
			
			";
			
				$A1=$_POST['myt1'];
				
				$find = mysql_query("SELECT * FROM pt_info where id='$A1'");
				$row = mysql_fetch_array($find);
				
					print "
					
					<tr>
					
					<td>" . $row['roomnum'] . "</td>
					<td>" . $row['lname'] . "</td>
					<td>" . $row['physician'] . "</td>
					<td>" . $row['diagnosis'] . "</td>
					
					</tr>
					
					
					</table>";
					
				
			
		}
		
		
	?>
    
  </table>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>