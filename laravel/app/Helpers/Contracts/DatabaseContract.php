<?php

namespace App\Helpers\Contracts;

Interface DatabaseContract
{

    public function select($table,$cols,$identifier,$identifierData);

    public function doubleSelectCondition($table,$cols,$identifier,$identifierData,$condition,$identifier1,$identifierData1,$condition1);

}