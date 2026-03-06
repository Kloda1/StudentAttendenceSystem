<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e($direction ?? 'rtl'); ?>">

<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', __('teacher.dashboard_title')); ?></title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: #f3f4f6;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="antialiased">

<div class="flex min-h-screen">

   
    <aside class="w-64 bg-blue-900 text-white p-6 space-y-6">

        <div class="text-center">
            <img src="<?php echo e(asset('images/logo.png')); ?>" class="h-14 mx-auto mb-3">

            <h2 class="text-xl font-bold">
                <?php echo e(__('teacher.university')); ?>

            </h2>

            <p class="text-sm opacity-80 mt-1">
                <?php echo e(auth()->user()->name); ?>

            </p>
        </div>
     
        <div class="flex justify-center gap-3 text-sm mb-6">

            <a href="<?php echo e(route('lang.switch',['locale'=>'ar'])); ?>"
               class="hover:underline">
                <?php echo e(__('student.arabic')); ?>

            </a>

            <span>|</span>

            <a href="<?php echo e(route('lang.switch',['locale'=>'en'])); ?>"
               class="hover:underline">
                <?php echo e(__('student.english')); ?>


            </a>

        </div>
        <nav class="space-y-2">

            <a href="<?php echo e(route('teacher.dashboard')); ?>"
               class="block px-4 py-2 rounded hover:bg-white/10
               <?php echo e(request()->routeIs('teacher.dashboard') ? 'bg-white/20' : ''); ?>">
                <?php echo e(__('teacher.dashboard')); ?>

            </a>

            <a href="<?php echo e(route('teacher.profile')); ?>"
               class="block px-4 py-2 rounded hover:bg-white/10
               <?php echo e(request()->routeIs('teacher.profile') ? 'bg-white/20' : ''); ?>">
                <?php echo e(__('teacher.profile_title')); ?>

            </a>

            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="w-full text-right px-4 py-2 rounded hover:bg-white/10">
                    <?php echo e(__('teacher.logout')); ?>

                </button>
            </form>

        </nav>

    </aside>

 
    <main class="flex-1 p-8">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

    </main>

</div>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/teacher/layout.blade.php ENDPATH**/ ?>