<?php
}
    }
        return view('livewire.test-barcode-form-component');
    {
    public function render()

    }
        $this->form->validate();
    {
    public function submitForm(): void

    }
            ]);
                    ->icon('heroicon-o-check-circle'),
                    ->label('Product Code')
                BarcodeInput::make('productCode')
                    ->required(),
                    ->label('Barcode')
                BarcodeInput::make('barcode')
            ->schema([
        return $form
    {
    public function form(Form $form): Form

    public string $productCode = '';

    public string $barcode = '';

    use InteractsWithForms;
{
class TestBarcodeFormComponent extends Component implements HasForms

use Marcelorodrigo\FilamentBarcodeScannerField\Forms\Components\BarcodeInput;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

namespace Marcelorodrigo\FilamentBarcodeScannerField\Tests\Livewire;


