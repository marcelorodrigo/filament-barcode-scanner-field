<?php

use Marcelorodrigo\FilamentBarcodeScannerField\Tests\Livewire\TestBarcodeFormComponent;

use function Pest\Livewire\livewire;

describe('BarcodeInput Integration Tests', function () {
    describe('Component Rendering', function () {
        it('renders the form component successfully', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk();
        });

        it('renders barcode input field with correct type', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('type="text"', false);
        });

        it('renders input with wire:model binding', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('wire:model="barcode"', false)
                ->assertSee('wire:model="productCode"', false);
        });

        it('renders input with correct id attribute', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('id="form.barcode"', false)
                ->assertSee('id="form.productCode"', false);
        });

        it('renders barcode input with label', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('Barcode')
                ->assertSee('Product Code');
        });

        it('renders required field indicator', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('required="required"', false);
        });
    });

    describe('CSS Classes', function () {
        it('renders icon with CSS class', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('fi-barcode-scanner-icon', false);
        });

        it('renders input with full width class', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('w-full', false);
        });

        it('renders icon button with flex layout', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('flex items-center justify-center', false);
        });

        it('renders input with padding for icon', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('pr-10', false);
        });
    });

    describe('Modal Structure', function () {
        it('renders modal with correct ID based on field name', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('id="qrcode-scanner-modal-barcode"', false)
                ->assertSee('id="qrcode-scanner-modal-productCode"', false);
        });

        it('renders modal header with scan label', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('Scan Barcode')
                ->assertSee('Scan Product Code');
        });

        it('renders scanner container div', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('id="reader-barcode"', false)
                ->assertSee('id="reader-productCode"', false);
        });

        it('renders close button in modal', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('Close');
        });

        it('renders modal with correct ARIA attributes', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('aria-modal="true"', false)
                ->assertSee('role="dialog"', false);
        });
    });

    describe('Icon Rendering', function () {
        it('renders icon button with correct aria-label', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('aria-label="Scan QrCode"', false);
        });

        it('renders icon as SVG element', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('<svg', false)
                ->assertSee('</svg>', false);
        });

        it('renders icon button with correct styling', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('text-gray-400', false);
        });
    });

    describe('Alpine.js Integration', function () {
        it('renders x-data attribute for Alpine component', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('x-data', false);
        });

        it('renders x-load-js attribute for QR scanner library', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('x-load-js', false)
                ->assertSee('html5-qrcode', false);
        });

        it('renders x-on directive for modal events', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('x-on:close-modal', false);
        });

        it('renders Alpine methods in x-data', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('openScannerModal', false)
                ->assertSee('closeScannerModal', false)
                ->assertSee('onScanSuccess', false);
        });
    });

    describe('Form Integration', function () {
        it('renders within Filament form wrapper', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('fi-fo-text-input-wrp', false);
        });

        it('renders input wrapper with suffix slot', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('fi-input-wrp-suffix', false);
        });

        it('renders wire:model binding attribute', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('wire:model', false);
        });

        it('renders with Filament input styling', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('fi-input', false);
        });
    });

    describe('Accessibility', function () {
        it('renders input with id attribute', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('id="form.', false);
        });

        it('renders button with type attribute', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('type="button"', false);
        });

        it('renders form with submit button', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('type="submit"', false)
                ->assertSee('Submit');
        });

        it('renders labels for form fields', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('for="form.barcode"', false)
                ->assertSee('for="form.productCode"', false);
        });
    });

    describe('Multiple Instances', function () {
        it('renders multiple barcode inputs independently', function () {
            $component = livewire(TestBarcodeFormComponent::class)
                ->assertOk();

            // Should have two different input fields with wire:model
            $component->assertSee('wire:model="barcode"', false)
                ->assertSee('wire:model="productCode"', false);

            // Should have two different modals
            $component->assertSee('qrcode-scanner-modal-barcode', false)
                ->assertSee('qrcode-scanner-modal-productCode', false);
        });

        it('renders separate scanner containers for each instance', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('id="reader-barcode"', false)
                ->assertSee('id="reader-productCode"', false);
        });

        it('renders separate Alpine x-data contexts', function () {
            livewire(TestBarcodeFormComponent::class)
                ->assertOk()
                ->assertSee('qrcode-scanner-modal-barcode', false)
                ->assertSee('qrcode-scanner-modal-productCode', false);
        });
    });
});
