<?php

use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

describe('BarcodeInput Unit Tests', function () {
    describe('Creation and Basic Configuration', function () {
        it('creates a barcode input instance', function () {
            $component = BarcodeInput::make('barcode');

            expect($component)->toBeInstanceOf(BarcodeInput::class);
        });

        it('returns the correct name', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getName())->toBe('barcode');
        });

        it('has correct view', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getView())->toBe('filament-barcode-scanner-field::components.barcode-input');
        });
    });

    describe('Icon Configuration', function () {
        it('adds icon to extra attributes via icon method', function () {
            $component = BarcodeInput::make('barcode')
                ->icon('heroicon-o-sparkles');

            $attributes = $component->getExtraAttributes();
            expect($attributes['icon'])->toBe('heroicon-o-sparkles');
        });

        it('returns static instance for method chaining', function () {
            $component = BarcodeInput::make('barcode');
            $result = $component->icon('heroicon-o-sparkles');

            expect($result)->toBeInstanceOf(BarcodeInput::class);
            expect($result)->toBe($component);
        });

        it('supports multiple icon changes', function () {
            $component = BarcodeInput::make('barcode')
                ->icon('heroicon-o-sparkles')
                ->icon('heroicon-o-check-circle');

            $attributes = $component->getExtraAttributes();
            expect($attributes['icon'])->toBe('heroicon-o-check-circle');
        });

        it('icon method preserves other extra attributes', function () {
            $component = BarcodeInput::make('barcode')
                ->icon('heroicon-o-sparkles');

            $attributes = $component->getExtraAttributes();
            expect($attributes)
                ->toHaveKey('icon', 'heroicon-o-sparkles');
        });
    });

    describe('Placeholder Setup', function () {
        it('sets placeholder from label', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode');

            expect($component->getPlaceholder())->toContain('barcode');
        });

        it('sets placeholder from name when no label', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getPlaceholder())->toContain('barcode');
        });

        it('converts label to lowercase in placeholder', function () {
            $component = BarcodeInput::make('code')
                ->label('Code');

            $placeholder = $component->getPlaceholder();
            expect($placeholder)->toBe('Enter code...');
        });

        it('can override placeholder', function () {
            $component = BarcodeInput::make('barcode')
                ->placeholder('Custom placeholder');

            expect($component->getPlaceholder())->toBe('Custom placeholder');
        });
    });

    describe('Fluent API', function () {
        it('supports chaining multiple configuration methods', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->required()
                ->disabled()
                ->icon('heroicon-o-qr-code');

            expect($component->getName())->toBe('barcode');
            expect($component->getLabel())->toBe('Barcode');
            expect($component->isRequired())->toBeTrue();
            expect($component->isDisabled())->toBeTrue();
            expect($component->getExtraAttributes()['icon'])->toBe('heroicon-o-qr-code');
        });
    });

    describe('TextInput Inheritance', function () {
        it('inherits TextInput properties', function () {
            $component = BarcodeInput::make('barcode');

            expect(method_exists($component, 'placeholder'))->toBeTrue();
            expect(method_exists($component, 'required'))->toBeTrue();
            expect(method_exists($component, 'disabled'))->toBeTrue();
            expect(method_exists($component, 'label'))->toBeTrue();
        });

        it('supports TextInput configuration methods', function () {
            $component = BarcodeInput::make('barcode')
                ->minLength(3)
                ->maxLength(50);

            expect($component->getMinLength())->toBe(3);
            expect($component->getMaxLength())->toBe(50);
        });

        it('applies TextInput validation rules', function () {
            $component = BarcodeInput::make('barcode')
                ->required()
                ->minLength(5)
                ->email();

            expect($component->isRequired())->toBeTrue();
            expect($component->getMinLength())->toBe(5);
        });
    });

    describe('Htmlable Label Handling', function () {
        it('handles string labels correctly', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Simple Label');

            expect($component->getLabel())->toBe('Simple Label');
        });
    });

    describe('Extra Attributes Management', function () {
        it('gets extra attributes', function () {
            $component = BarcodeInput::make('barcode')
                ->extraAttributes(['data-test' => 'value']);

            $attributes = $component->getExtraAttributes();
            expect($attributes['data-test'])->toBe('value');
        });

        it('merges icon into extra attributes', function () {
            $component = BarcodeInput::make('barcode')
                ->extraAttributes(['class' => 'custom-class'])
                ->icon('heroicon-o-pencil');

            $attributes = $component->getExtraAttributes();
            expect($attributes)->toHaveKey('icon', 'heroicon-o-pencil');
        });
    });
});

