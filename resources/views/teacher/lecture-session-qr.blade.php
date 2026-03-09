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

        <div id="qr-container">
            <img src="{{ $qr }}" alt="QR Code">
        </div>

        <p id="countdown" class="text-orange-500 font-semibold mt-2">
            {{ __('teacher.qr_expires_in') }} {{ $session->qr_refresh_rate }}s
        </p>

        <p id="otp-label" class="text-gray-500 text-sm">
            {{ __('teacher.verification_code') }}
        </p>

        <p id="otp-code" class="text-3xl font-bold tracking-widest text-blue-600">
            {{ $otp }}
        </p>

    </div>

    <script>
        setTimeout(function () {


            document.getElementById('qr-container').innerHTML =
                '<div class="flex flex-col items-center justify-center text-red-600">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">' +
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />' +
                '</svg>' +
                '<p class="text-xl font-bold">{{ __("teacher.qr_expired") }}</p>' +
                '</div>';

            document.getElementById('otp-label').style.display = 'none';
            document.getElementById('otp-code').style.display = 'none';
            document.getElementById('countdown').style.display = 'none';

        }, {{ $session->qr_refresh_rate * 1000 }});
    </script>

@endsection
