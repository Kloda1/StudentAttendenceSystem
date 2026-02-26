@extends('student.layout')

@section('title', __('student.attendance_title'))

@section('content')

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl shadow p-8">

            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                {{ __('student.qr_title') }}
            </h1>

            <div class="flex flex-col items-center">

                <div id="qr-reader" class="w-full max-w-lg"></div>

                <div id="qr-result" class="mt-6 hidden text-center">
                    <p class="text-green-600 font-bold">
                        {{ __('student.scan_success') }}
                    </p>

                    <p class="text-gray-600 mt-2">
                        {{ __('student.checking') }}
                    </p>
                </div>

            </div>
        </div>

    </div>

@endsection

@push('styles')
    <link rel="stylesheet"
          href="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.css">
@endpush

@push('scripts')

    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            let processing = false;

            const scanner = new Html5Qrcode("qr-reader");

            function startScanner(){

                scanner.start(
                    { facingMode: "environment" },
                    { fps: 10, qrbox: 250 },
                    onScanSuccess
                ).catch(console.error);

            }

            async function onScanSuccess(decodedText){

                if(processing) return;

                processing = true;

                try{

                    await scanner.stop();

                    document.getElementById('qr-result')
                        .classList.remove('hidden');

                    const response = await fetch(
                        "{{ route('student.attendance.scan') }}",
                        {
                            method:"POST",
                            headers:{
                                "Content-Type":"application/json",
                                "X-CSRF-TOKEN":"{{ csrf_token() }}"
                            },
                            body:JSON.stringify({
                                qr_data: decodedText,
                                fingerprint: getFingerprint(),
                                device_type: getDeviceType(),
                                device_name: navigator.userAgent,
                                os: getOS(),
                                browser: getBrowser()
                            })
                        }
                    );

                    const data = await response.json();

                    if(data.success){
                        alert("{{ __('student.attendance_success') }}");
                        location.reload();
                    }
                    else{
                        alert("{{ __('student.error_prefix') }}: "+data.error);
                        startScanner();
                    }

                }catch(e){

                    alert("{{ __('student.connection_error') }}");
                    startScanner();

                }

                processing = false;

            }

            startScanner();

            function getFingerprint(){

                let fp = localStorage.getItem("device_fp");

                if(!fp){
                    fp = "fp_"+Math.random().toString(36).substring(2)+Date.now();
                    localStorage.setItem("device_fp",fp);
                }

                return fp;
            }

            function getDeviceType(){

                const ua = navigator.userAgent;

                if(/tablet|ipad|playbook|silk/i.test(ua)) return "tablet";

                if(/Mobile|Android|iPhone|iPod/i.test(ua)) return "mobile";

                return "desktop";
            }

            function getOS(){

                const ua = navigator.userAgent;

                if(ua.includes("Win")) return "Windows";
                if(ua.includes("Mac")) return "MacOS";
                if(ua.includes("Linux")) return "Linux";
                if(ua.includes("Android")) return "Android";
                if(ua.includes("iPhone")) return "iOS";

                return "Unknown";
            }

            function getBrowser(){

                const ua = navigator.userAgent;

                if(ua.includes("Chrome")) return "Chrome";
                if(ua.includes("Firefox")) return "Firefox";
                if(ua.includes("Safari")) return "Safari";
                if(ua.includes("Edge")) return "Edge";

                return "Unknown";
            }

        });

    </script>

@endpush
