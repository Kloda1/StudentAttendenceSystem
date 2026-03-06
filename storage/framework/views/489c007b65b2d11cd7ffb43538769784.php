<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_','-',app()->getLocale())); ?>" dir="<?php echo e($direction ?? 'rtl'); ?>">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $__env->yieldContent('title', __('student.page_title')); ?>
    </title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:Tajawal,sans-serif;
            background:#f3f4f6;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>

</head>

<body class="antialiased">

<div class="flex min-h-screen">

     <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white p-6 flex flex-col">

        <div class="text-center mb-8">

            <img src="<?php echo e(asset('images/logo.png')); ?>"
                 alt="logo"
                 class="h-14 mx-auto mb-3">

            <h2 class="text-xl font-bold">
                <?php echo e(__('student.university')); ?>

            </h2>

            <p class="text-sm opacity-80 mt-1">
                <?php echo e(__('student.welcome')); ?>

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
       
        <nav class="space-y-2 flex-1">

            <a href="<?php echo e(route('student.dashboard')); ?>"
               class="block px-4 py-2 rounded-lg transition hover:bg-white/10
               <?php echo e(request()->routeIs('student.dashboard') ? 'bg-white/20' : ''); ?>">

                <?php echo e(__('student.home')); ?>

            </a>

            <a href="<?php echo e(route('student.attendance')); ?>"
               class="block px-4 py-2 rounded-lg transition hover:bg-white/10
               <?php echo e(request()->routeIs('student.attendance') ? 'bg-white/20' : ''); ?>">

                <?php echo e(__('student.attendance')); ?>

            </a>

            <a href="<?php echo e(route('student.profile.edit')); ?>"
               class="block px-4 py-2 rounded-lg transition hover:bg-white/10
               <?php echo e(request()->routeIs('student.profile.edit') ? 'bg-white/20' : ''); ?>">

                <?php echo e(__('student.profile')); ?>

            </a>

        </nav>

      
        <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-6">
            <?php echo csrf_field(); ?>

            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 transition
                    py-2 rounded-lg font-semibold">

                <?php echo e(__('student.logout')); ?>


            </button>
        </form>

    </aside>

  
    <main class="flex-1 p-8 overflow-y-auto">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="bg-white rounded-2xl shadow-lg p-8">

            <h1 class="text-2xl font-bold mb-6 text-gray-800">
                <?php echo $__env->yieldContent('title'); ?>
            </h1>

            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </main>

</div>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/student/dashboard.blade.php ENDPATH**/ ?>