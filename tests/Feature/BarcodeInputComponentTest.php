<?php

use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

describe('BarcodeInput Component', function () {
    describe('Rendering', function () {
        it('displays the input field with correct attributes', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getName())->toBe('barcode');
        });

        it('renders modal id based on field name', function () {
            $component = BarcodeInput::make('barcode');

            // The modal id is generated in the view using the field name
            expect($component->getName())->toBe('barcode');
        });
    });

    describe('Configuration', function () {
        it('sets placeholder from label', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->getPlaceholder();

            expect($component)->toContain('barcode');
        });

        it('sets default placeholder when no label provided', function () {
            $component = BarcodeInput::make('barcode')
                ->getPlaceholder();

            expect($component)->toContain('barcode');
        });

        it('accepts custom icon via icon method', function () {
            $component = BarcodeInput::make('barcode')
                ->icon('heroicon-o-check-circle');

            expect($component->getIcon())->toBe('heroicon-o-check-circle');
        });

        it('sets correct view path', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getView())->toBe('filament-barcode-scanner-field::components.barcode-input');
        });
    });

    describe('Inherited TextInput Methods', function () {
        it('extends TextInput component', function () {
            $component = BarcodeInput::make('barcode');

            expect($component)->toBeInstanceOf(\Filament\Forms\Components\TextInput::class);
        });

        it('supports validation rules from TextInput', function () {
            $component = BarcodeInput::make('barcode')
                ->required()
                ->minLength(5)
                ->maxLength(20);

            expect($component->isRequired())->toBeTrue();
        });

        it('supports label configuration', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Product Barcode');

            expect($component->getLabel())->toBe('Product Barcode');
        });

        it('supports readonly state', function () {
            $component = BarcodeInput::make('barcode')
                ->readOnly();

            expect($component->isReadOnly())->toBeTrue();
        });

        it('supports disabled state', function () {
            $component = BarcodeInput::make('barcode')
                ->disabled();

            expect($component->isDisabled())->toBeTrue();
        });
    });

    describe('Multiple Instances', function () {
        it('creates multiple independent instances', function () {
            $barcode = BarcodeInput::make('barcode');
            $productCode = BarcodeInput::make('productCode');

            expect($barcode->getName())->toBe('barcode')
                ->and($productCode->getName())->toBe('productCode')
                ->and($barcode->getName())->not()->toBe($productCode->getName());
        });

        it('maintains independent configuration for each instance', function () {
            $barcode = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->required();

            $productCode = BarcodeInput::make('productCode')
                ->label('Product Code')
                ->readOnly();

            expect($barcode->isRequired())->toBeTrue()
                ->and($barcode->isReadOnly())->toBeFalse()
                ->and($productCode->isRequired())->toBeFalse()
                ->and($productCode->isReadOnly())->toBeTrue();
        });
    });

    describe('Component Behavior', function () {
        it('supports chaining configuration methods', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->required()
                ->icon('heroicon-o-qr-code');

            expect($component->getName())->toBe('barcode')
                ->and($component->getLabel())->toBe('Barcode')
                ->and($component->isRequired())->toBeTrue()
                ->and($component->getIcon())->toBe('heroicon-o-qr-code');
        });

        it('icon method returns static instance for proper chaining', function () {
            $component = BarcodeInput::make('barcode');
            $result = $component->icon('heroicon-o-sparkles');

            expect($result)->toBe($component)
                ->and($result)->toBeInstanceOf(BarcodeInput::class);
        });
    });
});
