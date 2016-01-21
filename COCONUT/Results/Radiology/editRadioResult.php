<?php
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$description = $_GET['description'];
$username = $_GET['username'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

$ro->getRadioResult($itemNo,$registrationNo);

$dateReceived = preg_split ("/\_/",$ro->radResult_dateReceived); 
$dateReleased = preg_split ("/\_/", $ro->radResult_dateReleased); 

echo "<form method='get' action='editImpression.php'>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='branch' value='".$ro->radResult_branch()."'>";
echo "<input type=hidden name='radioNo' value='".$ro->radResult_radioNo()."'>";
echo "<br><center><font size=2>Examination Result Entry</font><center><div style='border:1px solid #000000; width:600px; height:240px; border-color:black black black black;'>";
echo "<center><br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Description</font></td>";
echo "<td><input type=text name='description' value='".$description."' class='txtBox' ></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Radiologist</font></td>";
echo "<td><select name='radiologist' class='comboBox'>"; 
echo "<option value='".$ro->radResult_radiologist()."'>".$ro->radResult_radiologist()."</option>";
$ro->showOption("Doctors","Name");
echo "</select></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Med Tech</font></td>";
echo "<td><select name='medTech' class='comboBox'>"; 
echo "<option value='".$ro->radResult_radiologist()."'>".$ro->radResult_radiologist()."</option>";
$ro->showOption_where("registeredUser","username","module","RADIOLOGY");
echo "</select></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Date Received</font></td>";
echo "<td>";
echo "<select name='receivedMonth' class='comboBoxShort'>
<option value='".$dateReceived[0]."'>".$dateReceived[0]."</option>
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
</select>&nbsp";
echo "<select name='receivedDay' class='comboBoxShort'>";
echo "<option value='".$dateReceived[1]."'>".$dateReceived[1]."</option>";
for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>&nbsp;";
echo "<input type=text name='receivedYear' class='shortField' value='".$dateReceived[2]."'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Date Released</font></td>";
echo "<td>";
echo "<select name='releasedMonth' class='comboBoxShort'>
<option value='".$dateReleased[0]."'>".$dateReleased[0]."</option>
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
</select>&nbsp";
echo "<select name='releasedDay' class='comboBoxShort'>";
echo "<option value='".$dateReleased[1]."'>".$dateReleased[1]."</option>";
for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>&nbsp;";
echo "<input type=text name='releasedYear' class='shortField' value='".$dateReleased[2]."'>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Branch</font></td>";
echo "<td><select name='branch' class='comboBox'>"; 
echo "<option value='".$ro->radResult_branch()."'>".$ro->radResult_branch()."</option>";
$ro->showOption("branch","branch");
echo "</select></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<input type=submit value='Proceed'>";
echo "</div>";
echo "</form>";

?>
