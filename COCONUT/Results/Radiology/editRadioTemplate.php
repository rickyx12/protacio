<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];
$title = $_GET['title'];
$report = $_GET['report'];
$reportNo = $_GET['reportNo'];


$ro = new database1();

$ro->coconutDesign();

echo "
<style type='text/css'>

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 700px;
	width: 570px;
	padding:4px 4px 4px 5px;
	font-size:16px;
}

</style>


";

?>

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<?php


$ro->coconutFormStart("get","editRadioTemplate1.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("reportNo",$reportNo);
echo "<br>";
echo "<table border='0'>";
echo "<tr>";
echo "<td>Title</td>";
echo "<td>";
$ro->coconutTextBox("title",$title);
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";

//$text = $report;
//$breaks = array("<br />","<br>","<br/>","<b>","</b>");  
//$text1 = str_ireplace($breaks, "\r\n", $text);  
echo " <textarea id='reportx' name='report' >".$report."</textarea> ";



//echo "<div id='editable' contenteditable='true' style='border:1px solid #000;' >$report</div>";

echo "<Br><br>";

//echo "<a id='save_editable'>Save</a>";


$ro->coconutButton("edit");
$ro->coconutFormStop();
?>

<script type="text/javascript">
			
			CKEDITOR.replace( 'reportx',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

</script>
