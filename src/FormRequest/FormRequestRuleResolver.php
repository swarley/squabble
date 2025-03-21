<?php

namespace Swarley\Squabble\FormRequest;

use Swarley\Squabble\Contracts\FormRequestRuleResolverContract;

class FormRequestRuleResolver implements FormRequestRuleResolverContract
{
    // TODO: do this better
    public static $rules = [
        'Required' => Rules\RequiredRule::class,
        'Integer' => Rules\Types\NumberRule::class,
        'Numeric' => Rules\Types\NumberRule::class,
        'String' => Rules\Types\StringRule::class,
        'Nullable' => Rules\NullableRule::class,
        'Boolean' => Rules\Types\BooleanRule::class,
    ];

    public function resolve(string $rule, array $arguments = []): FormRequestRule
    {
        /**
         * @var class-string<FormRequestRule> $rule
         */
        $rule = static::$rules[$rule] ?? FormRequestRule::class;

        return new $rule($arguments);
    }
}
