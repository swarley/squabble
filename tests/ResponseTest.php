<?php

use Illuminate\Http\JsonResponse;
use Swarley\Squabble\Attributes\SquabbleResponse;
use Swarley\Squabble\Facades\Squabble;

it('knows what response is used for a route', function () {
    class TestKnowsResponse extends JsonResponse {};

    $route = Route::get('test', fn (): TestKnowsResponse => null);

    $formRequest = Squabble::getResponseFromRoute($route);

    expect($formRequest)->toBe(TestKnowsResponse::class);
});

// Is this actually a good thing?
it('knows what response is used for a route with a union type', function () {
    class TestKnowsUnionResponse extends JsonResponse {};
    class ExtraUnionClass {};

    $route = Route::get('test', fn (): TestKnowsUnionResponse|ExtraUnionClass => null);

    $formRequest = Squabble::getResponseFromRoute($route);

    expect($formRequest)->toBe(TestKnowsUnionResponse::class);
});


it('knows when a response has been specified via an attribute', function () {
    class TestKnowsAttributeResponse extends JsonResponse {};

    $route = Route::get('test', #[SquabbleResponse(TestKnowsAttributeResponse::class)] fn () => null);

    $formRequest = Squabble::getResponseFromRoute($route);

    expect($formRequest)->toBe(TestKnowsAttributeResponse::class);
});
