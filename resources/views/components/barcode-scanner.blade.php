<div
    x-load-js="['https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js']"
    x-data="{
        html5QrcodeScanner: null,
        stopScanning() {
            if (! this.html5QrcodeScanner) {
                return;
            }

            this.html5QrcodeScanner.clear();
            this.html5QrcodeScanner = null;
        },
        startScanning() {
            this.html5QrcodeScanner = new Html5QrcodeScanner(@js('reader-' . $barcodeInput->getId()), {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250,
                },
            }, false);

            this.html5QrcodeScanner.render((decodedText) => {
                $wire.set(@js($barcodeInput->getStatePath()), decodedText);
            });
        },
    }"
    x-init="startScanning()"
    x-on:modal-closed.window="stopScanning()"
>
    <div id="reader-{{ $barcodeInput->getId() }}"></div>
</div>
