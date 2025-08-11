<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

// Run the queue:work command directly in PHP
$kernel->call('queue:work', [
    '--once' => true,
    '--sleep' => 3,
    '--tries' => 3,
]);

echo "Queue jobs processed successfully!";
