<?php

namespace Swarley\Squabble\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Swarley\Squabble\Squabble
 * @mixin \Swarley\Squabble\Squabble
 */
class Squabble extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Swarley\Squabble\Squabble::class;
    }
}
