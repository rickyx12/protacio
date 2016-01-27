<?php
include("../../myDatabase.php");
$sssID = $_POST['sssID'];
$range1 = $_POST['range1'];
$range2 = $_POST['range2'];
$monthlySalaryCredit = $_POST['monthlySalaryCredit'];
$ER = $_POST['ER'];
$EE = $_POST['EE'];
$total = $_POST['total'];
$EC_ER = $_POST['EC_ER'];
$username = $_POST['username'];


$ro = new database();

$ro->editNow("contribution_sss","sssID",$sssID,"range1",$range1);
$ro->editNow("contribution_sss","sssID",$sssID,"range2",$range2);
$ro->editNow("contribution_sss","sssID",$sssID,"monthlySalaryCredit",$monthlySalaryCredit);
$ro->editNow("contribution_sss","sssID",$sssID,"ER",$ER);
$ro->editNow("contribution_sss","sssID",$sssID,"EE",$EE);
$ro->editNow("contribution_sss","sssID",$sssID,"total",$total);
$ro->editNow("contribution_sss","sssID",$sssID,"EC_ER",$EC_ER);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/sssTable.php?username=$username");

?>
