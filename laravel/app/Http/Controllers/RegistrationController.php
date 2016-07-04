<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class RegistrationController extends Controller
{
    
	/*
	public function registrationNo() {

		$patients = DB::select('SELECT registrationNo FROM registrationDetails WHERE dateRegistered = :dateRegistered',['dateRegistered'=>'2016-06-01']);
		return view('registration',['patients'=>$patients]);
	}

	public function patientNo($registrationNo) {
		$patientNo = DB::select('SELECT patientNo FROM registrationDetails WHERE registrationNo = :registrationNo',['registrationNo' => $registrationNo]);
		return $patientNo;
	}
	*/


	public function getIndex() {
		return "index";
	}

	public function getRegister() {
		return "register";
	}

	public function getLogin() {
		return "login";
	}

}
