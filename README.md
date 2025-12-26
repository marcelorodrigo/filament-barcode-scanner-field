# Filament Barcode Scanner Input Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marcelorodrigo/filament-barcode-scanner-field.svg?style=flat-square)](https://packagist.org/packages/marcelorodrigo/filament-barcode-scanner-field)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/marcelorodrigo/filament-barcode-scanner-field/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/marcelorodrigo/filament-barcode-scanner-field/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/marcelorodrigo/filament-barcode-scanner-field/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/marcelorodrigo/filament-barcode-scanner-field/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/marcelorodrigo/filament-barcode-scanner-field.svg?style=flat-square)](https://packagist.org/packages/marcelorodrigo/filament-barcode-scanner-field)

The Filament Barcode Scanner Input package offers a user-friendly barcode input field for your Filament applications. This component supports dynamic scanning, enabling users to input barcodes seamlessly. With a modal popup interface and customizable icons, the Filament Barcode Scanner Input package ensures an efficient and aesthetically pleasing user experience for barcode entry in your application.

## Features

- **Modal Popup**: The component opens a modal popup for barcode scanning, providing a dedicated interface for users to scan and input barcodes without cluttering the main form.
- **Customizable Icon**: Users can customize the input field with their own Heroicons, enhancing the visual appeal and allowing for better integration with existing designs.
- **Responsive Design**: Optimized for use on various devices, ensuring a seamless experience across desktop and mobile.
- **Easy Integration**: Simple to integrate into your existing Filament forms with minimal configuration.

You can install the package via composer:

```bash
composer require marcelorodrigo/filament-barcode-scanner-field
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-barcode-scanner-field-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-barcode-scanner-field-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

Once installed, you can use the BarcodeInput component in your Filament forms:

```php
use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

// In your form definition
BarcodeInput::make('barcode')
    ->icon('heroicon-o-arrow-right') // Specify your Heroicon name here
    ->required(),
```

### Available Options

- `icon()` - Set a custom [Heroicon](https://heroicons.com/) for the input field (e.g., `'heroicon-o-arrow-right'`, `'heroicon-o-qrcode'`)
- `required()` - Make the barcode input required
- All standard Filament field methods are supported

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Marcelo Wiebbelling](https://github.com/marcelorodrigo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
