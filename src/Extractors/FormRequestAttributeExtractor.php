<?php

namespace Swarley\Squabble\Extractors;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Swarley\Squabble\Contracts\ExtractorContract;

class FormRequestAttributeExtractor implements ExtractorContract
{
    public array $dependencies = [];

    public array $properties = [];

    /**
     * @param  class-string<FormRequest>  $formRequest
     */
    public function __construct(public string $formRequest) {}

    public function extract(): mixed
    {
        $request = ($this->formRequest)::createFromGlobals();

        $rules = $request->rules();

        foreach ($rules as $attribute => $attributeRules) {
            foreach ($attributeRules as $rule) {

            }
        }
    }

    public function processRule(string $attribute, string|Rule $rule): void
    {
        if (str_contains($rule, 'required')) {
            $this->properties[] = $attribute;
        }
    }
}
