<?php
include("../../convenienceDB.php");
$inventoryNo = $_GET['inventoryNo'];
$transactionNo = $_GET['transactionNo'];
$description = $_GET['description'];
$price = $_GET['price'];
$qty = $_GET['qty'];
$username = $_GET['username'];

$ro = new convenienceDB();

$dateAdded = date("Y-m-d");
$timeAdded = date("H:i:s");
$total = ($price * $qty);


if( $ro->selectNow("convenienceInventory","qty","inventoryNo",$inventoryNo) >= $qty ) {
$newQTY = ($ro->selectNow("convenienceInventory","qty","inventoryNo",$inventoryNo) - $qty );
$ro->editNow("convenienceInventory","inventoryNo",$inventoryNo,"qty",$newQTY);
$ro->addSales($inventoryNo,$transactionNo,$description,$price,$qty,$total,$dateAdded,$timeAdded,$username);
}else {
$ro->getBack("Your Requested Quantity is Higher than the available quantity");
}


?>
