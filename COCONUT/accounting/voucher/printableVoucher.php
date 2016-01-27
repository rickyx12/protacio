<?php
include("../../../myDatabase2.php");
$checkedNo = $_GET['checkedNo'];
$ro = new database2();
$ro->coconutDesign();
echo "<style type='text/css'>";


echo "

.underLine {
border:1px solid #000;
border-color:transparent transparent black transparent;
font-size:17px;
width:65%;
}


.underLine1 {
border:1px solid #000;
border-color:transparent transparent black transparent;
font-size:17px;
width:35%;
}

";

echo "</style>";

echo "<div style='border:1px solid #000; width:100%; height:20%; border-top:0px;'>";
echo "&nbsp;<b>PAGADIAN CITY MEDICAL CENTER</b>";

echo "<Br>";
echo "<table border=0 width='110%'>";
echo "<Tr>";
echo "<td>";
echo "&nbsp;".$ro->selectNow("vouchers","payee","checkedNo",$checkedNo);
echo "</td>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
echo "<tD>&nbsp;".$ro->selectNow("vouchers","date","checkedNo",$checkedNo)."<br>".number_format($ro->selectNow("vouchers","amount","checkedNo",$checkedNo),2)."</tD>";
echo "</tr>";
echo "</table>";
echo "<Br>";
echo "&nbsp;".$ro->convert_number_to_words($ro->selectNow("vouchers","amount","checkedNo",$checkedNo))."&nbsp;Pesos Only";
echo "</div>";

echo "<Br><Br>";


echo "CHECK DISBURSEMENT VOUCHER";
echo "<Br><br>";

echo "<table border=0>";
echo "<tr>";
echo "<td>";
echo "Chk DV NO:&nbsp;<input type='text' class='underLine'>";
echo "</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";

echo "<Td>Check No:&nbsp;<input type='text' class='underLine' value='$checkedNo'></tD>";
echo "</tr>";
echo "</table>";

echo "<br><Br>";

echo "<table border=0>";
echo "<tr>";
echo "<td>";
echo "Amount:&nbsp;<input type='text' class='underLine' value='".number_format($ro->selectNow("vouchers","amount","checkedNo",$checkedNo),2)."'>";
echo "</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";

echo "<Td>Date:&nbsp;<input type='text' class='underLine' value='".$ro->selectNow("vouchers","date","checkedNo",$checkedNo)."'></tD>";
echo "</tr>";
echo "</table>";

echo "<br><Br>";

echo "Particulars/Payment For";
echo "<Br>";
echo "<b>".$ro->selectNow("vouchers","description","checkedNo",$checkedNo)."</b>";
echo "<Br><Br>";

echo "<div style='border:1px solid #000; width:100%; height:15%;'>";
echo "<Br>";
echo "<table border=0 width='100%'>";
echo "<Tr>";
echo "<td>&nbsp;&nbsp;Prepared By:</tD>";
echo "<Td>Approved By:</tD>";
echo "</tr>";

echo "<Tr>";
echo "<td>&nbsp;&nbsp;<u><font size=1>MELANIE C. MANGUPIS/RUTH F. MONTESA</font></u><Br>&nbsp;&nbsp;&nbsp;Accounting Clerk</tD>";
echo "<Td><u><font size=1>DR. SAMUEL J. MENDERO/DRA. MARIA LOURDES I. MENDERO</u></font><br>&nbsp;&nbsp;Medical Director</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;&nbsp;Date:&nbsp;<input type='text' class='underLine'></tD>";
echo "<Td>Date:&nbsp;<input type='text' class='underLine'></tD>";
echo "</tr>";

echo "</table>";
echo "</div>";

echo "<Br>";
echo "<div style='float:left; border:1px solid #000; width:50%; height:30%'>Accounting Entry:</div>";
echo "<div style='float:center; text-align:center; '>
<br>
Released Check By:<Br>
<input type='text' class='underLine1'><Br>
<font size=2>Signature over Printed Name</font>

<Br><Br><bR>
Received Check/Payment By:<br>
<input type='text' class='underLine1'><Br>
<font size=2> Signature over Printed Name </font>
<br><br><Br>

<font size=3>Date:</font><input type='text' class='underLine1'>
</div>";

echo "<Br><Br><BR>";
?>


