<?php

namespace EragLaravelPwa\Facades;

use EragLaravelPwa\Services\PWAService;
use Illuminate\Support\Facades\Facade;

class Pwa extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PWAService::class;
    }
} 