<?php
include("../../myDatabase.php");
$status = $_GET['status'];
$registrationNo = $_GET['registrationNo'];
$chargesCode = $_GET['chargesCode'];
$description = $_GET['description'];
$sellingPrice = $_GET['sellingPrice'];
$discount = $_GET['discount'];
$timeCharge = $_GET['timeCharge'];
$room = $_GET['room'];

$chargeBy = $_GET['chargeBy'];
$service = $_GET['service'];
$title = $_GET['title'];
$paidVia = $_GET['paidVia'];
$cashPaid = $_GET['cashPaid'];
$batchNo = $_GET['batchNo'];
$username = $_GET['username'];
$inventoryFrom = $_GET['inventoryFrom'];
$paycash = $_GET['paycash'];
$remarks = $_GET['remarks'];
$stockCardNo = $_GET['stockCardNo'];


$ro = new database();

if($ro->selectNow("inventory","quantity","inventoryCode",$chargesCode) < 1 ) {
$ro->getBack("Sorry, Out of Stock");
}

echo "
<style type='text/css'>
.qty {order: 1px solid #000;color: #000;height:25px;width: 100px;padding:4px 4px 4px 10px;}
</style>


<br /><br /><br />
<form method='get' action='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/addCharges_cash.php'>
<br>
<div align='center'>
<table border='1' cellpadding='0' cellspacing='0'>
  <tr>
    <td><table border='0' cellpadding='0' cellspacing='0'>
      <tr>
        <td colspan='2' height='25'><div align='left'><font size='4'><b>&nbsp;Select Syringe to use:</b></font></div></td>
      </tr>
      <tr>
        <td colspan='3' height='30'>&nbsp;<input type='button' class='button' value='  &lt;&lt;Back  ' onClick='javascript: history.go(-1)' style='border:1px solid #000000; background-color:transparent;'></td>
      </tr>
      <tr>
        <td colspan='2' height='20'></td>
      </tr>
      <tr>
        <td><div align='left'>&nbsp;No Syringe&nbsp;</div></td>
        <td width='100'><div align='center'>&nbsp;&nbsp;</div></td>
        <td>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/quantitySyringe.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=&description=&sellingPrice=0&timeCharge=".$ro->getSynapseTime()."&chargeBy=$username&service=Others&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom&discount=0&room=&paycash=no&remarks=&classification=&status2=$status&qty2=1&registrationNo2=$registrationNo&chargesCode2=$chargesCode&description2=$description&sellingPrice2=$sellingPrice&month2=".date("m")."&day2=".date("d")."&year2=".date("Y")."&timeCharge2=$timeCharge&chargeBy2=$chargeBy&service2=$service&title2=$title&paidVia2=$paidVia&cashPaid2=$cashPaid&batchNo2=$batchNo&username2=$username&discount2=$discount&inventoryFrom2=$inventoryFrom&room2=$room&paycash2=$paycash&remarks2=$remarks'><font color=blue>[SELECT]</font></a>&nbsp;</td>
      </tr>
      <tr>
        <td colspan='2' height='20'></td>
      </tr>
      <tr>
        <td colspan='3' height='20'><b>Inventory From $inventoryFrom</b></td>
      </tr>
      <tr>
        <td height='15'><div align='left'><font color='green' size='1'><b>Description</b></div></td>
        <td height='15'><div align='center'><font color='green' size='1'><b>Qty</b></div></td>
        <td height='15'><div align='center'><font color='green' size='1'><b></b></div></td>
      </tr>
";

$asql=mysql_query("SELECT inventoryCode,description,unitcost,quantity,classification FROM inventory WHERE description LIKE '%%%%%%%%syringe%%%%%%%' AND inventoryType='supplies' AND inventoryLocation='$inventoryFrom' AND quantity > 0 AND status NOT LIKE 'DELETED_%%%%%%' GROUP BY description ORDER BY description ASC");
while($row=mysql_fetch_array($asql)){
echo "
      <tr>
        <td><div align='left'>&nbsp;".$row['description']."&nbsp;</div></td>
        <td width='100'><div align='center'>&nbsp;".$row['quantity']."&nbsp;</div></td>
        <td>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/quantitySyringe.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[inventoryCode]&description=$row[description]&sellingPrice=0&timeCharge=".$ro->getSynapseTime()."&chargeBy=$username&service=Others&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$inventoryFrom&discount=0&room=&paycash=no&remarks=&classification=$row[classification]&status2=$status&qty2=1&registrationNo2=$registrationNo&chargesCode2=$chargesCode&description2=$description&sellingPrice2=$sellingPrice&month2=".date("m")."&day2=".date("d")."&year2=".date("Y")."&timeCharge2=$timeCharge&chargeBy2=$chargeBy&service2=$service&title2=$title&paidVia2=$paidVia&cashPaid2=$cashPaid&batchNo2=$batchNo&username2=$username&discount2=$discount&inventoryFrom2=$inventoryFrom&room2=$room&paycash2=$paycash&remarks2=$remarks'><font color=blue>[SELECT]</font></a>&nbsp;</td>
      </tr>
";
}

echo "
      <tr>
        <td colspan='2' height='20'></td>
      </tr>
";


$bsql=mysql_query("SELECT inventoryLocation FROM inventory WHERE inventoryType='supplies' AND (inventoryLocation NOT LIKE '$inventoryFrom' AND inventoryLocation NOT LIKE 'CSR') AND quantity > 0 AND status NOT LIKE 'DELETED_%%%%%%' GROUP BY inventoryLocation ORDER BY inventoryLocation");
while($bfetch=mysql_fetch_array($bsql)){
$binventoryloc=$bfetch['inventoryLocation'];

$csql=mysql_query("SELECT inventoryCode,description,unitcost,quantity,classification FROM inventory WHERE description LIKE '%%%%%%%%syringe%%%%%%%' AND inventoryType='supplies' AND inventoryLocation='$binventoryloc' AND quantity > 0 AND status NOT LIKE 'DELETED_%%%%%%' GROUP BY description ORDER BY description ASC");
$ccount=mysql_num_rows($csql);
if($ccount!=0){

echo "
      <tr>
        <td colspan='3' height='20'><b>Inventory From $binventoryloc</b></td>
      </tr>
      <tr>
        <td height='15'><div align='left'><font color='green' size='1'><b>Description</b></div></td>
        <td height='15'><div align='center'><font color='green' size='1'><b>Qty</b></div></td>
        <td height='15'><div align='center'><font color='green' size='1'><b></b></div></td>
      </tr>
";


while($cfetch=mysql_fetch_array($csql)){
echo "
      <tr>
        <td><div align='left'>&nbsp;".$cfetch['description']."&nbsp;</div></td>
        <td width='100'><div align='center'>&nbsp;".$cfetch['quantity']."&nbsp;</div></td>
        <td>&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/availableMedicine/quantitySyringe.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$cfetch[inventoryCode]&description=$cfetch[description]&sellingPrice=0&timeCharge=".$ro->getSynapseTime()."&chargeBy=$username&service=Others&title=SUPPLIES&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$binventoryloc&discount=0&room=&paycash=no&remarks=&classification=$cfetch[classification]&status2=$status&qty2=1&registrationNo2=$registrationNo&chargesCode2=$chargesCode&description2=$description&sellingPrice2=$sellingPrice&month2=".date("m")."&day2=".date("d")."&year2=".date("Y")."&timeCharge2=$timeCharge&chargeBy2=$chargeBy&service2=$service&title2=$title&paidVia2=$paidVia&cashPaid2=$cashPaid&batchNo2=$batchNo&username2=$username&discount2=$discount&inventoryFrom2=$inventoryFrom&room2=$room&paycash2=$paycash&remarks2=$remarks'><font color=blue>[SELECT]</font></a>&nbsp;</td>
      </tr>
";
}
}

echo "
      <tr>
        <td colspan='3' height='20'></td>
      </tr>
";
}


echo "
      <tr>
        <td colspan='3' height='30'>&nbsp;<input type='button' class='button' value='  &lt;&lt;Back  ' onClick='javascript: history.go(-1)' style='border:1px solid #000000; background-color:transparent;'></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>

";
?>
