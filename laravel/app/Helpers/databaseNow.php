<?php

namespace app\Helpers;

use DB;
use App\Helpers\Contracts\databaseNowContract;

class databaseNow implements databaseNowContract
{


    public function selectNow($table,$cols,$identifier,$identifierData) {

        $query = DB::table($table)->select(DB::raw($cols.' as cols'))->where($identifier,'=',$identifierData)->get();

        foreach($query as $q ) {
            return $q->cols;
        }

    }

    public function selectLastNow($table,$cols,$identifier,$identifierData,$orderBy) {

        $query = DB::select('SELECT '.$cols.' as cols FROM '.$table.' WHERE '.$identifier.' = '.$identifierData.' ORDER BY '.$orderBy.' DESC LIMIT 1');

        foreach($query as $q) {
            return $q->cols;
        }

    }



}