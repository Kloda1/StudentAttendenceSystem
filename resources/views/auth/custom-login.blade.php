<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.login_title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#1E40AF 0%,#3B82F6 100%);
            font-family:Tajawal,sans-serif;
        }

        .login-card{
            backdrop-filter: blur(12px);
            background: rgba(255,255,255,0.95);
            border-radius:24px;
            box-shadow:0 20px 60px rgba(0,0,0,0.25);
        }
    </style>

</head>

<body class="antialiased">

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="login-card w-full max-w-md p-8">

        <!-- Language Switch -->
        <div class="flex justify-center gap-4 text-sm mb-6">

            <a href="{{ route('lang.switch',['locale'=>'ar']) }}"
               class="hover:underline">
                العربية
            </a>

            <span>|</span>

            <a href="{{ route('lang.switch',['locale'=>'en']) }}"
               class="hover:underline">
                English
            </a>

        </div>

        <div class="text-center mb-8">

            <img src="{{ asset('images/logo.png') }}"
                 class="h-20 mx-auto mb-4"
                 alt="logo">

            <h1 class="text-3xl font-bold text-gray-800">
                {{ __('auth.university_name') }}
            </h1>

            <p class="text-gray-600 mt-2">
                {{ __('auth.system_name') }}
            </p>

        </div>

        <!-- Errors -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-xl mb-5">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label class="block mb-2 text-gray-700">
                    {{ __('auth.email') }}
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-600 outline-none"
                       placeholder="example@uni.edu">
            </div>

            <div class="mb-5">
                <label class="block mb-2 text-gray-700">
                    {{ __('auth.password') }}
                </label>

                <input type="password"
                       name="password"
                       required
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-600 outline-none"
                       placeholder="********">
            </div>

            <div class="mb-6">
                <label class="block mb-3 text-gray-700 font-medium">
                    {{ __('auth.login_as_optional') }}
                </label>

                <div class="flex flex-wrap gap-4">

                    <label class="inline-flex items-center">
                        <input type="radio" name="role" value="student"
                               class="form-radio text-blue-600">
                        <span class="mr-2">{{ __('auth.student') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="role" value="lecturer"
                               class="form-radio text-blue-600">
                        <span class="mr-2">{{ __('auth.lecturer') }}</span>
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" name="role" value="admin"
                               class="form-radio text-blue-600">
                        <span class="mr-2">{{ __('auth.admin') }}</span>
                    </label>

                </div>
            </div>

            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember"
                           class="form-checkbox text-blue-600 rounded">

                    <span class="mr-2 text-gray-700">
                        {{ __('auth.remember_me') }}
                    </span>
                </label>
            </div>

            <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold p-3 rounded-xl transition">

                {{ __('auth.login') }}

            </button>
        </form>

        <div class="text-center mt-6 text-gray-600">

            {{ __('auth.no_account') }}

            <a href="{{ route('register') }}" class="text-[#1E40AF] hover:text-[#1E3A8A] font-semibold">
                {{ __('auth.create_account') }}
            </a>

        </div>

    </div>
</div>

</body>
</html>
