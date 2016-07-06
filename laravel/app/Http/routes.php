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


//inventory stock card
Route::get('inventory/stockcard/{inventoryType}',[
	'as' => 'inventory/stockcard',
	'uses' => 'stock_card_controller@stock_card_list']);

Route::get('inventory/stockcard/unitcost/{stockCardNo}','stock_card_controller@stock_card_last_unitcost');

Route::get('registration','RegistrationController@index');