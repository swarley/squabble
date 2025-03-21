<?php

it('takes a form request and returns a typescript interface', function () {
    class DoesThingsFormRequest extends \Illuminate\Foundation\Http\FormRequest
    {
        public function rules()
        {
            return [
                'test' => 'required|integer|nullable',
                'foo' => ['sometimes', 'boolean'],
            ];
        }
    }

    $output = \Swarley\Squabble\FormRequest\FormRequestTypeEmitter::emitFormRequestType(DoesThingsFormRequest::class);
});
