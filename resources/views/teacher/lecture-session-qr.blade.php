@extends('teacher.layout')

@section('title', __('teacher.qr_code'))

@section('head')
    <meta http-equiv="refresh" content="{{ $session->qr_refresh_rate }}">
@endsection

@section('content')

    <div class="flex flex-col items-center bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-6">
          {{ __('teacher.session_qr') }}
        </h2>

        <img src="{{ $qr }}" alt="QR Code">

        <p class="mt-4 text-gray-600 text-sm">
        {{ __('teacher.auto_refresh', ['seconds' => $session->qr_refresh_rate]) }}

        </p>
        <p class="text-gray-500 text-sm">
          {{ __('teacher.verification_code') }}
        </p>

        <p class="text-3xl font-bold tracking-widest text-blue-600">
            {{ $otp }}
        </p>
    </div>

@endsection
