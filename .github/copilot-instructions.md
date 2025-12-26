# Copilot Instructions

## Project Overview
This is a **Laravel/Filament 4 Barcode Scanner Field** package. It provides a reusable form field component (`BarcodeInput`) that integrates barcode scanning functionality via ZXing library with a modal interface into Filament forms.

## Architecture & Key Files

### Entry Point & Core
- **[src/FilamentBarcodeScannerField.php](../src/FilamentBarcodeScannerField.php)**: Empty class that serves as the facade accessor; extend when adding core services.
- **[src/FilamentBarcodeScannerFieldServiceProvider.php](../src/FilamentBarcodeScannerFieldServiceProvider.php)**: Spatie Package Tools service provider. Configures asset registration, commands, stubs, and Livewire test mixins. Package asset name is `marcelorodrigo/filament-barcode-scanner-field`.

### Form Components
- **[src/Forms/Components/BarcodeInput.php](../src/Forms/Components/BarcodeInput.php)**: Main Filament form field component extending `TextInput`. Implements barcode input with optional custom icon via `icon()` method. Uses view `barcode-field::components.barcode-input`.

### Assets & Frontend
- **JavaScript**: Entry point at [resources/js/index.js](../resources/js/index.js) — currently implements barcode scanning logic using ZXing library:
  - `openScannerModal()`: Dispatches Filament modal open event
  - `closeScannerModal()`: Closes modal and stops scanning
  - `startScanner()`: Decodes barcode from video device
  - Additional helpers for camera enumeration and UI feedback
- **CSS**: [resources/css/index.css](../resources/css/index.css) imports Filament theme
- **Build**: esbuild configured in [bin/build.js](../bin/build.js); run `npm run dev` (watch + inline sourcemaps) or `npm run build` (minified) to compile JS to `resources/dist/filament-barcode-scanner-field.js`
- **Asset Registration**: Currently registers JS asset in `getAssets()` via `Js::make()`. Commented AlpineComponent examples available.

### Configuration & Publishing
- **Config**: [config/barcode-scanner-field.php](../config/barcode-scanner-field.php) (currently empty)
- **Language**: Translation files in [resources/lang/en](../resources/lang/en) (published as `filament-barcode-scanner-field`)
- **Views**: Views directory at [resources/views](../resources/views) with `components/` subdirectory for field templates (published as `filament-barcode-scanner-field`)
- **Stubs**: Directory [stubs](../stubs) publishes to `stubs/filament-barcode-scanner-field/*` when in console
- **Install Command**: Via Spatie Package Tools; publishes config, migrations, and stubs; asks to run migrations and star repo

### Facade
- **[src/Facades/FilamentBarcodeScannerField.php](../src/Facades/FilamentBarcodeScannerField.php)**: Resolves the main `FilamentBarcodeScannerField` class. Extend when adding new public services.

## Testing Setup

- **Framework**: Pest with Orchestra Testbench (`pestphp/pest`, `pestphp/pest-plugin-laravel`, `pestphp/pest-plugin-livewire`)
- **Base Setup**: [tests/TestCase.php](../tests/TestCase.php)
  - Registers Filament & Livewire providers (FilamentServiceProvider, FormsServiceProvider, LivewireServiceProvider, etc.)
  - Uses `LazilyRefreshDatabase` trait
  - Factory discovery configured for package namespace
  - Workbench support via `WithWorkbench`
- **Global Pest Config**: [tests/Pest.php](../tests/Pest.php) applies TestCase to all tests in `__DIR__`
- **Guardrails**: [tests/DebugTest.php](../tests/DebugTest.php) fails on use of `dd`, `dump`, or `ray`
- **Example**: [tests/ExampleTest.php](../tests/ExampleTest.php) — basic smoke test
- **Livewire Test Mixin**: [src/Testing/TestsFilamentBarcodeScannerField.php](../src/Testing/TestsFilamentBarcodeScannerField.php) (currently empty) attached to Livewire `Testable` in `packageBooted()` for custom test helpers

## Available Composer Scripts
- `composer test`: Run Pest
- `composer lint`: Run Pint (code style)
- `composer test:lint`: Test code style without fixing
- `composer analyse`: Run PHPStan (static analysis)
- `composer refactor`: Run Rector (code refactoring)
- `composer test:refactor`: Run Rector in dry-run mode

## Composer & NPM Configurations
- **PHP**: ^8.2
- **Filament**: Forms ^4.0
- **Spatie Package Tools**: ^1.15.0
- **Dev Dependencies**: PHPStan, Pint, Rector, Pest, Livewire testing plugins, Orchestra Testbench ^10.0, Blade UI Kit, Laravel Ray
- **NPM**: ESM mode; esbuild ^0.25.5, Prettier ^3.5.3
- **esbuild**: Target `es2020`, `platform: neutral`, inline sourcemaps in dev, minified in production, tree-shaking enabled

## Empty/Placeholder Helper Methods
The following methods in the service provider return empty arrays; populate when extending functionality:
- `getIcons()`: Return icon registrations for FilamentIcon
- `getRoutes()`: Return route definitions if adding endpoints
- `getScriptData()`: Return script data for FilamentAsset::registerScriptData()
- `getMigrations()`: Return migration files (currently empty, no migrations used)
- `getCommands()`: Returns empty (no custom commands currently)
- For local package testing, rely on Testbench workbench setup from [tests/TestCase.php](../tests/TestCase.php); database defaults to `testing` connection.
