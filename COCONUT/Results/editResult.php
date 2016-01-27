<?php
include("../../myDatabase.php");
$description = $_GET['description'];
$labNo = $_GET['labNo'];
$pathologist = $_GET['pathologist'];
$medTech = $_GET['medTech'];
$dateReceived = $_GET['dateReceived'];
$dateReleased = $_GET['dateReleased'];
$branch = $_GET['branch'];
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];


$ro = new database();

?>


<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

$dateReceivedz = preg_split ("/\_/",$dateReceived); 
$dateReleasedz = preg_split ("/\_/",$dateReleased); 

echo "<form method='get' action='editResultValue.php'>";
echo "<input type=hidden name='labNoz' value='$labNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";


echo "<br><center><font size=2>Examination Result Edit</font><center><div style='border:1px solid #000000; width:600px; height:280px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Description</font></td>";
echo "<td><input type=text class='txtBox' name='description' value='$description'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Pathologist</font></td>";
echo "<td><select name='pathologist' class='comboBox'>"; 
$ro->showOption("Doctors","Name");
echo "</select></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Med Tech</font></td>";
echo "<td><select name='medTech' class='comboBox'>"; 
$ro->showOption_where("registeredUser","username","module","LABORATORY");
echo "</select></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Date Received</font></td>";
echo "<td><select class='comboBoxShort' name='receivedMonth'>
<option value='$dateReceivedz[0]'>$dateReceivedz[0]</option>
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
</select>&nbsp;
<select class='comboBoxShort' name='receivedDay'>";
echo "<option value='$dateReceivedz[1]'>$dateReceivedz[1]</option>";
for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>
<input type=text name='receivedYear' class='shortField' value='".$dateReceivedz[2]."'></td>";
echo "</tr>";

echo "<tr>";
echo "<td><font class='labelz'>Date Released</font></td>";
echo "<td><select class='comboBoxShort' name='releasedMonth'>
<option value='$dateReleasedz[0]'>$dateReleasedz[0]</option>
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
</select>&nbsp;
<select class='comboBoxShort' name='releasedDay'>";
echo "<option value='$dateReleasedz[1]'>$dateReleasedz[1]</option>";
for($x=1;$x<32;$x++) {
if($x<10) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}
}
echo "</select>
<input type=text name='releasedYear' class='shortField' value='".$dateReleasedz[2]."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Branch</font></td>";
echo "<td><select name='branch' class='comboBox'>";
echo "<option value='$branch'>$branch</option>"; 
$ro->showOption("branch","branch");
echo "</select></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<input type=submit value='Edit Value'>";
echo "</div>";
echo "</form>";

?>
