<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];

$ro = new database1();

echo "<script type='text/javascript' src='/ckeditor/ckeditor.js'></script>";

$ro->coconutDesign();

$startDate = preg_split ("/\_/", $ro->selectNow("promisorryNote","startDate","registrationNo",$registrationNo)); 


$dueDate = preg_split ("/\_/", $ro->selectNow("promisorryNote","dueDate","registrationNo",$registrationNo)); 

$ro->coconutFormStart("post","editPromisorry1.php");
echo "<table border=0>";
echo "<tr>";
echo "<td>Date&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".$startDate[0]."'>".$startDate[0]."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutComboBoxStart_short("day");
echo "<option value='".$startDate[1]."'>".$startDate[1]."</option>";
for($x=1;$x<32;$x++) {
if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutTextBox_short("year",$startDate[2]);

echo "</td>";
echo "</tr>";




echo "<tr>";
echo "<td>Due Date&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("month_due");
echo "<option value='".$dueDate[0]."'>".$dueDate[0]."</option>";
echo "<option value='Jan'>Jan</option>";
echo "<option value='Feb'>Feb</option>";
echo "<option value='Mar'>Mar</option>";
echo "<option value='Apr'>Apr</option>";
echo "<option value='May'>May</option>";
echo "<option value='Jun'>Jun</option>";
echo "<option value='Jul'>Jul</option>";
echo "<option value='Aug'>Aug</option>";
echo "<option value='Sep'>Sep</option>";
echo "<option value='Oct'>Oct</option>";
echo "<option value='Nov'>Nov</option>";
echo "<option value='Dec'>Dec</option>";
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutComboBoxStart_short("day_due");
echo "<option value='".$dueDate[1]."'>".$dueDate[1]."</option>";
for($x=1;$x<32;$x++) {
if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutTextBox_short("year_due",$dueDate[2]);

echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Balance&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox_short("balance",$ro->selectNow("promisorryNote","amount","registrationNo",$registrationNo));
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
echo "<br>";

echo "<textarea id='promisorryNote' name='promisorryNote'>"; 
echo $ro->selectNow("promisorryNote","note","registrationNo",$registrationNo);
echo "</textarea>";

?>

<script type="text/javascript">
			
			CKEDITOR.replace( 'promisorryNote',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

</script>

<?php

echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();

?>

