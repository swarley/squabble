<?php

namespace Swarley\Squabble\FormRequest\Rules;

use Swarley\Squabble\FormRequest\FormRequestRule;

class AcceptedRule extends FormRequestRule
{
    public function types(): array
    {
        return [
            <<<'TYPE'
                type AcceptedValue = 'yes' | 'on' | '1' | 1 | true | 'true';
            TYPE,
        ];
    }
}
