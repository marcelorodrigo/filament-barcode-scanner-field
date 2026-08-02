<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class BarcodeInput extends TextInput
{
    protected ?string $icon = null;

    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->inputMode('numeric');
        $this->suffixAction(
            Action::make('scanBarcode')
                ->icon(fn (): string => $this->getIcon())
                ->tooltip(__('filament-barcode-scanner-field::barcode-scanner-field.actions.scan_qrcode'))
                ->modalHeading(fn (): string => __('filament-barcode-scanner-field::barcode-scanner-field.modal.title', [
                    'label' => $this->getLabel() ?? __('filament-barcode-scanner-field::barcode-scanner-field.modal.default_label'),
                ]))
                ->modalWidth('lg')
                ->modalContent(fn (): View => view('filament-barcode-scanner-field::components.barcode-scanner', [
                    'barcodeInput' => $this,
                ]))
                ->modalSubmitAction(false)
                ->modalCancelActionLabel(__('filament-barcode-scanner-field::barcode-scanner-field.modal.close_button'))
                ->closeModalByClickingAway(false),
        );

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
