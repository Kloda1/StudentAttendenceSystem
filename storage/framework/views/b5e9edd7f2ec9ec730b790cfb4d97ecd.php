<?php $__env->startSection('title', __('teacher.qr_code')); ?>

<?php $__env->startSection('head'); ?>
    <meta http-equiv="refresh" content="<?php echo e($session->qr_refresh_rate); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="flex flex-col items-center bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-6">
          <?php echo e(__('teacher.session_qr')); ?>

        </h2>

        <img src="<?php echo e($qr); ?>" alt="QR Code">

        <p class="mt-4 text-gray-600 text-sm">
        <?php echo e(__('teacher.auto_refresh', ['seconds' => $session->qr_refresh_rate])); ?>


        </p>
        <p class="text-gray-500 text-sm">
          <?php echo e(__('teacher.verification_code')); ?>

        </p>

        <p class="text-3xl font-bold tracking-widest text-blue-600">
            <?php echo e($otp); ?>

        </p>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/teacher/lecture-session-qr.blade.php ENDPATH**/ ?>