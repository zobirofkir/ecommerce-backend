<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class OfferFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'OfferService';
    }
}
