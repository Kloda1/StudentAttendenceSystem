@extends('teacher.layout')

@section('title', 'QR Code')

@section('head')
    <meta http-equiv="refresh" content="{{ $session->qr_refresh_rate }}">
@endsection

@section('content')

    <div class="flex flex-col items-center bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-6">
            QR Code الجلسة
        </h2>

        <img src="{{ $qr }}" alt="QR Code">

        <p class="mt-4 text-gray-600 text-sm">
            يحدث تلقائياً كل  {{ $session->qr_refresh_rate }} ثانية
        </p>
        <p class="text-gray-500 text-sm">
            رمز التحقق
        </p>

        <p class="text-3xl font-bold tracking-widest text-blue-600">
            {{ $otp }}
        </p>
    </div>

@endsection
