@extends('student.layout')

@section('title', __('student.confirm_attendance'))

@section('content')

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
action="{{ route('student.attendance.store', ['session' => $sessionId]) }}"
      class="space-y-6 max-w-md">

    @csrf

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
           {{ __('student.student_number') }}
        </label>

        <input
            type="text"
            name="student_number"
            value="{{ old('student_number') }}"
            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ __('student.verification_code') }}
        </label>

        <input
            type="text"
            name="otp"
            value="{{ old('otp') }}"
            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">

          {{ __('student.verify') }}
    </button>

</form>

@endsection

