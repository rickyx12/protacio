<?php
include("../../myDatabase.php");
$noteMessage = $_GET['noteMessage'];
$registrationNo = $_GET['registrationNo'];
$noteNo = $_GET['noteNo'];
$noteType = $_GET['noteType'];
$noteBy = $_GET['noteBy'];

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
$ro->coconutFormStart("post","editNote1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
$ro->coconutHidden("noteNo",$noteNo);
$ro->coconutBoxStart("650","463");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>".$ro->coconutText("Note By")."</td>";
echo "<td>";
$ro->coconutTextBox("noteBy",$noteBy);
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
$noteMessage
</textarea>";
echo "<br><br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
