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

}
