# AGENTS.md

## Build / Lint / Test Commands

```bash
# Run all tests
composer test

# Run tests (CI mode - faster, no coverage)
composer test:ci

# Run tests with coverage report
composer test:coverage

# Run a single test file
vendor/bin/pest tests/Unit/BarcodeInputTest.php

# Run tests matching a pattern
vendor/bin/pest --filter="creates a barcode input instance"

# Static analysis with PHPStan (level 4)
composer analyse

# Check code style
composer pint

# Fix code style automatically
composer pint:fix

# Run Rector (automatic refactoring)
composer refactor

# Dry-run Rector to see what would change
composer test:refactor

# Check code style in test mode (CI)
composer test:lint
```

## Code Style Guidelines

### General

- **PHP**: 8.3+ required
- **Namespace**: `Marcelorodrigo\FilamentBarcodeScannerField`
- **PSR-4 autoloading**: `src/` maps to namespace root

### Formatting (Laravel Pint)

Uses Laravel preset with custom rules in `pint.json`:

```json
{
  "preset": "laravel",
  "rules": {
    "blank_line_before_statement": true,
    "concat_space": {"spacing": "one"},
    "method_argument_space": true,
    "single_trait_insert_per_statement": true,
    "types_spaces": {"space": "single"}
  }
}
```

Key formatting rules:
- Concatenation: `string . ' text'` (space around dot)
- Types: `array<string, int>` (single space in generics)
- Always add blank line before statements
- One trait per `use` statement

### Imports & Namespaces

Order:
1. `declare(strict_types=1);` (if used)
2. `namespace` declaration
3. `use` statements (group by type: PHP built-in, external packages, internal)
4. Class definition

Example:
```php
<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components;

use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;

class BarcodeInput extends TextInput
{
    // ...
}
```

### Types & Type Declarations

- Always declare return types
- Use PHP 8+ union types where appropriate
- Use `static` return type for fluent methods that return `$this`
- Use `#[\Override]` attribute when overriding parent methods
- Nullable types: `?string` or `string|null`

Example:
```php
public function icon(string $icon): static
{
    return $this->extraAttributes(['icon' => $icon]);
}

protected function setUp(): void
{
    parent::setUp();
    // ...
}
```

### Naming Conventions

- **Classes**: `StudlyCase` (e.g., `BarcodeInput`, `FilamentBarcodeScannerFieldServiceProvider`)
- **Methods/Functions**: `camelCase` (e.g., `setUp()`, `configurePackage()`)
- **Properties**: `camelCase` (e.g., `$viewNamespace`)
- **Constants**: No constants used in this codebase
- **Test files**: Suffix with `Test.php` (e.g., `BarcodeInputTest.php`)
- **Test functions**: Descriptive lowercase with spaces (Pest style)

### Error Handling

- No try-catch blocks in this codebase
- Validation is handled through Filament's built-in validation system
- Type safety is preferred over defensive checks

### Testing (Pest)

Test structure:
```php
describe('Feature Group', function () {
    it('describes what the test does', function () {
        // Arrange
        $component = BarcodeInput::make('barcode');
        
        // Act & Assert
        expect($component)->toBeInstanceOf(BarcodeInput::class);
    });
});
```

- Tests use `describe()` blocks to group related tests
- Test names are descriptive sentences in lowercase
- Use Pest's `expect()` API for assertions
- Tests extend `TestCase` from `tests/TestCase.php`
- Test classes are in `tests/Unit/` and `tests/Feature/`

### Rector Configuration

Configured in `rector.php`:
- Dead code elimination
- Code quality improvements
- Coding style fixes
- Type declarations
- Privatization (where possible)
- Early returns
- PHP version upgrades

### Static Analysis (PHPStan)

- Level 4 analysis
- Includes Larastan for Laravel-specific rules
- Includes PHPUnit extension
- Includes deprecation rules
- Analyzes `src/` and `config/` directories
- Octane compatibility checks enabled
- Model properties checks enabled

### Filament-specific Patterns

- Form components extend Filament base classes (e.g., `TextInput`)
- Views use `filament-barcode-scanner-field::` namespace
- Components use fluent API pattern (return `static`)
- Extra attributes passed through `extraAttributes()` method
- Override `setUp()` for initialization (call `parent::setUp()` first)

### CSS & Asset Management

Package assets are managed via Filament's Asset Manager:

**Automatic CSS Loading:**
```php
// In service provider
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;

public function packageBooted(): void
{
    FilamentAsset::register([
        Css::make('barcode-scanner-field', __DIR__ . '/../resources/css/barcode-scanner-field.css')
            ->loadedOnRequest(),
    ], 'marcelorodrigo/filament-barcode-scanner-field');
}
```

**In Blade templates:**
```blade
<div x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('barcode-scanner-field', 'marcelorodrigo/filament-barcode-scanner-field'))]">
```

**Publishable Assets:**
Enable via `$package->hasAssets()` in `configurePackage()`. Users can customize:
```bash
php artisan vendor:publish --tag=filament-barcode-scanner-field-assets
```

**CSS Conventions:**
- Use `fi-` prefix for custom CSS classes (e.g., `.fi-barcode-scanner-icon`)
- CSS loads automatically when component is used (no manual include needed)
- Assets are located in `resources/css/`

### File Organization

```
src/
├── Forms/Components/       # Form components
├── Facades/               # Laravel facades
├── Testing/               # Testing traits
├── *.php                  # Service providers, main class

resources/
├── css/                   # CSS assets (auto-loaded via Filament Asset Manager)
├── lang/                  # Translation files
└── views/                 # Blade templates

tests/
├── Unit/                  # Unit tests (isolated components)
├── Feature/               # Feature/integration tests
├── Livewire/              # Test Livewire components
├── resources/views/       # Test views
├── TestCase.php           # Base test case
└── Pest.php               # Pest configuration
```

### Blade Views

- Located in `resources/views/components/`
- Use `x-load-js` for loading external JavaScript (Alpine.js pattern)
- Use `x-load-css` for loading package CSS via Filament Asset Manager
- Component views referenced via `static::$viewNamespace` (e.g., `filament-barcode-scanner-field::components.barcode-input`)
