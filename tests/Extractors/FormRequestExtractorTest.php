<?php

it('does things', function () {
   class DoesThingsFormRequest extends \Illuminate\Foundation\Http\FormRequest {
         public function rules() {
              return [
                  'test' => 'required'
              ];
         }
   }

   $extractor = new \Swarley\Squabble\Extractors\FormRequestAttributeExtractor(DoesThingsFormRequest::class);
   $extractor->extract();
});
