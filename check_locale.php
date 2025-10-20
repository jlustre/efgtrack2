<?php
// Bootstrap Laravel and test translations
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\App as AppFacade;
use Illuminate\Support\Facades\Lang;

// Show current default locale and fallback
echo "config('app.locale') = " . config('app.locale') . PHP_EOL;
echo "app()->getLocale() = " . app()->getLocale() . PHP_EOL;

// Test translations in current locale
$keys = ['Profile', 'Saved.', 'Saved:', 'Weekdays AM', 'Weekdays PM', 'Anytime'];
foreach ($keys as $k) {
    echo "key=[$k] -> " . __($k) . PHP_EOL;
}

// Force Spanish and test again
AppFacade::setLocale('es');
echo "\nAfter App::setLocale('es'):\n";
echo "app()->getLocale() = " . app()->getLocale() . PHP_EOL;
foreach ($keys as $k) {
    echo "key=[$k] -> " . __($k) . PHP_EOL;
}

// Force English
AppFacade::setLocale('en');
echo "\nAfter App::setLocale('en'):\n";
echo "app()->getLocale() = " . app()->getLocale() . PHP_EOL;
foreach ($keys as $k) {
    echo "key=[$k] -> " . __($k) . PHP_EOL;
}

echo "\nTranslator locale list files present in resources/lang/es.json exists: " . (file_exists(resource_path('lang/es.json')) ? 'yes' : 'no') . PHP_EOL;

