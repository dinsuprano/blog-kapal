<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use Firefly\FilamentBlog\Models\NewsLetter;


Route::redirect('/', '/blog'); // Redirect root to /blog


// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    
// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });

Route::get('/newsletter/unsubscribe', function (\Illuminate\Http\Request $request) {
    $token = $request->query('token');
    $subscriber = NewsLetter::where('unsubscribe_token', $token)->first();

    if ($subscriber) {
        // Subscriber exists, show unsubscribe form
        return view('newsletter.unsubscribe', [
            'email' => $subscriber->email,
            'token' => $token,
        ]);
    } else {
        // Subscriber not found, show custom message/page
        return view('newsletter.unsubscribe', [
            'email' => null,
            'token' => $token,
            'success' => 'This email has already been unsubscribed or the link is invalid.',
        ]);
    }
})->name('newsletter.unsubscribe');

Route::post('/newsletter/unsubscribe/confirm', function (\Illuminate\Http\Request $request) {
    $token = $request->input('token');
    $subscriber = NewsLetter::where('unsubscribe_token', $token)->first();

    if ($subscriber) {
        $email = $subscriber->email;
        $subscriber->delete();
        $success = 'You have been unsubscribed.';
    } else {
        $email = null;
        $success = 'This email has already been unsubscribed or the link is invalid.';
    }

    return view('newsletter.unsubscribe', [
        'email' => $email,
        'token' => $token,
        'success' => $success,
    ]);
})->name('newsletter.unsubscribe.confirm');

require __DIR__.'/auth.php';
