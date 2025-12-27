<?php

use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

describe('BarcodeInput Validation', function () {
    describe('Required Validation', function () {
        it('creates component with required validation', function () {
            $component = BarcodeInput::make('barcode')
                ->required();

            expect($component->isRequired())->toBeTrue();
        });

        it('validates minLength configuration', function () {
            $component = BarcodeInput::make('barcode')
                ->minLength(5);

            expect($component->getMinLength())->toBe(5);
        });

        it('validates maxLength configuration', function () {
            $component = BarcodeInput::make('barcode')
                ->maxLength(50);

            expect($component->getMaxLength())->toBe(50);
        });

        it('accepts various barcode format specifications', function () {
            $patterns = [5, 10, 20, 50];

            foreach ($patterns as $length) {
                $component = BarcodeInput::make('barcode')
                    ->maxLength($length);

                expect($component->getMaxLength())->toBe($length);
            }
        });
    });

    describe('Data Persistence', function () {
        it('maintains component name through configurations', function () {
            $component = BarcodeInput::make('persistent_barcode');

            expect($component->getName())->toBe('persistent_barcode');
        });

        it('maintains label through multiple method calls', function () {
            $component = BarcodeInput::make('barcode');

            $component->label('Barcode');
            expect($component->getLabel())->toBe('Barcode');

            $component->required();
            expect($component->getLabel())->toBe('Barcode');

            $component->disabled();
            expect($component->getLabel())->toBe('Barcode');
        });
    });

    describe('Field States', function () {

        it('supports readonly state', function () {
            $component = BarcodeInput::make('barcode')
                ->readOnly();

            expect($component->isReadOnly())->toBeTrue();
        });

        it('supports required state', function () {
            $component = BarcodeInput::make('barcode')
                ->required();

            expect($component->isRequired())->toBeTrue();
        });
    });

    describe('Special Characters', function () {
        it('supports alphanumeric field names', function () {
            $component = BarcodeInput::make('barcode123');

            expect($component->getName())->toBe('barcode123');
        });

        it('supports underscore in field names', function () {
            $component = BarcodeInput::make('product_barcode');

            expect($component->getName())->toBe('product_barcode');
        });

        it('supports camelCase field names', function () {
            $component = BarcodeInput::make('productBarcode');

            expect($component->getName())->toBe('productBarcode');
        });

        it('supports custom labels with special characters', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode / SKU');

            expect($component->getLabel())->toBe('Barcode / SKU');
        });
    });

    describe('Configuration Flexibility', function () {
        it('allows multiple validation rules', function () {
            $component = BarcodeInput::make('barcode')
                ->required()
                ->minLength(3)
                ->maxLength(100);

            expect($component->isRequired())->toBeTrue()
                ->and($component->getMinLength())->toBe(3)
                ->and($component->getMaxLength())->toBe(100);
        });

        it('allows overriding previous configuration', function () {
            $component = BarcodeInput::make('barcode')
                ->minLength(5)
                ->minLength(10);

            expect($component->getMinLength())->toBe(10);
        });

        it('combines state settings correctly', function () {
            $component = BarcodeInput::make('barcode')
                ->required()
                ->readOnly();

            expect($component->isRequired())->toBeTrue()
                ->and($component->isReadOnly())->toBeTrue();
        });
    });
});
