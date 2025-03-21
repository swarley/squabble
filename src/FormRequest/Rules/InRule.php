<?php

namespace Swarley\Squabble\FormRequest\Rules;

class InRule extends LiteralRule
{
    public function __construct(
        protected array $values,
    ) {}
}
