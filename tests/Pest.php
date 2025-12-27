<?php

use Livewire\Features\SupportTesting\Testable;
use Marcelorodrigo\FilamentBarcodeScannerField\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing
| code specific to your package that you would like to share to your tests.
| Learn more about Pest extensions by visiting: https://pestphp.com/docs/extend
|
*/

if (!function_exists('livewire')) {
    function livewire(string $component, array $data = []) {
        return test()->livewire($component, $data);
    }
}

