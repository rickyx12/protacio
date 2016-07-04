<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class UserController extends Controller
{
    public function getIndex() {
    	echo "index";
    }

    public function getRegister() {
    	echo "register";
    }

    public function getName() {

    	$name = DB::select('SELECT completeName FROM registeredUser WHERE module = :module ',['module'=>'PHARMACY']);
    	return view('users',['names' => $name]);

    }

    public function getId() {
    	$user = DB::table('registeredUser')->select('username','password')
    			->where('module','PHARMACY')
    			->orWhere('module','CASHIER')
    			->get();
    	
    	return view('users',['users'=>$user]);

    }


    public function postName($name) {
    	echo "Hello ".$name;
    }

    public function formName() {
    	echo Input::get('name');
    }


}
