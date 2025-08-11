<?php
// queue-worker.php

// Change to project directory
chdir(__DIR__);

// Run Laravel queue worker once
passthru('php artisan queue:work --once --sleep=3 --tries=3');
