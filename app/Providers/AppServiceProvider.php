<?php

namespace App\Providers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        // Serve files manually if symlink is not available
        \Route::get('/storage/{path}', function ($path) {
            $file = storage_path('app/public/' . $path);

            if (!file_exists($file)) {
                abort(404);
            }

            return Response::file($file);
        })->where('path', '.*');
        }
}
