<?php

namespace Swarley\Squabble\Contracts;

use Swarley\Squabble\FormRequest\FormRequestRule;

interface FormRequestRuleResolverContract
{
    public function resolve(string $rule, array $arguments = []): FormRequestRule;
}
