<?php

namespace Marcelorodrigo\FilamentBarcodeScannerField\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Marcelorodrigo\FilamentBarcodeScannerField\FilamentBarcodeScannerField
 */
class FilamentBarcodeScannerField extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Marcelorodrigo\FilamentBarcodeScannerField\FilamentBarcodeScannerField::class;
    }
}
