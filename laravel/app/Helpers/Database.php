<?php

namespace App\Helpers;

use DB;
use App\Helpers\Contracts\DatabaseContract;

class Database implements DatabaseContract
{

    public function select($table,$cols,$identifier,$identifierData)
    {
        $sql = DB::table($table)->select($cols.' as cols')->where($identifier,'=',$identifierData)->get();

        foreach($sql as $q) {
        	return $q->cols;
        }
    }

    public function doubleSelectCondition($table,$cols,$identifier,$identifierData,$condition,$identifier1,$identifierData1,$condition1) {

    	$sql = DB::table($table)->select($cols.' as cols')
    	->where($identifier,$condition,$identifierData)
    	->where($identifier1,$condition1,$identifierData1)
    	->get();

    		foreach($sql as $q) {
    			return $q->cols;
    		}
    }

    public function selectLast($table,$cols,$identifier,$identifierData,$ordering)
    {

    	$sql = DB::select('SELECT '.$cols.' as cols FROM '.$table.' WHERE '.$identifier.' = '.$identifierData.' ORDER BY '.$ordering.' DESC LIMIT 1 ');

    	foreach($sql as $q) {
    		return $q->cols;
    	}

    }

}
