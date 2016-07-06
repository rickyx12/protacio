<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;

class stockCardController extends Controller
{
    
	public function stock_card_unitcost($inventoryType) {

		$stockCardNo = DB::table('inventoryStockCard')->select('stockCardNo')
		->where('status','!=','DELETED')
		->where('inventoryType','=',$inventoryType)
		->get();

		$data = array(
			'stockCardNo' => $stockCardNo
			);
		return view('stockCard/low_unitcost',$data);

	}

}
