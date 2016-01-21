<?php
include("../../myDatabase2.php");

$fromMonth = $_POST['fromMonth'];
$fromDay = $_POST['fromDay'];
$fromYear = $_POST['fromYear'];
$toMonth = $_POST['toMonth'];
$toDay = $_POST['toDay'];
$toYear = $_POST['toYear'];
$ro = new database2();


$from = $fromYear."-".$fromMonth."-".$fromDay;
$to = $toYear."-".$toMonth."-".$toDay;

?>

<style type="text/css">
.leftcol {
float: left;
width: 30%;
margin:30px;
}
.rightcol {
float: left;
width: 60%;
}        
</style>

<?

echo "<center><font size=4>Cash and Charge for Medicine and Supplies</font>";
echo "<Br>".$from." to ".$to."</center>";

echo "<table border=1 cellspacing=0 class='leftcol'>";
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("Particulars");
$ro->coconutTableHeader("Cash");
$ro->coconutTableRowStart();
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td align='center'>&nbsp;<b>MEDICINE</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$ro->cashANDcharge_paid($from,$to,"MEDICINE");
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;".number_format($ro->cashANDcharge_paid_medicine(),2)."</td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td align='center'>&nbsp;<b>SUPPLIES</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$ro->cashANDcharge_paid($from,$to,"SUPPLIES");
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;".number_format($ro->cashANDcharge_paid_supplies(),2)."</td>";
echo "</tr>";
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>SUB TOTAL</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_paid_medicine() + $ro->cashANDcharge_paid_supplies(),2)."</b></td>";
echo "</tr>";

$ro->coconutTableStop();

echo "<Br><Br>";

echo "<table border=1 cellspacing=0 class='rightcol'>";
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("Particulars");
$ro->coconutTableHeader("PHIC");
$ro->coconutTableHeader("Company");
$ro->coconutTableRowStart();
echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td align='center'>&nbsp;<b>MEDICINE</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$ro->cashANDcharge_charge($from,$to,"MEDICINE");
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_charge_medicine_phic(),2)."</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_charge_medicine_company(),2)."</b></td>";
echo "</tr>";


echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td align='center'>&nbsp;<b>SUPPLIES</b></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$ro->cashANDcharge_charge($from,$to,"SUPPLIES");
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_charge_supplies_phic(),2)."</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_charge_supplies_company(),2)."</b></td>";
echo "</tr>";
echo "<Tr>";

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>SUB TOTAL</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_charge_medicine_phic() + $ro->cashANDcharge_charge_supplies_phic(),2)."</b></td>";
echo "<td>&nbsp;<b>".number_format($ro->cashANDcharge_charge_medicine_company() + $ro->cashANDcharge_charge_supplies_company(),2)."</b></td>";
echo "</tr>";

$ro->coconutTableStop();



?>
