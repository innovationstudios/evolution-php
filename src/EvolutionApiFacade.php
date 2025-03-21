<?php

namespace EvolutionApiPlugin;

use Illuminate\Support\Facades\Facade;

class EvolutionApiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EvolutionApi::class;
    }
}