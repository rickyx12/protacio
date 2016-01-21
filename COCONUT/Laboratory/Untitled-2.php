<?php
include("sandigLabDatabase.php"); 

$regno=$_GET['regno'];
$testno=$_GET['testno'];
$reqdate=$_GET['reqdate'];
$regno=$_GET['regno'];
$$procdate=$_GET['$procdate'];
$reqphy=$_GET['reqphy'];
$patho=$_GET['patho'];
$medtech=$_GET['medtech'];
$regno=$_GET['regno'];
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
$patname=$_GET['patname'];
$sex1=$_GET['sex1'];
$labsex2=$_GET['sex2'];


$wr = new sandigLab();

$wr->addHematology($regno,$testno,$reqdate,$procdate,$reqphy,$patho,$specimen,$examination,$lab1,$lab2,$lab3,$lab4,$lab5,$lab6,$lab7,$lab8,$lab9,$lab10,$lab11,$lab12,$lab12,$lab13,$lab14,$lab15,$lab16,$lab17,$lab18,$patname,$sex1,$sex2)








?>