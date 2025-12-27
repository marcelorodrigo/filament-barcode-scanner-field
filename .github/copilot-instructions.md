# Copilot Instructions

## Project Overview
This is a **Laravel/Filament 4 Barcode Scanner Field** package. It provides a reusable form field component (`BarcodeInput`) that integrates barcode scanning functionality via ZXing library with a modal interface into Filament forms.

## Architecture & Key Files


### Assets & Frontend
  - Additional helpers for camera enumeration and UI feedback
- **CSS**: [resources/css/index.css](../resources/css/index.css) imports Filament theme
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
  - Factory discovery configured for package namespace
  - Workbench support via `WithWorkbench`

## Available Composer Scripts
- `composer analyse`: Run PHPStan (static analysis)
- `composer refactor`: Run Rector (code refactoring)

## Composer & NPM Configurations
- **NPM**: ESM mode; esbuild ^0.25.5, Prettier ^3.5.3
- **esbuild**: Target `es2020`, `platform: neutral`, inline sourcemaps in dev, minified in production, tree-shaking enabled
The following methods in the service provider return empty arrays; populate when extending functionality:
- `getIcons()`: Return icon registrations for FilamentIcon
- `getRoutes()`: Return route definitions if adding endpoints
- `getScriptData()`: Return script data for FilamentAsset::registerScriptData()
- `getMigrations()`: Return migration files (currently empty, no migrations used)
- `getCommands()`: Returns empty (no custom commands currently)
- For local package testing, rely on Testbench workbench setup from [tests/TestCase.php](../tests/TestCase.php); database defaults to `testing` connection.

## Versioning & Commits
- This project uses semver.org for versioning.
- Follow Conventional Commits specification for commit messages.
