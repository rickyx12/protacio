<?
include "../../myDatabase4.php";
$ro = new database4();
$ro->inventory_list("medicine");

$inventoryCode = $ro->inventory_list_inventoryCode();
$generic = $ro->inventory_list_genericName();
$brand = $ro->inventory_list_description();
$qty = $ro->inventory_list_qty();
$stockCardNo = $ro->inventory_list_stockCardNo();
$unitcost = $ro->inventory_list_unitcost();
$ipdPrice = $ro->inventory_list_ipdPrice();
$opdPrice = $ro->inventory_list_opdPrice();
$dateAdded = $ro->inventory_list_dateAdded();

$countInventoryCode = count($inventoryCode);
$genericNo = count($generic);
$brandNo = count($brand);
$qtyNo = count($qty);
$countStockCard = count($stockCardNo);
$unitcostNo = count($unitcost);
$ipdPriceNo = count($ipdPrice);
$opdPriceNo = count($opdPrice);
$dateAddedNo = count($dateAdded);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap-3.3.6/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="http://localhost/jquery.qtip.custom/jquery.qtip.css" />
</head>
<body>
<div class="container">
  <h2>Inventory</h2>
  <p>Medicine</p>            
  <table class="table table-hover">
      <thead>
      <tr>
      	<th>Stock#</th>
        <th>Generic</th>
        <th>Brand</th>
        <th>QTY</th>
        <th>Unitcost</th>
        <th>IPD</th>
        <th>OPD</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    	<? for($a=0,$b=0,$c=0,$d=0,$e=0,$f=0,$g=0,$h=0,$i=0;$a<$genericNo,$b<$brandNo,$c<$qtyNo,$d<$countStockCard,$e<$unitcostNo,$f<$ipdPriceNo,$g<$opdPriceNo,$h<$dateAddedNo,$i<$countInventoryCode;$a++,$b++,$c++,$d++,$e++,$f++,$g++,$h++,$i++) { ?>
    	<tr>
    		<td><? echo $stockCardNo[$d] ?></td>
    		<td><? (strlen($generic[$a]) > 15) ? $x = substr($generic[$a],0,15)."......." : $x = $generic[$a]; echo $x; ?></a></td>
    		<td><? echo $brand[$b] ?></td>
    		<td><? echo $qty[$c] ?></td>
    		<td><? ($unitcost[$e] > 0) ? $x=number_format($unitcost[$e],2) : $x=""; echo $x; ?></td>
    		<td><? ($ipdPrice[$f] > 0) ? $x=number_format($ipdPrice[$f],2) : $x=""; echo $x; ?></td>
    		<td><? ($opdPrice[$g] > 0) ? $x=number_format($opdPrice[$g],2) : $x=""; echo $x; ?></td>
    		<td><? echo "<a href='deleteInv.php?inventoryCode=".$inventoryCode[$i]."'><img src='/COCONUT/myImages/trash1.png'></a>"; ?></h5></td>    		
    	</tr>
     	<? } ?>
    </tbody>
  </table>
</div>
</body>
</html>