<?php

namespace Swarley\Squabble;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Swarley\Squabble\Commands\SquabbleCommand;
use Swarley\Squabble\Contracts\FormRequestAnalyzerContract;
use Swarley\Squabble\Contracts\FormRequestRuleResolverContract;
use Swarley\Squabble\FormRequest\FormRequestRuleResolver;
use Swarley\Squabble\FormRequestAnalyzer\FormRequestAnalyzer;

class SquabbleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('squabble')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_squabble_table')
            ->hasCommand(SquabbleCommand::class);
    }

    public function packageBooted()
    {
        app()->bind(FormRequestRuleResolverContract::class, FormRequestRuleResolver::class);
        app()->bind(FormRequestAnalyzerContract::class, FormRequestAnalyzer::class);
    }
}
