<?php
include("DocxConversion.php");
include("../../../myDatabase.php");
$itemNo = $_GET['itemNo'];

$ro = new database();
$docObj = new DocxConversion($ro->selectNow("uploadedFiles","fileName","itemNo",$itemNo));
//$docObj = new DocxConversion("test.docx");
//$docObj = new DocxConversion("test.xlsx");
//$docObj = new DocxConversion("test.pptx");
echo "<br><center><img src='http://".$ro->getMyUrl()."/COCONUT/myImages/mendero.png' width='40%;' height='20%;'></center><br><br>";
echo "&nbsp;<b>".$ro->selectNow("patientCharges","description","itemNo",$itemNo)."</b><Br>";
echo "&nbsp;<b>".$ro->selectNow("uploadedFiles","dateUploaded","itemNo",$itemNo)."</b><Br><Br>";
echo $docText= $docObj->convertToText();

?>
