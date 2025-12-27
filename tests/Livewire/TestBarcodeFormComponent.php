<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Tests\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;

class TestBarcodeFormComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public string $barcode = '';

    public string $productCode = '';

    public function form(Form $form): Form
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
