<?php
include("../../myDatabase.php");
$username = $_GET['username'];
$reportName = $_GET['reportName'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<form method=post action='admin_reportAllBranch.php'>";
echo "<br><br><center><font size=2></font><br><div style='border:1px solid #000000; width:500px; height:131px; border-color:black black black black;'>";
echo "<br><br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font>From Date:</font>&nbsp;</td>";
echo "<td>";
echo "<select name='month' class='comboBoxShort'>
<option value='01'>Jan</option>
<option value='02'>Feb</option>
<option value='03'>Mar</option>
<option value='04'>Apr</option>
<option value='05'>May</option>
<option value='06'>Jun</option>
<option value='07'>Jul</option>
<option value='08'>Aug</option>
<option value='09'>Sep</option>
<option value='10'>Oct</option>
<option value='11'>Nov</option>
<option value='12'>Dec</option>
</select>&nbsp;";
echo "<select class='comboBoxShort' name='day'>";
for($x=1;$x<32;$x++) {

if($x<10) {
echo "<option value='0$x'>0$x</option>"; 
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='year' class='shortField' value='".date("Y")."'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font>To Date:</font>&nbsp;</td>";
echo "<td>";
echo "<select name='month1' class='comboBoxShort'>
<option value='Jan'>Jan</option>
<option value='Feb'>Feb</option>
<option value='Mar'>Mar</option>
<option value='Apr'>Apr</option>
<option value='May'>May</option>
<option value='Jun'>Jun</option>
<option value='Jul'>Jul</option>
<option value='Aug'>Aug</option>
<option value='Sep'>Sep</option>
<option value='Oct'>Oct</option>
<option value='Nov'>Nov</option>
<option value='Dec'>Dec</option>
</select>&nbsp;";
echo "<select class='comboBoxShort' name='day1'>";
for($x=1;$x<32;$x++) {

if($x<10) {
echo "<option value='0$x'>0$x</option>"; 
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>";
echo "&nbsp;<input type=text name='year1' class='shortField' value='".date("Y")."'>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<input type=hidden name='module'value='$reportName'>";
echo "<br><input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";

echo "</form>";
?>
