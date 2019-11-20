<?php

namespace Facilitador\Facades;

use Illuminate\Support\Facades\Facade;

class DecoyURL extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'decoy.url';
    }
}
