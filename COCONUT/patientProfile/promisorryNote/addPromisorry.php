<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$registrationNo = $_GET['registrationNo'];

$ro = new database1();

echo "<script type='text/javascript' src='/ckeditor/ckeditor.js'></script>";

$ro->coconutDesign();


$ro->coconutFormStart("post","insertPromisorry.php");
echo "<table border=0>";
echo "<tr>";
echo "<td>Date&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("month");
echo "<option value='".date("M")."'>".date("M")."</option>";
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
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<32;$x++) {
if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutTextBox_short("year",date("Y"));

echo "</td>";
echo "</tr>";




echo "<tr>";
echo "<td>Due Date&nbsp;</tD>";
echo "<td>";
$ro->coconutComboBoxStart_short("month_due");
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
for($x=1;$x<32;$x++) {
if($x < 10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
$ro->coconutComboBoxStop();

echo "&nbsp;";

$ro->coconutTextBox_short("year_due",date("Y"));

echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Balance&nbsp;</td>";
echo "<td>";
$ro->coconutTextBox_short("balance","");
echo "</td>";
echo "</tr>";
echo "</table>";
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("username",$username);
echo "<br>";

echo "<textarea id='promisorryNote' name='promisorryNote'>"; 

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

