# Copilot Instructions

- Big picture: Laravel/Filament 4 form-field package scaffold; most logic is placeholders. Wire new field behavior through [src/FilamentBarcodeScannerFieldServiceProvider.php](../src/FilamentBarcodeScannerFieldServiceProvider.php) and fill the empty entry class [src/FilamentBarcodeScannerField.php](../src/FilamentBarcodeScannerField.php).
- Package wiring uses Spatie Package Tools: install command publishes config/migrations and prompts to run them; publishes stubs to `stubs/filament-barcode-scanner-field/*` when in console (`filament-barcode-scanner-field-stubs` tag).
- Assets: Filament asset registration is prepared but commented out in `getAssets()`. Build JS via esbuild at [bin/build.js](../bin/build.js) (`npm run build` / `npm run dev`); entry [resources/js/index.js](../resources/js/index.js) (currently empty) outputs to `resources/dist/filament-barcode-scanner-field.js`. CSS extends Filament theme in [resources/css/index.css](../resources/css/index.css).
- Icons/script data/routes: helper methods in the service provider return empty arrays; populate them when adding UI assets or endpoints. Asset package name is `marcelorodrigo/filament-barcode-scanner-field` for Filament registrations.
- Facade: [src/Facades/FilamentBarcodeScannerField.php](../src/Facades/FilamentBarcodeScannerField.php) resolves the entry class; extend the accessor when adding services.
- Testing: Pest with Orchestra Testbench; base setup in [tests/TestCase.php](../tests/TestCase.php) registers Filament/Livewire providers, uses `LazilyRefreshDatabase`, loads package migrations from [database/migrations](../database/migrations). Global Pest bootstrap in [tests/Pest.php](../tests/Pest.php).
- Testing guardrails: [tests/DebugTest.php](../tests/DebugTest.php) fails on use of `dd`, `dump`, or `ray`. Example smoke test in [tests/ExampleTest.php](../tests/ExampleTest.php).
- Livewire testing extension point: mixin placeholder [src/Testing/TestsFilamentBarcodeScannerField.php](../src/Testing/TestsFilamentBarcodeScannerField.php) is attached to Livewire `Testable` in `packageBooted()` for custom test helpers.
- Composer scripts: `composer test` (Pest), `composer lint` (Pint), `composer analyse` (PHPStan), `composer refactor` (Rector). PHP >= 8.2 required; Filament Forms v4 dependency.
- JS tooling: package.json is ESM; esbuild target `es2020`, `platform: neutral`, inline sourcemaps in dev, minified in build. Update `entryPoints`/`outfile` in [bin/build.js](../bin/build.js) if you add more bundles.
- Auto-discovery: service provider and facade registered via composer `extra.laravel`; no manual registration needed in host apps.
- Publishing config/views/translations/migrations is conditional on files existing in the package root; add resources under `resources/` or `database/migrations` to enable.
- When adding a Filament field component, remember to register its built Alpine component/CSS/JS through `getAssets()` and optionally `FilamentAsset::registerScriptData()` inside the service provider.
- Keep asset paths consistent with Filament conventions (`resources/dist/components/*` for Alpine components) if you uncomment the provided examples in `getAssets()`.
- For local package testing, rely on Testbench workbench setup from [tests/TestCase.php](../tests/TestCase.php); database defaults to `testing` connection.
