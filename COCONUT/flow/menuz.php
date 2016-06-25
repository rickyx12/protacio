<?php
include("../../myDatabase.php");

if( isset($_GET['datez']) ) {
$datez = $_GET['datez'];
}else {
$datez = date("Y-m-d");
}

$ro = new database();
$ro->coconutDesign();
echo "<br>";
echo "<form method='get' action=".$_SERVER['PHP_SELF'].">";
$ro->coconutTextbox_short("datez",$datez);
echo "</form>";
echo "<br><bR>";

$curDate = preg_split ("/\-/", $datez); 

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/flow/opdTransaction.php' target='rightFrame'>";
$ro->coconutHidden("datez",$datez);
echo "<input type='submit' value='OPD Transaction' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/flow/floatingPx.php' target='rightFrame'>";
$ro->coconutHidden("datez",$datez);
echo "<input type='submit' value='Pending OPD Transaction' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/CollectionReport.php' target='rightFrame'>";
$ro->coconutHidden("fm",$curDate[1]);
$ro->coconutHidden("fd",$curDate[2]);
$ro->coconutHidden("fy",$curDate[0]);
$ro->coconutHidden("tm",$curDate[1]);
$ro->coconutHidden("td",$curDate[2]);
$ro->coconutHidden("ty",$curDate[0]);
$ro->coconutHidden("fth","00");
$ro->coconutHidden("ftm","00");
$ro->coconutHidden("fts","00");
$ro->coconutHidden("tth","24");
$ro->coconutHidden("ttm","59");
$ro->coconutHidden("tts","59");
$ro->coconutHidden("username","");
echo "<input type='submit' value='Collection Report' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Reports/Census/registrationCensus.php' target='rightFrame'>";
	$ro->coconutHidden("fromMonth",$curDate[1]);
	$ro->coconutHidden("fromDay",$curDate[2]);
	$ro->coconutHidden("fromYear",$curDate[0]);
	$ro->coconutHidden("toMonth",$curDate[1]);
	$ro->coconutHidden("toDay",$curDate[2]);
	$ro->coconutHidden("toYear",$curDate[0]);
	$ro->coconutHidden("type","IPD");
	$ro->coconutHidden("dept","");
	$ro->coconutHidden("username","");
	echo "<input type='submit' value='Admission' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Reports/paidIPD.php' target='rightFrame'>";
	$ro->coconutHidden("month",$curDate[1]);
	$ro->coconutHidden("day",$curDate[2]);
	$ro->coconutHidden("year",$curDate[0]);
	$ro->coconutHidden("month1",$curDate[1]);
	$ro->coconutHidden("day1",$curDate[2]);
	$ro->coconutHidden("year1",$curDate[0]);
	echo "<input type='submit' value='Discharged' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Cashier/expenses.php' target='rightFrame'>";
$ro->coconutHidden("month",$curDate[1]);
$ro->coconutHidden("day",$curDate[2]);
$ro->coconutHidden("year",$curDate[0]);
$ro->coconutHidden("month1",$curDate[1]);
$ro->coconutHidden("day1",$curDate[2]);
$ro->coconutHidden("year1",$curDate[0]);
echo "<input type='submit' value='Expenses' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Cashier/cashierReport/dailyCashiersReport_date.php' target='rightFrame'>";
echo "<input type='submit' value='Daily Cashier's Report' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Company/daily-hmo-control.php' target='rightFrame'>";
echo "<input type='submit' value='Daily H.M.O Report' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/flow/patientTransaction.php' target='rightFrame'>";
$ro->coconutHidden("date",$datez);
echo "<input type='submit' value='Daily Transaction' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/billing/transactionSummaryDate.php' target='rightFrame'>";
echo "<input type='submit' value='Transaction Summary' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/billing/selectShift_transactionSummary.php' target='rightFrame'>";
echo "<input type='submit' value='Transaction Summary2' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Doctor/doctorModule/doctorPF_shift.php' target='rightFrame'>";
	echo "<input type='submit' value='PF/Doctor' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
	$ro->coconutHidden("username","x");
	$ro->coconutHidden("module","shortcut");
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Company/selectCompany.php' target='rightFrame'>";
	echo "<input type='submit' value='Aging of Accounts' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/accounting/purchaseJournalDate.php' target='rightFrame'>";
echo "<input type='submit' value='Purchase Journal' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Reports/dermaPx_date.php' target='rightFrame'>";
echo "<input type='submit' value='Derma Patient' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/accounting/inventoryAdjustmentDate.php' target='rightFrame'>";
echo "<input type='submit' value='Inventory Adjustment' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/new_inventory_list.php' target='rightFrame'>";
echo "<input type='submit' value='Inventory List(New)' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/inventoryList1.php' target='_blank'>";
echo "<input type='submit' value='Inventory Sheet (Medicine)' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";


echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/inventoryList1_supplies.php' target='_blank'>";
echo "<input type='submit' value='Inventory Sheet (Supplies)' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/flow/chartList.php' target='rightFrame'>";
echo "<input type='submit' value='Chart' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/endingInventory.php' target='rightFrame'>";
echo "<input type='hidden' name='inventoryType' value='medicine'>";
echo "<input type='submit' value='Ending Inv (w/ invoice)' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/non-invoice.php' target='rightFrame'>";
echo "<input type='hidden' name='inventoryType' value='medicine'>";
echo "<input type='submit' value='Ending Inv (w/o invoice)' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/endingInventory_quarter.php' target='rightFrame'>";
echo "<input type='hidden' name='inventoryType' value='medicine'>";
echo "<input type='submit' value='Ending Inv List' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";
/*
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/inventory-ending-comparison-medicine.php' target='rightFrame'>";
echo "<input type='submit' value='Ending Inv Comparison' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";
*/
echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/Reports/paid-balance.php' target='rightFrame'>";
echo "<input type='submit' value='Paid Balance' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/stockCardList.php' target='rightFrame'>";
echo "<input type='hidden' name='inventoryType' value='medicine'>";
echo "<input type='submit' value='Stock Card Medicine' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

echo "<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/inventory/stockCardList.php?inventoryType=supplies' target='rightFrame'>";
echo "<input type='hidden' name='inventoryType' value='supplies'>";
echo "<input type='submit' value='Stock Card Supplies' style='border:1px solid #ff0000; width:100%; height:10%; color:blue; '>";
echo "</form>";

?>
