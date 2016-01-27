<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];

$ro = new database();

$ro->getPatientProfile($registrationNo);




echo "
<style type='text/css'>

.diagnosis {
	border: 1px solid #000;
	color: #000;
	height:80px;
	width: 100%;
	padding:4px 4px 4px 2px;
}

.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}

.shortField {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 120px;
	padding:4px 4px 4px 5px;
}
.labelz {
font-size:13px;
}

.comboBox {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 320px;
	padding:4px 4px 4px 5px;
}


.comboBoxShort {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 65px;
	padding:4px 4px 4px 5px;
}

</style>";

echo "<form method='get' action='editVitalSign1.php'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<center><br><div style='border:1px solid #000000; width:500px; height:180px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td>Height&nbsp;</td>";
echo "<td><input type=text name='height'class='txtBox' autocomplete='off' value='".$ro->getRegistrationDetails_height()."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Weight&nbsp;</td>";
echo "<td><input type=text name='weight'class='txtBox' autocomplete='off' value='".$ro->getRegistrationDetails_weight()."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Blood Pres.&nbsp;</td>";
echo "<td><input type=text name='bloodpressure' autocomplete='off' class='txtBox' value='".$ro->getRegistrationDetails_bloodPressure()."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Temperature&nbsp;</td>";
echo "<td><input type=text name='temperature' autocomplete='off' class='txtBox' value='".$ro->getRegistrationDetails_temperature()."'></td>";
echo "</tr>";

echo "<td>Pulse Rate&nbsp;</td>";
echo "<td><input type=text name='pulse' autocomplete='off' class='txtBox' value='".$ro->getRegistrationDetails_pulse()."'></td>";
echo "</tr>";

echo "<td></td>";
echo "<td><input type=hidden name='respiratory'class='txtBox' value='".$ro->getRegistrationDetails_respiratory()."'></td>";
echo "</tr>";

echo "</table>";
echo "<Br>";

echo "

<textarea class='diagnosis'
id='diagnosis'
name='diagnosis'
placeholder='Chief Complaint'
></textarea>;

";

echo "</textarea>";
echo "</div>";
echo "<Br><br><Br><br><Br>";
$ro->coconutButton("Proceed");
echo  "</form>";
?>
