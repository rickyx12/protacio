<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Supplier</title>
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
//-->
</script>
<style type="text/css">
<!--
.style1 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style2 {font-family: Arial;font-size: 14px;color: #000000;font-weight: bold;}
.style3 {font-family: Arial;font-size: 14px;color: #0066FF;font-weight: bold;}
.style4 {font-family: Arial;font-size: 12px;color: #FFFFFF;font-weight: bold;}
.style5 {font-family: Arial;font-size: 14px;color: #FF0000;font-weight: bold;}
.style6 {font-family: Arial;font-size: 14px;color: #FFFFFF;font-weight: bold;}
.textfield1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button1 {font-family: Arial;font-size: 12px;font-weight: bold;color: #000000;background-color: #FFFFFF;border: 1px solid #000000;height: 25px;}
.button2 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #0066FF;border: 1px solid #000000;}
.button3 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FFFFFF;background-color: #FF9900;border: 1px solid #000000;}
.button4 {font-family: Arial;font-size: 12px;font-weight: bold;color: #999999;background-color: #FFFFFF;border: 1px solid #999999;}
.button5 {font-family: Arial;font-size: 12px;font-weight: bold;color: #FF0000;background-color: #FFFFFF;border: 1px solid #FF0000;}
tr:hover { background-color:yellow;color:black;}
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
$supplierCode=$_GET['supplierCode'];
$supplierName=$_GET['supplierName'];
$contactPerson=$_GET['contactPerson'];
$contactNo=$_GET['contactNo'];
$address=$_GET['address'];
$description=$_GET['description'];
$vatable=$_GET['vatable'];

$asql=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM supplier WHERE supplierCode='$supplierCode'");
while($afetch=mysqli_fetch_array($asql)){
$csupplierName=$afetch['supplierName'];
$ccontactPerson=$afetch['contactPerson'];
$ccontactNo=$afetch['contactNo'];
$caddress=$afetch['address'];
$cdescription=$afetch['description'];
$cvatable=$afetch['vatable'];
}

if(($supplierName==$csupplierName)&&($contactPerson==$ccontactPerson)&&($contactNo==$ccontactNo)&&($address==$caddress)&&($description==$cdescription)&&($vatable==$cvatable)){
echo "
<br />
<div align='lef' class='style2'>No changes where made.</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=SearchSupplier.php?username=$username'>";
}
else{
if($supplierName==""){
echo "
<br />
<div align='lef' class='style5'>Supplier Name must not be blank. Try again!!!</div>
";
echo "<META HTTP-EQUIV='Refresh'CONTENT='3;URL=EditSupplier.php?username=$username&supplierCode=$supplierCode'>";
}
else{
echo "
<br />
<div align='lef' class='style2'>Saving changes...</div>
";

mysqli_query($GLOBALS["___mysqli_ston"], "UPDATE supplier SET supplierName='$supplierName', contactPerson='$contactPerson', contactNo='$contactNo', address='$address', description='$description', vatable='$vatable' WHERE supplierCode='$supplierCode'");

echo "<META HTTP-EQUIV='Refresh'CONTENT='0;URL=SearchSupplier.php?username=$username'>";
}
}
?>
</body>
</html>
