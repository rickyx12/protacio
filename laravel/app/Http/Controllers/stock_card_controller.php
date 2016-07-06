<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;

class stock_card_controller extends Controller
{
   

	public function stock_card_list($inventoryType) {

		$stockCardNo = DB::table('inventoryStockCard')->select('stockCardNo')
		->where('inventoryType','=',$inventoryType)
		->where('status','!=','DELETED')
		->get();

		$data = array(
			'stockCardNo' => $stockCardNo
			);

		return view('stockCard/low_unitcost')->with($data);

	}

}
