<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $direction ?? 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: Tajawal, sans-serif;
            background: linear-gradient(135deg, #1E40AF, #3B82F6);
        }

        .auth-card {
            backdrop-filter: blur(10px);
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
            padding: 2rem;
        }
    </style>

</head>

<body class="antialiased">

<div class="min-h-screen flex items-center justify-center p-4">

    <div class="auth-card w-full max-w-4xl">

        <div class="flex justify-center gap-4 text-sm mb-4">
            <a href="{{ route('lang.switch',['locale'=>'ar']) }}">
                {{ __('auth.arabic') }}
            </a>

            <span>|</span>

            <a href="{{ route('lang.switch',['locale'=>'en']) }}">
                {{ __('auth.english') }}
            </a>
        </div>


        @yield('content')

    </div>

</div>

</body>
</html>
