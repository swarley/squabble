<?php

namespace Swarley\Squabble\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;
use Swarley\Squabble\SquabbleServiceProvider;
use Swarley\Squabble\Test\Controller;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Swarley\\Squabble\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            SquabbleServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }

    public function defineRoutes($router)
    {
        Route::name('test-namespace.')->group(function () {
            Route::get('test-route')->name('test-route');
        });

        Route::name('api.')->group(function () {
            Route::get('foo', [Controller::class, 'foo'])->name('foo');
        });
    }
}
