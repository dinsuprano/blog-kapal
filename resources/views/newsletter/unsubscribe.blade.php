{{-- filepath: resources/views/newsletter/unsubscribe.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unsubscribe from Newsletter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; }
        .container { max-width: 400px; margin: 60px auto; background: #fff; border-radius: 8px; padding: 32px; box-shadow: 0 2px 8px #0001; }
        .btn { display: inline-block; padding: 10px 24px; background: #e53e3e; color: #fff; border: none; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .btn:hover { background: #c53030; }
        .success { color: #38a169; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="container">
        @if(isset($success))
            <div class="success">{{ $success }}</div>
            @if(!$email)
                <div style="color:#e53e3e; margin-top:16px;">
                    <strong>Note:</strong> This email is not subscribed or has already been removed from our list.
                </div>
                <div style="margin-top:24px;">
                    <a href="{{ url('/') }}" class="btn" style="background:#3182ce;">Back to Home</a>
                </div>
            @endif
        @else
            <h2>Unsubscribe</h2>
            <p>Are you sure you want to unsubscribe <strong>{{ $email }}</strong> from our newsletter?</p>
            <form method="POST" action="{{ route('newsletter.unsubscribe.confirm') }}">
                @csrf
               
                <input type="hidden" name="token" value="{{ $token }}">
                <button type="submit" class="btn">Unsubscribe</button>
            </form>
        @endif
    </div>
</body>
</html>