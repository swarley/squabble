<?php

namespace Swarley\Squabble\Attributes;

use Illuminate\Foundation\Http\FormRequest;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_FUNCTION)]
class SquabbleRequest
{
    /**
     * Create a new instance.
     *
     * @param  class-string<FormRequest>  $request
     * @return void
     */
    public function __construct(string $request) {}
}
