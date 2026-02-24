<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام حضور الطلاب</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
            font-family: 'Tajawal', sans-serif;
        }
        .login-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="login-card w-full max-w-md p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="جامعة المنارة" 
                     class="h-20 mx-auto mb-4">
                <h1 class="text-3xl font-bold text-gray-800">جامعة المنارة</h1>
                <p class="text-gray-600 mt-2">نظام حضور الطلاب</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        البريد الإلكتروني
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1E40AF]"
                           placeholder="example@uni.edu">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        كلمة المرور
                    </label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1E40AF]"
                           placeholder="********">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        الدخول بصفة (اختياري)
                    </label>
                    <div class="flex flex-wrap gap-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="student" 
                                   class="form-radio text-[#1E40AF] focus:ring-[#1E40AF]">
                            <span class="mr-2">طالب</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="lecturer" 
                                   class="form-radio text-[#1E40AF] focus:ring-[#1E40AF]">
                            <span class="mr-2">محاضر</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="role" value="admin" 
                                   class="form-radio text-[#1E40AF] focus:ring-[#1E40AF]">
                            <span class="mr-2">مسؤول / مراقب</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" 
                               class="form-checkbox text-[#1E40AF] focus:ring-[#1E40AF] rounded">
                        <span class="mr-2 text-gray-700">تذكرني</span>
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-[#1E40AF] hover:bg-[#1E3A8A] text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                    دخول
                </button>
            </form>

            <div class="text-center mt-6">
                <p class="text-gray-600">
                    ليس لديك حساب؟
                    <a href="#" class="text-[#1E40AF] hover:text-[#1E3A8A] font-semibold">
                        إنشاء حساب جديد
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>