<?php

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Swarley\Squabble\Attributes\SquabbleRequest;
use Swarley\Squabble\Attributes\SquabbleResponse;
use Swarley\Squabble\Facades\Squabble;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('knows all routes in a specific namespace', function () {
    config(['squabble.namespace' => 'test-namespace.*']);
    $routes = Squabble::getRoutes();

    expect($routes)->toHaveCount(1);
});
