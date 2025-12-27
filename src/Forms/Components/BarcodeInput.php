<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components;

use Filament\Forms\Components\TextInput;

class BarcodeInput extends TextInput
{
    protected string $view = 'filament-barcode-scanner-field::components.barcode-input';

    protected function setUp(): void
    {
        parent::setUp();
        $this->placeholder('Enter ' . strtolower($this->getLabel()) . '...');
    }

    public function icon(string $icon): static
    {
        return $this->extraAttributes(['icon' => $icon]);
    }
}
