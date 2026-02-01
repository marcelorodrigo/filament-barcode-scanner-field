<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components;

use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;

class BarcodeInput extends TextInput
{
    protected string $view = 'filament-barcode-scanner-field::components.barcode-input';

    protected ?string $icon = null;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $label = $this->getLabel() ?? __('filament-barcode-scanner-field::barcode-scanner-field.field.default_label');
        if ($label instanceof Htmlable) {
            $label = $label->toHtml();
        }

        $label = strtolower((string) $label);
        $this->placeholder(
            __('filament-barcode-scanner-field::barcode-scanner-field.field.placeholder_prefix')
            . $label
            . __('filament-barcode-scanner-field::barcode-scanner-field.field.placeholder_suffix')
        );
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon ?? 'heroicon-m-qr-code';
    }
}
