<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components;

use Filament\Forms\Components\TextInput;

class BarcodeInput extends TextInput
{
    protected string $view = 'barcode-field::components.barcode-input'; // View namespaced correctly

    protected function setUp(): void
    {
        parent::setUp();

        // Set default properties for the BarcodeInput
        $this->label('Barcode Input')
            ->placeholder('Enter barcode...')
            ->required(); // Set as required if needed
    }

    /**
     * Set a custom icon for the barcode input.
     *
     * @param  string  $icon  The SVG or HTML for the icon.
     */
    public function icon(string $icon): static
    {
        return $this->extraAttributes(['icon' => $icon]);
    }
}
