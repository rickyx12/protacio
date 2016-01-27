<?php
include("sandigLabDatabase.php"); 
include("../../myDatabase.php");

$regno=$_GET['regno'];
$testno=$_GET['testno'];
$reqdate=$_GET['reqdate'];
$procMonth = $_GET['procMonth'];
$procDay = $_GET['procDay'];
$procYear = $_GET['procYear'];
$testdate = $procMonth."_".$procDay."_".$procYear;
$reqphy=$_GET['reqphy'];
$patho=$_GET['patho'];
$medtech=$_GET['medtech'];
$specimen=$_GET['specimen'];
$examination=$_GET['examination'];
$lab1=$_GET['lab1'];
$lab2=$_GET['lab2'];
$lab3=$_GET['lab3'];
$lab4=$_GET['lab4'];
$lab5=$_GET['lab5'];
$lab6=$_GET['lab6'];
$lab7=$_GET['lab7'];
$lab8=$_GET['lab8'];
$lab9=$_GET['lab9'];
$lab10=$_GET['lab10'];
$lab11=$_GET['lab11'];
$lab12=$_GET['lab12'];
$lab13=$_GET['lab13'];
$lab14=$_GET['lab14'];
$lab15=$_GET['lab15'];
$lab16=$_GET['lab16'];
$lab17=$_GET['lab17'];
$lab18=$_GET['lab18'];
$lab19=$_GET['lab19'];
$lab20=$_GET['lab20'];
$lab21=$_GET['lab21'];
$lab22=$_GET['lab22'];
$lab23=$_GET['lab23'];
$lab24=$_GET['lab24'];
$lab25=$_GET['lab25'];
$lab26=$_GET['lab26'];
$lab27=$_GET['lab27'];
$lab28=$_GET['lab28'];
$lab29=$_GET['lab29'];
$patname=$_GET['patname'];
$gender=$_GET['gender'];
$gender1=$_GET['gender1'];
$resultType=$_GET['resultType'];
$itemNo = $_GET['itemNo'];


$wr = new sandigLab();
$do= new database();
$wr->addHematology($regno,$testno,$reqdate,$testdate,$reqphy,$patho,$medtech,$specimen,$examination,$lab1,$lab2,$lab3,$lab4,$lab5,$lab6,$lab7,$lab8,$lab9,$lab10,$lab11,$lab12,$lab13,$lab14,$lab15,$lab16,$lab17,$lab18,$lab19,$lab20,$lab21,$lab22,$lab23,$lab24,$lab25,$lab26,$lab27,$lab28,$lab29,$patname,$gender,$gender1,$resultType,$itemNo);

if($resultType=="clinchem") {
$do->gotoPage("http://".$do->getMyUrl()."/COCONUT/Laboratory/newlabClinChemPrint.php?registrationNo=$regno&itemNo=$itemNo");
}else if ($resultType=="hematology") {
$do->gotoPage("http://".$do->getMyUrl()."/COCONUT/Laboratory/newlabhemaprint.php?registrationNo=$regno&itemNo=$itemNo");
} 
else if ($resultType=="urinalysis") {
$do->gotoPage("http://".$do->getMyUrl()."/COCONUT/Laboratory/newlaburineprint.php?registrationNo=$regno&itemNo=$itemNo");
}else if($resultType == "serology" ) {
$do->gotoPage("http://".$do->getMyUrl()."/COCONUT/Laboratory/serologyPrint.php?registrationNo=$regno&itemNo=$itemNo");
}else if($resultType == "fecalysis" ) {
$do->gotoPage("http://".$do->getMyUrl()."/COCONUT/Laboratory/fecalysisPrint.php?registrationNo=$regno&itemNo=$itemNo");
}

else {


}






?>
