<?php


class hospitalPackage {

public $myHost = 'localhost';
public $username = 'root';
public $password = 'cebu01';
public $database = 'Coconut';


public function getMyUrl() {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT ipaddress FROM ipaddress ");

while($row = mysql_fetch_array($result))
  {
return $row['ipaddress'];
  }

}


/***************ggwa ng table*********************/
public function coconutTableStart() {
echo "<Table border=1 cellpadding=0 rules=all cellspacing=0>";
}
public function coconutTableStop() {
echo "</table>";
}
public function coconutTableRowStart() {
echo "<tr>";
}
public function coconutTableRowStop() {
echo "</tr>";
}
public function coconutTableHeader($value) {
echo "<th bgcolor='#3b5998'>&nbsp;<font color=white>".$value."</font>&nbsp;</th>";
}
public function coconutTableData($value) {
echo "<Td>&nbsp;$value&nbsp;</tD>";
}
/**************end ng table*********************************/



public function searchItem($desc,$packageName,$packagePrice,$phicPrice) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT Description,chargesCode,Category from availableCharges where Description like '$desc%%%%%%%%' order by Description asc ");

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Th>Description</th>";
echo "<Th>&nbsp;</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['Description']."</tD>";
echo "<Td>&nbsp;&nbsp;<a href='/COCONUT/hospitalPackage/chargesQTY.php?desc=$row[Description]_$row[chargesCode]_$row[Category]&packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice&unitcost=&Added='><font color=red>Add</font></a>&nbsp;&nbsp;</tD>";
echo "</tr>";
}
echo "</table>";

}




public function searchInventory($desc,$packageName,$packagePrice,$phicPrice) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT description,inventoryCode,upper(inventoryType) as inventoryType,unitcost,Added from inventory where description like '$desc%%%%%%%%' and status not like 'DELETED_%%%%%%%' and inventoryLocation = 'PHARMACY' order by description asc ");

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Th>Description</th>";
echo "<Th>&nbsp;</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['description']."</tD>";
echo "<Td>&nbsp;&nbsp;<a href='/COCONUT/hospitalPackage/chargesQTY.php?desc=$row[description]_$row[inventoryCode]_$row[inventoryType]&packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice&unitcost=$row[unitcost]&Added=$row[Added]'><font color=red>Add</font></a>&nbsp;&nbsp;</tD>";
echo "</tr>";
}
echo "</table>";

}



public function searchDoctor($desc,$packageName,$packagePrice,$phicPrice) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT Name,doctorCode from Doctors where Name like '$desc%%%%%%%%' order by Name asc ");

echo "<table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<Th>Description</th>";
echo "<Th>&nbsp;</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['Name']."</tD>";
echo "<Td>&nbsp;&nbsp;<a href='/COCONUT/hospitalPackage/chargesQTY.php?desc=$row[Name]_$row[doctorCode]_PROFESSIONAL FEE&packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice&unitcost=&Added='><font color=red>Add</font></a>&nbsp;&nbsp;</tD>";
echo "</tr>";
}
echo "</table>";

}



public function addPackageInclude($packageName,$packageIncluded_desc,$packageIncluded_qty,$packagePrice,$unitcost,$Added,$phicPrice) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO hospitalPackage (packageName,packageIncluded_description,packageIncluded_qty,packagePrice,unitcost,Added,package_phicPrice)
VALUES
('".mysql_real_escape_string($packageName)."','".mysql_real_escape_string($packageIncluded_desc)."','$packageIncluded_qty','$packagePrice','$unitcost','$Added','$phicPrice')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "<script type='text/javascript' >";
//echo "alert('Item Added in the Package');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/searchCharges.php?packageName=$packageName&packagePrice=$packagePrice&phicPrice=$phicPrice';";
echo "</script>";

mysql_close($con);


}



public function showAddedPackage($packageName) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT packageNo,packageIncluded_description,packageIncluded_qty FROM hospitalPackage WHERE packageName = '$packageName' order by packageIncluded_description asc ");

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();

$desc = preg_split ("/\_/", $row['packageIncluded_description']); 

$this->coconutTableData("&nbsp;".$desc[0]);
$this->coconutTableData("&nbsp;".$row['packageIncluded_qty']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/deleteIncluded.php?packageNo=$row[packageNo]&packageName=$packageName'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}





public function getMedicalPackage() {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT packageName,packagePrice FROM hospitalPackage group by packageName order by packageName asc ");

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Package Name");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/showAddedPackage_update.php?packageName=$row[packageName]' target='selection1'>".$row['packageName']."</a>");
$this->coconutTableData("&nbsp;".number_format($row['packagePrice'],2));
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/masterfile/editPackage.php?packageName=$row[packageName]&packagePrice=$row[packagePrice]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/masterfile/deletePackage.php?packageName=$row[packageName]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}



//UNIVERSAL SELECT
public function selectNow($table,$cols,$identifier,$identifierData) {

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT ($cols) as cols from $table  where $identifier = '$identifierData'  ");

while($row = mysql_fetch_array($result))
  {
return $row['cols'];
  }

}


public function showAddedPackage_onPatient($packageName,$registrationNo,$username,$batchNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT packageNo,packageIncluded_description,packageIncluded_qty,unitcost,Added FROM hospitalPackage WHERE packageName = '$packageName' order by packageIncluded_description asc ");


echo "<form method='get' action='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/onPatient/applyPackage.php'>";
echo "<input type='hidden' name='batchNo' value='$batchNo' >";
echo "<input type='hidden' name='registrationNo' value='$registrationNo' >";
echo "<input type='hidden' name='username' value='$username' >";
echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
echo "<input type='hidden' name='unitcost' value='$row[unitcost]'>";
echo "<input type='hidden' name='Added' value='$row[Added]'>";
$this->coconutTableRowStart();

$desc = preg_split ("/\_/", $row['packageIncluded_description']); 

if( $desc[2] == "MEDICINE" || $desc[2] == "SUPPLIES" ) {

if( $this->selectNow("inventory","quantity","inventoryCode",$desc[1]) > $row['packageIncluded_qty'] ) { // available p ung meds/supplies
$this->coconutTableData("<input type='checkbox' name='packageNo[]' value='$row[packageNo]' checked='checked'>");
}else {
//$this->coconutTableData("<input type='checkbox' name='packageNo[]' value='$row[packageNo]'>");
$this->coconutTableData("<a href='/COCONUT/hospitalPackage/onPatient/searchCharges.php?packageNo=$row[packageNo]'><font size=2 color=red>Zero Stock<br> [UPDATE]</font></a>");
}

}else {
$this->coconutTableData("<input type='checkbox' name='packageNo[]' value='$row[packageNo]' checked='cheecked' >");
}

$this->coconutTableData("&nbsp;".$desc[0]);
$this->coconutTableData("&nbsp;".$row['packageIncluded_qty']);
$this->coconutTableRowStop();
  }
$this->coconutTableStop();
echo "<br><br>";
echo "<input type=submit value='Apply Package' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</form>";
echo "<Br>";



}


public function getMedicalPackage_onPatient($registrationNo,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT packageName,packagePrice FROM hospitalPackage group by packageName order by packageName asc ");

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Package Name");
$this->coconutTableHeader("Price");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/onPatient/showIncluded.php?packageName=$row[packageName]&registrationNo=$registrationNo&username=$username' target='selection1'>".$row['packageName']."</a>");
$this->coconutTableData("&nbsp;".number_format($row['packagePrice'],2));
$this->coconutTableRowStop();
  }
$this->coconutTableStop();
echo "<Br>";
echo "<a href='http://".$this->getMyUrl()."/COCONUT/hospitalPackage/onPatient/removePackage.php?registrationNo=$registrationNo&username=$username'><font size=2 color=red>Remove Package</font></a>";
}




public function searchReplaceItem($packageNo,$item) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->myHost,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT inventoryCode,description,quantity,genericName FROM inventory WHERE (description like '%%%%%$item%%%%%' or genericName like '%%%%%$item%%%%%') and quantity > 0 and inventoryLocation = 'PHARMACY' and status not like 'DELETED%%%%%%' ");

echo "<center>";
echo "<table border=1 cellspacing=0 cellpadding=1>";
echo "<tr>";
echo "<th>Particulars</th>";
echo "<th>Generic</th>";
echo "<th>QTY</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<a href='/COCONUT/hospitalPackage/onPatient/itemQTY.php?packageNo=$packageNo&inventoryCode=$row[inventoryCode]'>".$row['description']."</a></td>";
echo "<td>&nbsp;".$row['genericName']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "</tr>";
  }
echo "</table>";
}






}


?>
