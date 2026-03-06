<?php $__env->startSection('title', __('teacher.dashboard_title')); ?>

<?php $__env->startSection('content'); ?>

    <div class="grid md:grid-cols-4 gap-6">

  
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                <?php echo e(__('teacher.my_sessions')); ?>

            </div>

            <div class="mt-3 text-3xl font-bold text-blue-700">
                <?php echo e($sessionsCount ?? 0); ?>

            </div>

        </div>

        <!-- Today Attendance -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                <?php echo e(__('teacher.today_attendance')); ?>

            </div>

            <div class="mt-3 text-3xl font-bold text-green-600">
                <?php echo e($todayAttendance ?? 0); ?>

            </div>

        </div>

  
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                <?php echo e(__('teacher.total_students')); ?>

            </div>

            <div class="mt-3 text-3xl font-bold text-indigo-600">
                <?php echo e($totalStudents ?? 0); ?>

            </div>

        </div>

    
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="text-sm text-gray-500">
                <?php echo e(__('teacher.active_session')); ?>

            </div>

            <div class="mt-4">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeSession): ?>

                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                    <span class="w-2 h-2 rounded-full bg-green-600"></span>
                    <?php echo e(__('teacher.active')); ?>

                </span>

                <?php else: ?>

                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 text-gray-600 text-sm font-semibold">
                    <?php echo e(__('teacher.none')); ?>

                </span>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>

    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->hasAnyRole(['super_admin','course_lecturer'])): ?>
        <div class="mt-8 flex justify-end">
            <a href="/admin"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <?php echo e(__('teacher.go_admin_panel') ?? 'دخول لوحة الإدارة'); ?>

            </a>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

 


<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/teacher/dashboard.blade.php ENDPATH**/ ?>