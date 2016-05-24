<?php namespace Pixelpeter\Genderize\Facades;

use Illuminate\Support\Facades\Facade;

class Genderize extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'genderize';
    }
}
