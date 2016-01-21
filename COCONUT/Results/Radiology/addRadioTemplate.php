<?php
include("../../../myDatabase1.php");
$username = $_GET['username'];

$ro = new database1();

$ro->coconutDesign();
?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<?php
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

$ro->coconutFormStart("get","addRadioTemplate1.php");
$ro->coconutHidden("username",$username);
echo "<br>";
echo "<table border='0'>";
echo "<tr>";
echo "<td>Title</td>";
echo "<td>";
$ro->coconutTextBox("title","");
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<Br>";


echo " <textarea name='template' class='txtArea'></textarea> ";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
?>

<script type="text/javascript">
			
			CKEDITOR.replace( 'template',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

			</script>

