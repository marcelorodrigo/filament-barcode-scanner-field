<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Commands;

use Illuminate\Console\Command;

class FilamentBarcodeScannerFieldCommand extends Command
{
    public $signature = 'filament-barcode-scanner-field';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
