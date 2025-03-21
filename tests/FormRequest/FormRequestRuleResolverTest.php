<?php

it('resolves rules based on strings', function () {
    class TestResolveStringFormRequest extends \Illuminate\Foundation\Http\FormRequest {
        public function rules() {
            return [
                'test' => 'required'
            ];
        }
    }


});
