{{-- filepath: resources/views/newsletter/unsubscribe.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unsubscribe Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <!-- Tailwind CDN (remove if you already compile Tailwind on the site) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-950 p-4">
<section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900 rounded-xl shadow-md">
    <header class="flex items-center justify-between">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
            <img class="w-auto h-7 sm:h-8" src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}" onerror="this.style.display='none'">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ config('app.name') }}</span>
        </a>
        <span class="text-blue-600 dark:text-blue-400" aria-hidden="true">
            <!-- Mail icon (Heroicons outline) -->
            <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </span>
    </header>

    <main class="mt-8">
        @if(isset($success))
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Unsubscription Status</h2>
            <p class="mt-2 leading-relaxed text-green-600 dark:text-green-400">
                {{ $success }}
            </p>

            @if(!$email)
                <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                    The link may have been used already or is invalid.
                </p>
            @else
                <p class="mt-3 text-sm text-gray-600 dark:text-gray-300">
                    {{ $email }} has been removed from our mailing list.
                </p>
            @endif

            <div class="mt-6">
                <a href="{{ url('/') }}"
                   class="inline-flex items-center px-6 py-2 text-sm font-medium tracking-wider text-white bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                    Back to Home
                </a>
            </div>
        @else
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Unsubscribe from Newsletter</h2>

            <p class="mt-2 leading-relaxed text-gray-600 dark:text-gray-300">
                You are about to unsubscribe <span class="font-semibold text-gray-800 dark:text-gray-100">{{ $email }}</span>
                from future email updates. You can re-subscribe anytime.
            </p>

            <form class="mt-6" method="POST" action="{{ route('newsletter.unsubscribe.confirm') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <button type="submit"
                        class="px-6 py-2 text-sm font-medium tracking-wider text-white bg-red-600 rounded-lg hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-80">
                    Unsubscribe
                </button>
            </form>
        @endif
    </main>

    <footer class="mt-8">
        <p class="text-xs text-gray-500 dark:text-gray-400">
            If this wasn’t you, you can safely ignore this page.
        </p>
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            © {{ now()->year }} {{ config('app.name') }}. All rights reserved.
        </p>
    </footer>
</section>
</body>
</html>