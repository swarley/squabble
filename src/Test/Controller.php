<?php

namespace Swarley\Squabble\Test;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

class Controller
{
    public function show(FormRequest $request, Model $routeThing): JsonResource
    {
        return new JsonResource($routeThing);
    }
}
