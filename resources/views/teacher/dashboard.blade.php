@extends('teacher.layout')

@section('title', __('teacher.dashboard_title'))

@section('content')

    <div class="grid md:grid-cols-4 gap-6">

        <!-- My Sessions -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                {{ __('teacher.my_sessions') }}
            </div>

            <div class="mt-3 text-3xl font-bold text-blue-700">
                {{ $sessionsCount ?? 0 }}
            </div>

        </div>

        <!-- Today Attendance -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                {{ __('teacher.today_attendance') }}
            </div>

            <div class="mt-3 text-3xl font-bold text-green-600">
                {{ $todayAttendance ?? 0 }}
            </div>

        </div>

        <!-- Total Students -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                {{ __('teacher.total_students') }}
            </div>

            <div class="mt-3 text-3xl font-bold text-indigo-600">
                {{ $totalStudents ?? 0 }}
            </div>

        </div>

        <!-- Active Session Status -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                {{ __('teacher.active_session') }}
            </div>

            <div class="mt-4">

                @if($activeSession)

                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-600"></span>
                    {{ __('teacher.active') }}
                </span>

                @else

                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 text-gray-600 text-sm font-semibold">
                    {{ __('teacher.none') }}
                </span>

                @endif

            </div>

        </div>

    </div>

@endsection
