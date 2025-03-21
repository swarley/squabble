<?php

namespace Swarley\Squabble\FormRequest;

use Illuminate\Foundation\Http\FormRequest;
use Swarley\Squabble\FormRequestAnalyzer\FormRequestAnalyzer;

class FormRequestTypeEmitter
{
    /**
     * @param  class-string<FormRequest>  $formRequest
     */
    public static function emitFormRequestType(string $formRequest): string
    {
        $name = class_basename($formRequest);
        $output = "interface {$name} {\n";

        $analyzer = new FormRequestAnalyzer;
        $tokenizedRules = $analyzer->analyze($formRequest);

        foreach ($tokenizedRules as $property) {
            $propertyName = $property->getName();
            $nullable = $property->getNullable() ? ' | null' : '';
            $required = $property->getRequired() ? '' : '?';
            $output .= "  {$propertyName}{$required}: {$property->getType()}{$nullable};\n";
        }

        $output .= "}\n";

        return $output;
    }
}
