<?php
include("../../myDatabase.php");
$taxNo = $_POST['taxNo'];
$username = $_POST['username'];
$monthType = $_POST['monthType'];
$status = $_POST['status'];
$amount = $_POST['amount'];
$exemption = $_POST['exemption'];
$statusBracket = $_POST['statusBracket'];

$ro = new database();

$ro->editNow("contribution_withholdingTax","taxNo",$taxNo,"monthType",$monthType);
$ro->editNow("contribution_withholdingTax","taxNo",$taxNo,"status",$status);
$ro->editNow("contribution_withholdingTax","taxNo",$taxNo,"amount",$amount);
$ro->editNow("contribution_withholdingTax","taxNo",$taxNo,"exemption",$exemption);
$ro->editNow("contribution_withholdingTax","taxNo",$taxNo,"statusBracket",$statusBracket);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/withholdingTaxTable.php?username=$username");

?>
