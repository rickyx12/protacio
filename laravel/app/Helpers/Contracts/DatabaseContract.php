<?php

namespace App\Helpers\Contracts;

Interface DatabaseContract
{

    public function select($table,$cols,$identifier,$identifierData);

}