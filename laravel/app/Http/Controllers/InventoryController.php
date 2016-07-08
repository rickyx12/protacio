<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Database;
use App\Http\Requests;
use DB;

class InventoryController extends Controller
{
    

	public function addMedicine($stockCardNo,$endQTY) {

		$ro = new Database();

		$stockCardNo1 = $stockCardNo;
		$genericName = $ro->select('inventoryStockCard','genericName','stockCardNo',$stockCardNo);
	 	$brandName = $ro->select('inventoryStockCard','Description','stockCardNo',$stockCardNo);
		$preparation = $ro->select('inventory','preparation','stockCardNo',$stockCardNo);
		$qty = $endQTY;
	 	$unitcost = $ro->select('endingInventory','unitcost','stockCardNo',$stockCardNo);
		$opdPrice = $ro->selectLast('inventory','opdPrice','stockCardNo',$stockCardNo,'inventoryCode');
		$ipdPrice = $ro->selectLast('inventory','ipdPrice','stockCardNo',$stockCardNo,'inventoryCode');
		$expiration = $ro->selectLast('inventory','expiration','stockCardNo',$stockCardNo,'inventoryCode');
		$remarks = "Ending inventory - ".date('Y-m-d');
		$locked = "no";
		$criticalLevel = "5";
		$inventoryType = $ro->select('inventoryStockCard','inventoryType','stockCardNo',$stockCardNo);
		$inventoryLocation = "PHARMACY";
		$supplier = "";
		$dateAdded = date('Y-m-d');
		$timeAdded = date('H:i:s');
		$addedBy = "System[endingInventory]";
		$beginningQTY = $endQTY;

		if( $inventoryType == 'medicine' ) {

			DB::table('inventory')->insert([
					'stockCardNo' => $stockCardNo1,
					'genericName' => $genericName,
					'description' => $brandName,
					'preparation' => $preparation,
					'quantity' => $qty,
					'unitcost' => $unitcost,
					'opdPrice' => $opdPrice,
					'ipdPrice' => $ipdPrice,
					'expiration' => $expiration,
					'remarks' => $remarks,
					'locked' => $locked,
					'criticalLevel' => $criticalLevel,
					'inventoryType' => $inventoryType,
					'inventoryLocation' => $inventoryLocation,
					'supplier' => $supplier,
					'dateAdded' => $dateAdded,
					'timeAdded' => $timeAdded,
					'addedBy' => $addedBy,
					'beginningQTY' => $beginningQTY
				]);

		}else {

			DB::table('inventory')->insert([
					'stockCardNo' => $stockCardNo1,
					'description' => $brandName,
					'preparation' => $preparation,
					'quantity' => $qty,
					'suppliesUNITCOST' => $unitcost,
					'unitcost' => $ro->selectLast('inventory','unitcost','stockCardNo',$stockCardNo,'inventoryCode'),
					'expiration' => $expiration,
					'remarks' => $remarks,
					'locked' => $locked,
					'criticalLevel' => $criticalLevel,
					'inventoryType' => $inventoryType,
					'inventoryLocation' => $inventoryLocation,
					'supplier' => $supplier,
					'dateAdded' => $dateAdded,
					'timeAdded' => $timeAdded,
					'addedBy' => $addedBy,
					'beginningQTY' => $beginningQTY
				]);

		}
	

	}

}
