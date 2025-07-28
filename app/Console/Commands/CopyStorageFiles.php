<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopyStorageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:copy-public';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy files from storage/app/public to public/storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $from = storage_path('app/public');
        $to = public_path('storage');

        File::copyDirectory($from, $to);

        $this->info('Files copied from storage/app/public to public/storage.');
    }
}
