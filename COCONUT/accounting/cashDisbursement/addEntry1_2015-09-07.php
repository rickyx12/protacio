<?php
include("../../../myDatabase2.php");
$transactionNo = $_POST['transactionNo'];
$accountHeads = $_POST['accountHeads'];
$paidTo = $_POST['paidTo'];
$narration = $_POST['narration'];
$invoiceNo = $_POST['invoiceNo'];
$datedMonth = $_POST['datedMonth'];
$datedDay = $_POST['datedDay'];
$datedYear = $_POST['datedYear'];
$debit = $_POST['debit'];
$credit = $_POST['credit'];
$username = $_POST['username'];
$dateEncoded = $_POST['dateEncoded'];
$type = $_POST['type'];

$ro = new database2();
$acctHeads = preg_split ("/\_/", $accountHeads); 
$accountNo  = $acctHeads[0];
$accountTitle = $acctHeads[1];
$dated = $datedYear."-".$datedMonth."-".$datedDay;


$ro->addDisbursement($transactionNo,$accountNo,$accountTitle,$paidTo,$narration,$invoiceNo,$dated,$debit,$credit,$username,$dateEncoded,$type);


$ro->coconutFormStart("GET","addEntry.php");
$ro->coconutHidden("username",$username);
$ro->coconutHidden("transactionNo",$transactionNo);
$ro->coconutHidden("type",$type);
$ro->coconutButton("<< Back");
$ro->coconutFormStop();


?>
