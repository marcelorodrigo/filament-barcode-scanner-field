<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components;

use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;

class BarcodeInput extends TextInput
{
    protected string $view = 'filament-barcode-scanner-field::components.barcode-input';

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $label = $this->getLabel() ?? 'Barcode';
        if ($label instanceof Htmlable) {
            $label = $label->toHtml();
        }

        $label = strtolower((string) $label);
        $this->placeholder('Enter ' . $label . '...');
    }

    public function icon(string $icon): static
    {
        return $this->extraAttributes(['icon' => $icon]);
    }
}
