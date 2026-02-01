<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Tests\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Livewire\Component;
use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

class TestBarcodeFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public string $barcode = '';

    public string $productCode = '';

    public function form(Schema $form): Schema
    {
        return $form
            ->schema([
                BarcodeInput::make('barcode')
                    ->label('Barcode')
                    ->required(),
                BarcodeInput::make('productCode')
                    ->label('Product Code')
                    ->icon('heroicon-o-check-circle'),
            ]);
    }

    public function submitForm(): void
    {
        $this->form->validate();
    }

    public function render()
    {
        return view('livewire.test-barcode-form-component');
    }
}
