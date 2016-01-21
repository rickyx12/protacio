<?php
include("../../myDatabase.php");
$hdmfNo = $_POST['hdmfNo'];
$username = $_POST['username'];
$grossPayRange = $_POST['grossPayRange'];
$grossPayRange1 = $_POST['grossPayRange1'];
$employeeShare = $_POST['employeeShare'];
$employerShare = $_POST['employerShare'];

$ro = new database();

$ro->editNow("contribution_hdmf","hdmfNo",$hdmfNo,"grossPayRange",$grossPayRange);
$ro->editNow("contribution_hdmf","hdmfNo",$hdmfNo,"grossPayRange1",$grossPayRange1);
$ro->editNow("contribution_hdmf","hdmfNo",$hdmfNo,"employeeShare",$employeeShare);
$ro->editNow("contribution_hdmf","hdmfNo",$hdmfNo,"employerShare",$employerShare);

$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/payroll/pagibigTable.php?username=$username");


?>
