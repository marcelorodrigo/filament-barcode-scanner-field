<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentBarcodeScannerFieldServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-barcode-scanner-field';

    public static string $viewNamespace = 'filament-barcode-scanner-field';

    #[\Override]
    public function packageBooted(): void
    {
        FilamentAsset::register([
            Css::make('barcode-scanner-field', __DIR__ . '/../resources/css/barcode-scanner-field.css')->loadedOnRequest(),
        ], 'marcelorodrigo/filament-barcode-scanner-field');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */

        $package->name(static::$name)
            ->hasInstallCommand(function (InstallCommand $command): void {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('marcelorodrigo/filament-barcode-scanner-field');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath(sprintf('/../config/%s.php', $configFileName)))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }

        if (file_exists($package->basePath('/../resources/css'))) {
            $package->hasAssets();
        }
    }

    protected function getAssetPackageName(): ?string
    {
        return 'marcelorodrigo/filament-barcode-scanner-field';
    }
}
