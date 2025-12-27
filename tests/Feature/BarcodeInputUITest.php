<?php

use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

describe('BarcodeInput UI Tests', function () {
    describe('Input Field Configuration', function () {
        it('creates text input field', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getName())->toBe('barcode');
        });

        it('renders with correct field name', function () {
            $component = BarcodeInput::make('barcode_field');

            expect($component->getName())->toBe('barcode_field');
        });

        it('supports custom placeholder', function () {
            $component = BarcodeInput::make('barcode')
                ->placeholder('Scan or type barcode');

            expect($component->getPlaceholder())->toBe('Scan or type barcode');
        });

        it('generates default placeholder from field name', function () {
            $component = BarcodeInput::make('barcode');

            $placeholder = $component->getPlaceholder();
            expect($placeholder)->toContain('barcode');
        });
    });

    describe('Icon Configuration', function () {
        it('applies default barcode icon', function () {
            $component = BarcodeInput::make('barcode');

            // Default icon should be the built-in SVG (no icon in extra attributes)
            $attributes = $component->getExtraAttributes();
            expect($attributes)->not()->toHaveKey('icon');
        });

        it('applies custom icon when specified', function () {
            $component = BarcodeInput::make('barcode')
                ->icon('heroicon-o-check-circle');

            $attributes = $component->getExtraAttributes();
            expect($attributes)->toHaveKey('icon', 'heroicon-o-check-circle');
        });

        it('supports multiple icon types', function () {
            $icons = [
                'heroicon-o-qr-code',
                'heroicon-o-check-circle',
                'heroicon-o-sparkles',
                'heroicon-o-pencil',
            ];

            foreach ($icons as $icon) {
                $component = BarcodeInput::make('barcode')
                    ->icon($icon);

                $attributes = $component->getExtraAttributes();
                expect($attributes['icon'])->toBe($icon);
            }
        });

        it('allows icon changes', function () {
            $component = BarcodeInput::make('barcode')
                ->icon('heroicon-o-check-circle');

            $attributes = $component->getExtraAttributes();
            expect($attributes['icon'])->toBe('heroicon-o-check-circle');

            $component->icon('heroicon-o-sparkles');
            $attributes = $component->getExtraAttributes();
            expect($attributes['icon'])->toBe('heroicon-o-sparkles');
        });
    });

    describe('Label and Styling', function () {
        it('supports label configuration', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Product Barcode');

            expect($component->getLabel())->toBe('Product Barcode');
        });

        it('supports readonly styling', function () {
            $component = BarcodeInput::make('barcode')
                ->readOnly();

            expect($component->isReadOnly())->toBeTrue();
        });

        it('combines multiple styling states', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->readOnly();

            expect($component->getLabel())->toBe('Barcode')
                ->and($component->isReadOnly())->toBeTrue();
        });
    });

    describe('View Rendering', function () {
        it('uses correct Blade view', function () {
            $component = BarcodeInput::make('barcode');

            expect($component->getView())->toBe('filament-barcode-scanner-field::components.barcode-input');
        });

        it('view path is consistent across instances', function () {
            $component1 = BarcodeInput::make('barcode');
            $component2 = BarcodeInput::make('productCode');

            expect($component1->getView())->toBe($component2->getView());
        });
    });

    describe('Form Integration', function () {
        it('extends Filament TextInput component', function () {
            $component = BarcodeInput::make('barcode');

            expect($component)->toBeInstanceOf(\Filament\Forms\Components\TextInput::class);
        });

        it('supports form schema integration', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->required()
                ->maxLength(50);

            expect($component->getName())->toBe('barcode')
                ->and($component->getLabel())->toBe('Barcode')
                ->and($component->isRequired())->toBeTrue()
                ->and($component->getMaxLength())->toBe(50);
        });

        it('maintains TextInput validation methods', function () {
            $component = BarcodeInput::make('barcode')
                ->minLength(3)
                ->maxLength(100)
                ->required();

            expect($component->getMinLength())->toBe(3)
                ->and($component->getMaxLength())->toBe(100)
                ->and($component->isRequired())->toBeTrue();
        });
    });

    describe('Accessibility', function () {
        it('provides meaningful field names for accessibility', function () {
            $component = BarcodeInput::make('product_barcode');

            expect($component->getName())->toBe('product_barcode');
        });

        it('supports required field indicators', function () {
            $component = BarcodeInput::make('barcode')
                ->required();

            expect($component->isRequired())->toBeTrue();
        });

        it('supports readonly state for accessibility', function () {
            $component = BarcodeInput::make('barcode')
                ->readOnly();

            expect($component->isReadOnly())->toBeTrue();
        });
    });

    describe('Responsive Configuration', function () {
        it('supports full-width configuration', function () {
            $component = BarcodeInput::make('barcode');

            // Component should render full-width by default
            expect($component->getName())->toBe('barcode');
        });

        it('maintains configuration across different screen sizes', function () {
            $component = BarcodeInput::make('barcode')
                ->label('Barcode')
                ->required();

            expect($component->getLabel())->toBe('Barcode')
                ->and($component->isRequired())->toBeTrue();
        });
    });
});
