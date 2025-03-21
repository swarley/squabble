<?php

namespace Swarley\Squabble\Attributes;

use Attribute;
use Illuminate\Http\Response;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class SquabbleResponse
{
    /**
     * Create a new instance.
     *
     * @param  class-string<Response>  $response
     * @return void
     */
    public function __construct(string $response) {}
}
