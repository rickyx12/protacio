<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class EndingInventoryController extends Controller
{
    
	public function list_ending_inventory($inventoryType,$quarter) {

		$ending = DB::table('endingInventory')
		->join('inventoryStockCard','endingInventory.stockCardNo','=','inventoryStockCard.stockCardNo')
		->select('endingInventory.stockCardNo','inventoryStockCard.inventoryType','endingInventory.quarter','inventoryStockCard.description','inventoryStockCard.genericName',DB::raw('SUM(endingInventory.endingQTY) as endQTY'),DB::raw('SUM(endingInventory.unitcost) as unitcost'))
		->where('quarter','=',$quarter)
		->where('inventoryStockCard.inventoryType','=',$inventoryType)
		->groupBy('stockCardNo')
		->get();

		$data = array(
			'ending' => $ending
			);

		return view('inventory/ending/ending_inventory',$data);

	}

	public function encoded_ending_inventory($stockCardNo,$quarter) {

		$encodedEnding = DB::table('endingInventory')->select('endingQTY','unitcost','inventoryLocation','date','username')
		->where('stockCardNo','=',$stockCardNo)
		->where('quarter','=',$quarter)
		->get();

		return view('inventory/ending/encoded_ending_inventory',['encodedEnding' => $encodedEnding]);
	}


}
