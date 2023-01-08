<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\TinifyService
 */
class Tinify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tinify';
    }
}
