<?php

use Swarley\Squabble\Contracts\FormRequestAnalyzerContract;

it('takes a form request and returns an array of tokenized rules', function () {
    class DoesThingsFormRequest extends \Illuminate\Foundation\Http\FormRequest
    {
        public function rules()
        {
            return [
                'test' => 'required|integer',
            ];
        }
    }

    $analyzer = app(FormRequestAnalyzerContract::class);
    $tokenizedRules = $analyzer->analyze(DoesThingsFormRequest::class);

    expect($tokenizedRules)->toBeArray();
    expect($tokenizedRules)->toHaveCount(1);
    expect($tokenizedRules[0])->toBeInstanceOf(\Swarley\Squabble\FormRequest\FormRequestProperty::class);

    $rules = $tokenizedRules[0]->getRules();
    expect($rules[0])->toBeInstanceOf(\Swarley\Squabble\FormRequest\Rules\RequiredRule::class);
});
