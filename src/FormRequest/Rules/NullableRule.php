<?php

namespace Swarley\Squabble\FormRequest\Rules;

use Swarley\Squabble\FormRequest\FormRequestProperty;
use Swarley\Squabble\FormRequest\FormRequestRule;

class NullableRule extends FormRequestRule
{
    public function onRuleAdd(FormRequestProperty $property): void
    {
        $property->setNullable();
    }
}
