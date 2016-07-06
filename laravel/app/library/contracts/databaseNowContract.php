<?php

namespace App\Library\Contracts;

Interface databaseNowContract
{

    public function selectNow($table,$cols,$identifier,$identifierData);

}
