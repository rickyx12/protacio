<?php

namespace App\Helpers\Contracts;

Interface databaseNowContract
{
    public function selectNow($table,$cols,$identifier,$identifierData);

    public function selectLastNow($table,$cols,$identifier,$identifierData,$orderBy);

}
