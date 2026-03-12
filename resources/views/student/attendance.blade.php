@extends('student.layout')

@section('title', __('student.confirm_attendance'))

@section('content')
    <div class="header">
        <div class="logo-box">
            <img src="{{ url('/images/logo.png') }}" alt="{{ __('student.university_name') }}" class="logo-image"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

            <div class="logo-fallback" aria-hidden="true">
                <svg viewBox="0 0 64 64" width="56" height="56" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="8" y="10" width="48" height="44" rx="10" fill="currentColor" opacity=".14"/>
                    <path d="M20 26L32 18L44 26V28C44 35.18 38.63 41.3 32 42C25.37 41.3 20 35.18 20 28V26Z"
                          fill="currentColor"/>
                    <path d="M16 24L32 16L48 24" stroke="currentColor" stroke-width="4" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M32 42V50" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        <h1 class="title">{{ __('student.confirm_attendance') }}</h1>
        <p class="subtitle">{{ __('student.university_name') }}</p>
    </div>

    <div class="messages">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('message') && !session('success') && !session('status'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <form method="POST" action="{{ route('student.attendance.store', ['session' => $sessionId]) }}"
          class="form" novalidate>
        @csrf

        <div class="field">
            <label for="student_number" class="label">
                {{ __('student.student_number') }}
            </label>

            <input id="student_number" name="student_number" type="text" value="{{ old('student_number') }}"
                   class="input {{ $errors->has('student_number') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('student.student_number') }}" autocomplete="off" inputmode="numeric" dir="ltr"
                   aria-invalid="{{ $errors->has('student_number') ? 'true' : 'false' }}" autofocus>

            @error('student_number')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="otp" class="label">
                {{ __('student.verification_code') }}
            </label>

            <input id="otp" name="otp" type="text" value="{{ old('otp') }}"
                   class="input {{ $errors->has('otp') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('student.verification_code') }}" autocomplete="one-time-code" inputmode="numeric"
                   dir="ltr" aria-invalid="{{ $errors->has('otp') ? 'true' : 'false' }}">

            @error('otp')
            <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-btn">
            {{ __('student.verify') }}
        </button>

        <div class="footer-note">
            {{ __('student.enter_student_number_and_code') }}
        </div>
    </form>

<<<<<<< HEAD
@endsection
=======
    window.addEventListener('online', () => updateConnectionStatus(true));
    window.addEventListener('offline', () => updateConnectionStatus(false));
    updateConnectionStatus(navigator.onLine);

    otpInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 6);

        if (this.value.length === 6 && studentNumberInput.value.length > 0) {
            // Optional: auto-submit
            // form.requestSubmit();
        }
    });

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        if (isSubmitting) return;

        hideStatus();

        const studentNumber = studentNumberInput.value.trim();
        const otp = otpInput.value.trim();

        if (!studentNumber || !otp) {
            showStatus('{{ __('student.please_fill_all_fields') }}', 'error');
            return;
        }

        if (otp.length !== 6) {
            showStatus('{{ __('student.invalid_otp') }}', 'error');
            return;
        }

        isSubmitting = true;
        submitBtn.disabled = true;
        submitText.textContent = '{{ __('student.processing') }}';
        loadingIndicator.style.display = 'block';
        statusContainer.style.display = 'none';

        try {
            const formData = new FormData();
            formData.append('student_number', studentNumber);
            formData.append('otp', otp);
            formData.append('_token', '{{ csrf_token() }}');

            const response = await fetch('{{ route('student.attendance.store.sync', ['session' => $sessionId ?? 0]) }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'text/html'
                }
            });

            const html = await response.text();

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            const successAlert = doc.querySelector('.alert-success');
            const errorAlert = doc.querySelector('.alert-error');

            loadingIndicator.style.display = 'none';
            submitBtn.disabled = false;
            submitText.textContent = '{{ __('student.verify') }}';

            if (successAlert && !errorAlert) {
                
                const successMessage = successAlert.textContent.trim();

             showStatus(successMessage, 'success');
studentNumberInput.value = '';
otpInput.value = '';
studentNumberInput.focus();
            } else if (errorAlert) {
                const errorMessage = errorAlert.textContent.trim();
                showStatus(errorMessage, 'error');
            } else {
                const sessionSuccess = doc.querySelector('[data-session-success]');
                if (sessionSuccess) {
                    showStatus(sessionSuccess.textContent.trim(), 'success');
                    studentNumberInput.value = '';
                    otpInput.value = '';
                } else {
                    showStatus('{{ __('student.connection_error') }}', 'error');
                }
            }

        } catch (error) {
            console.error('Error:', error);
            loadingIndicator.style.display = 'none';
            submitBtn.disabled = false;
            submitText.textContent = '{{ __('student.verify') }}';
            showStatus('{{ __('student.connection_error') }}', 'error');
            updateConnectionStatus(false);
        } finally {
            isSubmitting = false;
        }
    });

    function startPolling(studentNumber) {
        if (pollingInterval) {
            clearInterval(pollingInterval);
        }

        let pollCount = 0;
        const maxPolls = 30;

        pollingInterval = setInterval(async () => {
            pollCount++;

            if (pollCount > maxPolls) {
                clearInterval(pollingInterval);
                showStatus('{{ __('student.timeout_waiting') }}', 'error');
                return;
            }

            try {
                const response = await fetch(
                    `{{ route('student.attendance.check.status', ['session' => $sessionId ?? 0]) }}?student_number=${encodeURIComponent(studentNumber)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

                const data = await response.json();

                if (data.success) {
                    if (data.status === 'recorded') {
                        clearInterval(pollingInterval);
                        showSuccessStatus(data.message, data.attendance_time);
                        studentNumberInput.value = '';
                        otpInput.value = '';
                        studentNumberInput.focus();
                    } else if (data.status === 'failed') {
                        clearInterval(pollingInterval);
                        showStatus(data.message, 'error');
                    } else {
                        if (data.remaining_seconds !== undefined) {
                            remainingSeconds = data.remaining_seconds;
                            updateCountdownDisplay();
                        }
                        loadingSubtext.textContent =
                            `{{ __('student.checking') }} (${pollCount * 2}s)`;
                    }
                }
            } catch (error) {
                console.error('Polling error:', error);
            }
        }, 2000);
    }

    function showStatus(message, type) {
        statusContainer.style.display = 'block';
        statusContainer.className = 'status-container ' + type;

        let iconSvg = '';
        if (type === 'success') {
            iconSvg = `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>`;
        } else if (type === 'error') {
            iconSvg = `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>`;
        } else {
            iconSvg = `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>`;
        }

        statusIcon.innerHTML = iconSvg;
        statusTitle.textContent = type === 'success' ? '{{ __('student.success') }}':
            type === 'error' ? '{{ __('student.error_prefix') }}':
            '{{ __('student.processing') }}';
        statusMessageText.textContent = message;
        successDetails.style.display = 'none';
    }

    function showSuccessStatus(message, attendanceTimeIso) {
        statusContainer.style.display = 'block';
        statusContainer.className = 'status-container success';

        const iconSvg = `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>`;

        statusIcon.innerHTML = iconSvg;
        statusTitle.textContent = '{{ __('student.success') }}';
        statusMessageText.textContent = message;

        if (attendanceTimeIso) {
            const date = new Date(attendanceTimeIso);
            const timeStr = date.toLocaleTimeString();
            attendanceTime.textContent = timeStr;
            successDetails.style.display = 'block';
        }

        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
    }

    function hideStatus() {
        statusContainer.style.display = 'none';
    }

    form.addEventListener('submit', function(e) {
        if (isSubmitting) {
            e.preventDefault();
            return false;
        }
    });

    window.addEventListener('beforeunload', function() {
        if (pollingInterval) {
            clearInterval(pollingInterval);
        }
        if (countdownInterval) {
            clearInterval(countdownInterval);
        }
    });
});
</script>
@endpush
@endsection
>>>>>>> 6cdfbab827dc5a12553c5894aac6c2dffe042902
