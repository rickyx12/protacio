<?php
include("../../myDatabase.php");
$noteType = $_GET['noteType'];
$userName = $_GET['username'];
$registrationNo = $_GET['registrationNo'];

echo "

<style type='text/css'>
.message {
	border: 1px solid #000;
	color: #000;
	height:329px;
	width: 570px;
	padding:4px 4px 4px 2px;
}

</style>

";

$ro = new database();
$ro->coconutDesign();
$ro->coconutFormStart("post","addNote1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutBoxStart("650","463");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Note By")."</td>";
echo "<td>";
$ro->coconutTextBox("noteBy",$userName);
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>".$ro->coconutText("Note Type")."</td>";
echo "<td>";
$ro->coconutTextBox_readonly("noteType",$noteType);
echo "</td>";
echo "</tr>";
echo "</table>";
echo $ro->coconutText("<font color=red>Message</font>");
echo "<Br>";
echo "
<textarea name='noteMessage' class='message'>

</textarea>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
