<?php
include("../../../myDatabase1.php");
$title = $_GET['title'];
$templateNo = $_GET['templateNo'];


$ro = new database1();

$ro->coconutDesign();
echo "<br>";
echo "<font size=4>TITLE:&nbsp;</font>";
$ro->coconutFormStart("post","editResultForm1.php");
$ro->coconutTextBox("title",$title);
$ro->coconutHidden("templateNo",$templateNo);
?>

<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<?php

echo "<textarea id='formTemplate' name='formTemplate'>".$ro->selectNow("labResultList","template","templateNo",$templateNo)."</textarea>";
$ro->coconutFormStop();
?>

<script type="text/javascript">
			
			CKEDITOR.replace( 'formTemplate',
	{
		enterMode : CKEDITOR.ENTER_BR,
		skin : 'office2003'
	});
		

</script>


