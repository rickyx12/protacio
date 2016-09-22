<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>OPD Charges Summary</title>
<script type="text/JavaScript">
<!--
function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }
      }
   }
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
function printF(printData)
{
	var a = window.open ('',  '',"status=1,scrollbars=1, width=auto,height=auto");
	a.document.write(document.getElementById(printData).innerHTML.replace(/<a\/?[^>]+>/gi, ''));
	a.document.close();
	a.focus();
	a.print();
	a.close();
}
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 16px;color: #000000;font-weight: bold;}
.style2 {font-family: "Times New Roman";font-size: 16px;color: #FF0000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 10px;color: #000000;font-weight: bold;}
.style4 {font-family: Arial;font-size: 10px;color: #000000;font-weight: bold;}
.style5 {font-family: Arial;font-size: 10px;color: #000000;}
.style6 {font-family: Arial;font-size: 12px;color: #0066FF;}
.style7 {font-family: Arial;font-size: 11px;color: #000000;}
.style8 {font-family: Arial;font-size: 10px;color: #FFFFFF;font-weight: bold;}
.tableBottom {border-bottom: 2px solid #000000;}
.tableTop {border-top: 2px solid #000000;}
.tableTopBottom {border-top: 2px solid #000000;border-bottom: 2px solid #000000;}
.tableBottomSides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomLeftSides {border-bottom: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableBottomRightSides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableTopSides {border-top: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopLeftSides {border-top: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopRightSides {border-top: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableTopBottomSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableTopBottomLeftSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableTopBottomRightSides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableSides {border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableSidesLeft {border-left: 2px solid #000000;border-right: 1px solid #000000;}
.tableSidesRight {border-left: 1px solid #000000;border-right: 2px solid #000000;}
.tableBottomSides {border-bottom: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomRight {border-bottom: 1px solid #000000;border-right: 1px solid #000000;}
.tableBottomLeft {border-bottom: 1px solid #000000;border-left: 1px solid #000000;}
.table2TopRight {border-top: 2px solid #000000;border-right: 1px solid #000000;}
.table2TopLeft {border-top: 2px solid #000000;border-left: 1px solid #000000;}
.tableRight {border-right: 1px solid #000000;}
.tableLeft {border-left: 1px solid #000000;}
.table2Top2Bottom1Sides {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.table2Top2Bottom1Right {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-right: 1px solid #000000;}
.table2Top2Bottom1Left {border-top: 2px solid #000000;border-bottom: 2px solid #000000;border-left: 1px solid #000000;}
.table2Bottom1Sides {border-bottom: 2px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;}
.table2Bottom1Right {border-bottom: 2px solid #000000;border-right: 1px solid #000000;}
.table2Bottom1Left {border-bottom: 2px solid #000000;border-left: 1px solid #000000;}

-->
</style>
</head>

<body onload="placeFocus()">
<?php
include("../myDatabase.php");
$cuz = new database();

($GLOBALS["___mysqli_ston"] = mysqli_connect($cuz->myHost(), $cuz->getUser(), $cuz->getPass()));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $cuz->getDB()));

$username=$_GET['username'];
$registrationNo=$_GET['registrationNo'];

echo "
<div align='center'>
<table width='100%' border='0' cellspaicng='0' cellpadding='0'>
";

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName, pr.firstName, pr.middleName, rd.Company FROM patientRecord pr, registrationDetails rd WHERE pr.patientNo=rd.patientNo AND rd.registrationNo='$registrationNo'");
while($afetch=mysqli_fetch_array($asql)){
$lastName=$afetch['lastName'];
$firstName=$afetch['firstName'];
$middleName=$afetch['middleName'];
$Company=$afetch['Company'];
}
echo "
  <tr>
    <td width='46%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td width='100%'><img src='../../COCONUT/myImages/ProtacioHeader.png' width='100%' height='auto' /></td>
      </td>
      <tr>
        <td width='100%' height='10'></td>
      </td>
      <tr>
        <td width='100%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td width='auto'><div align='left' class='style4'>Name</div></td>
            <td width='auto'><div align='center' class='style4'>&nbsp;:&nbsp;</div></td>
            <td width='auto' class='tableBottom'><div align='left' class='style5'>$lastName, $firstName $middleName</div></td>
            <td width='auto'><div align='left' class='style4'>&nbsp;Date</div></td>
            <td width='auto'><div align='center' class='style4'>&nbsp;:&nbsp;</div></td>
            <td width='auto' class='tableBottom'><div align='left' class='style5'>".date('M d, Y')."</div></td>
          </tr>
          <tr>
            <td><div align='left' class='style4'>Company</div></td>
            <td><div align='center' class='style4'>&nbsp;:&nbsp;</div></td>
            <td class='tableBottom'><div align='left' class='style5'>$Company</div></td>
            <td><div align='left' class='style4'>&nbsp;Time</div></td>
            <td><div align='center' class='style4'>&nbsp;:&nbsp;</div></td>
            <td class='tableBottom'><div align='left' class='style5'>".date('H:i:s')."</div></td>
          </tr>
        </table></td>
      </tr>
";


echo "
      <tr>
        <td width='100%' height='10'></td>
      </td>
      <tr>
        <td width='100%'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td class='table2TopRight' width='auto'><div align='left' class='style4'>Description</div></td>
            <td class='tableTopSides' width='auto'><div align='center' class='style4'>Qty.</div></td>
            <td class='tableTopSides' width='auto'><div align='center' class='style4'>Price</div></td>
            <td class='table2TopLeft' width='auto'><div align='center' class='style4'>Amount</div></td>
          </tr>
";

$gross=0;
$grossdisc=0;
$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT title FROM patientCharges WHERE registrationNo='$registrationNo' AND status NOT LIKE 'DELETED_%%%%' GROUP BY title ORDER BY title ");
while($afetch=mysqli_fetch_array($asql)){
echo "
          <tr>
            <td colspan='8' height='15' class='tableTopBottom' valign='bottom'><div align='left' class='style3'>".$afetch['title']."</div></td>
          </tr>

";

$totdiscount=0;
$totcashUnpaid=0;
$totphic=0;
$totcompany=0;
$finaltotal=0;

if(($afetch['title']=="MEDICINE")||($afetch['title']=="SUPPLIES")){
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description, sellingPrice, SUM(quantity) AS quantity, SUM(discount) AS discount, SUM(cashUnpaid) AS cashUnpaid, SUM(phic) AS phic, SUM(company) AS company, departmentStatus FROM patientCharges WHERE registrationNo='$registrationNo' AND title='".$afetch['title']."' AND status NOT LIKE 'DELETED_%%%%' GROUP BY description, sellingPrice ORDER BY description");
while($bfetch=mysqli_fetch_array($bsql)){
$departmentStatus=$bfetch['departmentStatus'];
$splitdpeartmentStatus=preg_split('[_]',$departmentStatus);

//if($splitdpeartmentStatus[0]=="dispensedBy"){

$sellingPriceNotReal=$bfetch['sellingPrice'];
if($afetch['title']=='PROFESSIONAL FEE'){$splitprice=preg_split('[/]',$sellingPriceNotReal); $sellingPrice=$splitprice[0];}else{$sellingPrice=$sellingPriceNotReal;}

$description=$bfetch['description'];
$quantity=$bfetch['quantity'];
$discount=$bfetch['discount'];
$cashUnpaid=$bfetch['cashUnpaid'];
$phic=$bfetch['phic'];
$company=$bfetch['company'];

$totdiscount+=$discount;
$totcashUnpaid+=$cashUnpaid;
$totphic+=$phic;
$totcompany+=$company;
$finaltotal+=($sellingPrice*$quantity);


echo "
          <tr>
            <td class='tableRight' width='auto'><div align='left' class='style5'>".strtoupper($description)."</div></td>
            <td class='tableSides' width='auto'><div align='center' class='style5'>$quantity</div></td>
            <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($sellingPrice,2,'.',',')."&nbsp;</div></td>
            <td class='tableLeft' width='auto'><div align='right' class='style5'>".number_format(($sellingPrice*$quantity),2,'.',',')."</div></td>
          </tr>
";
/*}
else{
$totdiscount+=0;
$totcashUnpaid+=0;
$totphic+=0;
$totcompany+=0;
$finaltotal+=0;
}*/

}

}
else{
$bsql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description, sellingPrice, SUM(quantity) AS quantity, SUM(discount) AS discount, SUM(cashUnpaid) AS cashUnpaid, SUM(phic) AS phic, SUM(company) AS company, departmentStatus, SUM(doctorsPF) as doctorsPF FROM patientCharges WHERE registrationNo='$registrationNo' AND title='".$afetch['title']."' AND status NOT LIKE 'DELETED_%%%%' GROUP BY description, sellingPrice ORDER BY description");
while($bfetch=mysqli_fetch_array($bsql)){
$sellingPriceNotReal=$bfetch['sellingPrice'];
if($afetch['title']=='PROFESSIONAL FEE'){$splitprice=preg_split('[/]',$sellingPriceNotReal); $sellingPrice=$splitprice[0];}else{$sellingPrice=$sellingPriceNotReal;}

$description=$bfetch['description'];
$quantity=$bfetch['quantity'];
$discount=$bfetch['discount'];
$cashUnpaid=$bfetch['cashUnpaid'];
$phic=$bfetch['phic'];
$company=$bfetch['company'];

$doctorsPF=$bfetch['doctorsPF'];

$totdiscount+=$discount;
$totcashUnpaid+=$cashUnpaid;
$totphic+=$phic;
$totcompany+=$company;
$finaltotal+=($sellingPrice*$quantity);

echo "
          <tr>
            <td class='tableRight' width='auto'><div align='left' class='style5'>".strtoupper($description)."</div></td>
            <td class='tableSides' width='auto'><div align='center' class='style5'>$quantity</div></td>
            <td class='tableSides' width='auto'><div align='right' class='style5'>".number_format($sellingPrice,2,'.',',')."&nbsp;</div></td>
";

if($afetch['title']=="PROFESSIONAL FEE"){
echo "
            <td class='tableLeft' width='auto'><div align='right' class='style5'>".number_format((($sellingPrice*$quantity)-$doctorsPF),2,'.',',')."/".number_format($doctorsPF,2,'.',',')."</div></td>
";
}
else{
echo "
            <td class='tableLeft' width='auto'><div align='right' class='style5'>".number_format(($sellingPrice*$quantity),2,'.',',')."</div></td>
";
}

echo "
          </tr>
";
}
}

$gross+=$finaltotal;
$grossdisc+=$totdiscount;
/*echo "
          <tr>
            <td class='table2Top2Bottom1Right' width='auto' colspan='3' height='15'><div align='left' class='style4'>SUB TOTAL</div></td>
            <td class='table2Top2Bottom1Left' width='auto'><div align='right' class='style4'>".number_format($finaltotal,2,'.',',')."</div></td>
          </tr>
";*/
}

echo "
          <tr>
            <td class='table2Top2Bottom1Right' width='auto' colspan='3' height='15'><div align='left' class='style4'>TOTAL CHARGES</div></td>
            <td class='table2Top2Bottom1Left' width='auto'><div align='right' class='style4'>".number_format($gross,2,'.',',')."</div></td>
          </tr>
          <tr>
            <td class='table2Bottom1Right' width='auto' colspan='3' height='15'><div align='left' class='style4'>TOTAL DISCOUNT</div></td>
            <td class='table2Bottom1Left' width='auto'><div align='right' class='style4'>".number_format($grossdisc,2,'.',',')."</div></td>
          </tr>
          <tr>
            <td class='table2Bottom1Right' width='auto' colspan='3' height='15'><div align='left' class='style4'>LESS DISCOUNT</div></td>
            <td class='table2Bottom1Left' width='auto'><div align='right' class='style4'>".number_format(($gross-$grossdisc),2,'.',',')."</div></td>
          </tr>
";

echo "

        </table></td>
      </tr>
";


echo "
    </table></td>

    <td width='54%'></td>
  </tr>
</table>
</div> 
";
?>
</body>
</html>
