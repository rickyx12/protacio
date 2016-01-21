<?php
include("../../../../myDatabase2.php");
$transactionNo = $_GET['transactionNo'];
$username = $_GET['username'];
$type = $_GET['type'];
$ro = new database2();

$ro->coconutDesign();


$ro->coconutFormStart("post","addEntry1.php");

$ro->coconutHidden("transactionNo",$transactionNo);
$ro->coconutHidden("username",$username);
$ro->coconutHidden("dateEncoded",date("Y-m-d"));
$ro->coconutHidden("type",$type);
echo "<br>";
$ro->coconutBoxStart("500","320");
echo "<Br>";
echo "<Table border=0>";
echo "<Tr>";
echo "<td>Acct. Head</td>";
echo "<td>";
$ro->coconutComboBoxStart_long("accountHeads");
$ro->accountTitleSelection();
$ro->coconutComboBoxStop();
echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>Paid To</td>";
echo "<td>";
$ro->coconutTextBox("paidTo","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Narration</td>";
echo "<td><textarea name='narration' cols=40 rows=3 style='border:1px solid #000000;'></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font size=2>Chq/LPQ/<br>Invoice No</font></td>";
echo "<td>";
$ro->coconutTextBox("invoiceNo","");
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Dated</td>";
echo "<td>";
$ro->coconutComboBoxStart_short("datedMonth");
echo "<option value=''></option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$ro->coconutComboBoxStop();

echo "-";
$ro->coconutComboBoxStart_short("datedDay");
echo "<option value=''></option>";
for( $x=1;$x<32;$x++ ) {

if( $x<10 ) {
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$ro->coconutComboBoxStop();

echo "-";
$ro->coconutTextBox_short("datedYear","");

echo "</td>";
echo "</tr>";

echo "<Tr>";
echo "<td><font color='blue'>Debit</font></td>";
echo "<tD>";
$ro->coconutTextBox_short("debit","");
echo "</td>";
echo "<tr>";

echo "<td><font color='red'>Credit</font></td>";
echo "<tD>";
$ro->coconutTextBox_short("credit","");
echo "</td>";
echo "<tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();
?>
