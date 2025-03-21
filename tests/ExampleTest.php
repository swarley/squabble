<?php

use Swarley\Squabble\Facades\Squabble;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('knows all routes in a specific namespace', function () {
    config(['squabble.namespace' => 'test-namespace.*']);
    $routes = Squabble::getRoutes();

    expect($routes)->toHaveCount(1);
});
