<?php

it('knows what form request is used for a route', function () {
    class TestKnowsRequest extends FormRequest {}

    $route = Route::get('test', function ($notRequest, TestKnowsRequest $req) {});

    $formRequest = Squabble::getRequestFromRoute($route);

    expect($formRequest)->toBe(TestKnowsRequest::class);
});

// Is this actually a good thing?
it('knows what form request is used for a route with a union type', function () {
    class TestKnowsUnionRequest extends FormRequest {}
    class ExtraUnionClass {}

    $route = Route::get('test', function ($notRequest, TestKnowsUnionRequest|ExtraUnionClass $req) {});

    $formRequest = Squabble::getRequestFromRoute($route);

    expect($formRequest)->toBe(TestKnowsUnionRequest::class);
});

it('knows when a form request has been specified via an attribute', function () {
    class TestKnowsAttributeRequest extends FormRequest {}

    $route = Route::get('test', #[SquabbleRequest(TestKnowsAttributeRequest::class)] fn () => null);

    $formRequest = Squabble::getRequestFromRoute($route);

    expect($formRequest)->toBe(TestKnowsAttributeRequest::class);
});
