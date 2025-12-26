<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Marcelorodrigo\FilamentBarcodeScannerField\Commands\FilamentBarcodeScannerFieldCommand;
use Marcelorodrigo\FilamentBarcodeScannerField\Testing\TestsFilamentBarcodeScannerField;

class FilamentBarcodeScannerFieldServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-barcode-scanner-field';

    public static string $viewNamespace = 'filament-barcode-scanner-field';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('marcelorodrigo/filament-barcode-scanner-field');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-barcode-scanner-field/{$file->getFilename()}"),
                ], 'filament-barcode-scanner-field-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentBarcodeScannerField);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'marcelorodrigo/filament-barcode-scanner-field';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-barcode-scanner-field', __DIR__ . '/../resources/dist/components/filament-barcode-scanner-field.js'),
            // Css::make('filament-barcode-scanner-field-styles', __DIR__ . '/../resources/dist/filament-barcode-scanner-field.css'),
            // Js::make('filament-barcode-scanner-field-scripts', __DIR__ . '/../resources/dist/filament-barcode-scanner-field.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentBarcodeScannerFieldCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_filament-barcode-scanner-field_table',
        ];
    }
}
