<?php

namespace Swarley\Squabble\FormRequest\Rules;

use Swarley\Squabble\FormRequest\FormRequestRule;

class LiteralRule extends FormRequestRule
{
    public function __construct(
        protected string $literal,
    ) {}
}
