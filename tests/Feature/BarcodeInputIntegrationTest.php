<?php

use Marcelorodrigo\FilamentBarcodeScannerField\Tests\Livewire\TestBarcodeFormComponent;

use function Pest\Livewire\livewire;

describe('BarcodeInput Integration Tests', function () {
    it('renders a text input with a numeric keyboard hint', function () {
        livewire(TestBarcodeFormComponent::class)
            ->assertOk()
            ->assertSee('type="text"', false)
            ->assertSee('inputmode="numeric"', false)
            ->assertSee('wire:model="barcode"', false);
    });

    it('renders native TextInput configuration', function () {
        livewire(TestBarcodeFormComponent::class)
            ->assertOk()
            ->assertSee('autocomplete="off"', false)
            ->assertSee('list="form.barcode-list"', false)
            ->assertSee('id="form.barcode-list"', false)
            ->assertSee('value="0123456789012"', false);
    });

    it('renders the scanner alongside configured suffix actions', function () {
        livewire(TestBarcodeFormComponent::class)
            ->assertOk()
            ->assertSee('scanBarcode', false)
            ->assertSee('customBarcodeAction', false);
    });

    it('renders the scanner in the native action modal', function () {
        livewire(TestBarcodeFormComponent::class)
            ->call('mountAction', 'scanBarcode', [], ['schemaComponent' => 'form.barcode'])
            ->assertOk()
            ->assertSet('mountedActions.0.name', 'scanBarcode')
            ->assertSet('mountedActions.0.context.schemaComponent', 'form.barcode');
    });

    it('renders scanner content that preserves leading zeroes', function () {
        $component = livewire(TestBarcodeFormComponent::class)
            ->call('mountAction', 'scanBarcode', [], ['schemaComponent' => 'form.barcode']);
        $scannerContent = $component->instance()->getMountedAction()->getModalContent();

        expect($scannerContent->render())
            ->toContain('reader-')
            ->toContain('html5-qrcode')
            ->toContain('$wire.set')
            ->toContain('form.barcode')
            ->toContain('decodedText');

        $component
            ->set('barcode', '0123456789012')
            ->assertSet('barcode', '0123456789012');
    });
});
