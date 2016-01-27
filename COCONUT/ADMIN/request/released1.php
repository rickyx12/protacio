<?php
include("../../../myDatabase.php");
$payee = $_POST['payee'];
$amount = $_POST['amount'];
$username = $_POST['username'];
$requestNo = $_POST['requestNo'];
$date = $_POST['date'];
$ro = new database();
$ro->coconutDesign();
$ro->editNow("admin2request","requestNo",$requestNo,"releasedBy",$username);
$ro->editNow("admin2request","requestNo",$requestNo,"releaseTime",$ro->getSynapseTime());
$ro->editNow("admin2request","requestNo",$requestNo,"releaseDate",date("Y-m-d"));
$ro->editNow("admin2request","requestNo",$requestNo,"releaseTo",$payee);
$ro->editNow("admin2request","requestNo",$requestNo,"releasedAmount",$amount);

//$ro->gotoPage("http://".$ro->getMyUrl()."/COCONUT/ADMIN/request/viewApprovedRequest.php?date=$date&username=$username");

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";


echo "Request#:".$requestNo;
echo "<br>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Description</b>");
$ro->coconutTableData($ro->selectNow("admin2request","description","requestNo",$requestNo));

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>QTY</b>");
$ro->coconutTableData($ro->selectNow("admin2request","qty","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Price</b>");
$ro->coconutTableData($ro->selectNow("admin2request","price","requestNo",$requestNo));
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Total</b>");
$ro->coconutTableData($ro->selectNow("admin2request","total","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Request</b>");
$ro->coconutTableData($ro->selectNow("admin2request","time","requestNo",$requestNo)." @ ".$ro->selectNow("admin2request","date","requestNo",$requestNo));
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Request By</b>");
$ro->coconutTableData($ro->selectNow("admin2request","requestBy","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("");
$ro->coconutTableData("");
$ro->coconutTableRowStop();


$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Released</b>");
$ro->coconutTableData($ro->selectNow("admin2request","releaseTime","requestNo",$requestNo)." @ ".$ro->selectNow("admin2request","date","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Amount</b>");
$ro->coconutTableData($ro->selectNow("admin2request","releasedAmount","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>Released By</b>");
$ro->coconutTableData($ro->selectNow("admin2request","releasedBy","requestNo",$requestNo)." @ ".$ro->selectNow("admin2request","date","requestNo",$requestNo));
$ro->coconutTableRowStop();

$ro->coconutTableRowStop();
$ro->coconutTableStop();

?>
