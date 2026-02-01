@php
    use Filament\Support\Facades\FilamentAsset;use function Filament\Support\prepare_inherited_attributes;
    $fieldWrapperView = $getFieldWrapperView();
    $datalistOptions = $getDatalistOptions();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $extraAttributeBag = $getExtraAttributeBag();
    $hasInlineLabel = $hasInlineLabel();
    $id = $getId();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $statePath = $getStatePath();
    $placeholder = $getPlaceholder();

    $inputAttributes = $getExtraInputAttributeBag()
            ->merge($extraAlpineAttributes, escape: false)
            ->merge([
                'autofocus' => $isAutofocused(),
                'disabled' => $isDisabled,
                'id' => $id,
                'inputmode' => $getInputMode(),
                'list' => $datalistOptions ? $id . '-list' : null,
                'max' => (! $isConcealed) ? $getMaxValue() : null,
                'maxlength' => (! $isConcealed) ? $getMaxLength() : null,
                'min' => (! $isConcealed) ? $getMinValue() : null,
                'minlength' => (! $isConcealed) ? $getMinLength() : null,
                'placeholder' => filled($placeholder) ? e($placeholder) : null,
                'readonly' => $isReadOnly(),
                'required' => $isRequired() && (! $isConcealed),
                'type' => "text",
                $applyStateBindingModifiers('wire:model') => $statePath,
            ], escape: false)
            ->class([
                'w-full pr-10',
            ]);
@endphp
<x-dynamic-component
        :component="$fieldWrapperView"
        :field="$field"
        :has-inline-label="$hasInlineLabel"
        class="fi-fo-text-input-wrp"
>
    <div xmlns:x-filament="http://www.w3.org/1999/html"
         x-load-js="['https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js']"
         x-load-css="[@js(FilamentAsset::getStyleHref('barcode-scanner-field', 'marcelorodrigo/filament-barcode-scanner-field'))]"
         x-on:close-modal.window="stopScanning()"
         x-data="{
        html5QrcodeScanner: null,
        stopScanning() {
           if(!this.html5QrcodeScanner) {
               return;
           }
           this.html5QrcodeScanner.pause();
           this.html5QrcodeScanner.clear();
           this.html5QrcodeScanner = null;
        },
        openScannerModal() {
            $dispatch('open-modal', { id: 'qrcode-scanner-modal-{{ $getName() }}' });
            this.startCamera();
        },
        closeScannerModal() {
            $dispatch('close-modal', { id: 'qrcode-scanner-modal-{{ $getName() }}' });
        },
        onScanSuccess(decodedText, decodedResult) {
            $wire.set('{{ $getStatePath() }}', decodedText);
            $dispatch('close-modal', { id: 'qrcode-scanner-modal-{{ $getName() }}' });
        },
        startCamera() {
            this.html5QrcodeScanner = new Html5QrcodeScanner('reader-{{ $getName() }}', { fps: 10, qrbox: {width: 250, height: 250} }, false);
            this.html5QrcodeScanner.render(this.onScanSuccess.bind(this));
        }
     }"
    >
        <div class="grid gap-y-2">
            <x-filament::input.wrapper :disabled="$isDisabled" :valid="! $errors->has($statePath)"
                                       :attributes="prepare_inherited_attributes($extraAttributeBag)->class(['fi-fo-text-input'])">
                <input {{ $inputAttributes->class(['fi-input']) }} />

                <x-slot name="suffix">
                    <button type="button" x-on:click="openScannerModal()"
                            class="flex items-center justify-center w-9 h-9 -my-2 text-gray-400 dark:text-gray-200 hover:text-gray-500 dark:hover:text-gray-300 transition-colors rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700"
                            aria-label="{{ __('filament-barcode-scanner-field::barcode-scanner-field.actions.scan_qrcode') }}">
                        <x-dynamic-component :component="$getIcon()" class="fi-barcode-scanner-icon" />
                    </button>
                </x-slot>
            </x-filament::input.wrapper>

        </div>

        <!-- Filament Modal for QrCode Scanner -->
        <x-filament::modal id="qrcode-scanner-modal-{{ $getName() }}" width="lg" :close-by-clicking-away="false">
            <x-slot name="header">
                <h2 class="text-lg font-semibold">
                    {{ __('filament-barcode-scanner-field::barcode-scanner-field.modal.title', ['label' => $getLabel() ?? __('filament-barcode-scanner-field::barcode-scanner-field.modal.default_label')]) }}
                </h2>
            </x-slot>

            <div class="p-4">
                <div id="scanner-container">
                    <div id="reader-{{ $getName() }}" width="600px" height="600px"></div>
                </div>
            </div>

            <x-slot name="footer">
                <x-filament::button @click="closeScannerModal()" color="danger">
                    {{ __('filament-barcode-scanner-field::barcode-scanner-field.modal.close_button') }}
                </x-filament::button>
            </x-slot>
        </x-filament::modal>
    </div>
</x-dynamic-component>
