<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $direction ?? 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', __('student.student_dashboard'))
        - {{ __('student.university_name') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body{
            background:#f3f4f6;
            font-family:Tajawal,sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white p-6 flex flex-col">

        <!-- Logo + Info -->
        <div class="text-center mb-8">

            <img src="{{ asset('images/logo.png') }}"
                 class="h-14 mx-auto mb-3"
                 alt="logo">

            <h2 class="text-xl font-bold">
                {{ __('student.university_name') }}
            </h2>

            <p class="text-sm opacity-80 mt-1">
                {{ __('student.greeting') }}
                {{ auth()->user()->name }}
            </p>

        </div>

        <!-- Language Switch -->
        <div class="flex justify-center gap-3 text-sm mb-6">

            <a href="{{ route('lang.switch',['locale'=>'ar']) }}"
               class="hover:underline">
                {{ __('student.arabic') }}
            </a>

            <span>|</span>

            <a href="{{ route('lang.switch',['locale'=>'en']) }}"
               class="hover:underline">
                {{ __('student.english') }}

            </a>

        </div>

        <!-- Navigation -->
        <nav class="space-y-2 flex-1">

            <a href="{{ route('student.dashboard') }}"
               class="block px-4 py-2 rounded-lg transition hover:bg-white/10
               {{ request()->routeIs('student.dashboard') ? 'bg-white/20' : '' }}">

                {{ __('student.home') }}
            </a>

            <a href="{{ route('student.attendance') }}"
               class="block px-4 py-2 rounded-lg transition hover:bg-white/10
               {{ request()->routeIs('student.attendance') ? 'bg-white/20' : '' }}">

                {{ __('student.attendance') }}
            </a>

            <a href="{{ route('student.profile.edit') }}"
               class="block px-4 py-2 rounded-lg transition hover:bg-white/10
               {{ request()->routeIs('student.profile.edit') ? 'bg-white/20' : '' }}">

                {{ __('student.profile') }}
            </a>

        </nav>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 transition
                    py-2 rounded-lg font-semibold">
                {{ __('student.logout') }}
            </button>

        </form>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <!-- Messages -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </div>

    </main>

</div>

@stack('scripts')

</body>
</html>
