<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test',function(){
	return 'test';
});

Route::get('inventory/unitcost/{inventoryType}','stockCardController@stock_card_unitcost');

Route::get('inventory/ending/quarter',function(){
	return view('inventory/ending/endingInventory_quarter');
});

Route::get('inventory/ending/{inventoryType}/{quarter}',[
		'as' => 'endingInventory',
		'uses' => 'EndingInventoryController@list_ending_inventory'
	]);

Route::get('inventory/ending/post',function(){
	$inventoryType = Input::get('inventoryType');
	$quarter = Input::get('quarter');
	return redirect()->route('endingInventory',[
			'inventoryType' => $inventoryType,
			'quarter' => $quarter
		]);
});

Route::post('inventory/ending/{stockCardNo}/{quarter}','EndingInventoryController@encoded_ending_inventory');
Route::post('inventory/ending/put/medicine/{stockCardNo}/{endQTY}','InventoryController@addMedicine');

Route::get('inventory/test','InventoryController@testInventory');