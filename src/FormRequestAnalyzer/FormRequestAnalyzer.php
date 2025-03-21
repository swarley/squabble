<?php

namespace Swarley\Squabble\FormRequestAnalyzer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationRuleParser;
use Swarley\Squabble\Contracts\FormRequestAnalyzerContract;
use Swarley\Squabble\Contracts\FormRequestRuleResolverContract;
use Swarley\Squabble\FormRequest\FormRequestProperty;

class FormRequestAnalyzer implements FormRequestAnalyzerContract
{
    /**
     * @param class-string<FormRequest> $formRequest
     * @return array<FormRequestProperty>
     */
    public function analyze(string $formRequest): array
    {
        $formRequestInstance = new $formRequest;
        $rules = $formRequestInstance->rules();
        $resolver = app(FormRequestRuleResolverContract::class);
        $tokenizedRules = [];
        $validationParser = new ValidationRuleParser([]);
        $rules = $validationParser->explode($rules)->rules;

        foreach ($rules as $attribute => $rules)
        {
            $formRequestProperty = new FormRequestProperty($attribute);

            foreach ($rules as $rule)
            {
                $parsedRule = $validationParser->parse($rule);
                $resolvedRule = $resolver->resolve($parsedRule[0], $parsedRule[1]);
                $formRequestProperty->addRule($resolvedRule);
            }

            $tokenizedRules[] = $formRequestProperty;
        }

        return $tokenizedRules;
    }
}
