<?php
include("../../../myDatabase1.php");

$ro = new database1();

$ro->coconutDesign();
echo "<br>";
echo "<font size=4>TITLE:&nbsp;</font>";
$ro->coconutFormStart("post","addResultForm1.php");
$ro->coconutTextBox("title","");

?>

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<?php

echo "<textarea id='formTemplate' name='formTemplate'></textarea>";
$ro->coconutFormStop();
?>

<script type="text/javascript">
			
			CKEDITOR.replace( 'formTemplate',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003',
		extraPlugins:'autogrow'
	});
		

</script>


