<?php $__env->startSection('title', __('teacher.qr_code')); ?>

<?php $__env->startSection('head'); ?>
    <meta http-equiv="refresh" content="<?php echo e($session->qr_refresh_rate); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="flex flex-col items-center bg-white p-8 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-6">
            <?php echo e(__('teacher.session_qr')); ?>

        </h2>

        <div id="qr-container">
            <img src="<?php echo e($qr); ?>" alt="QR Code">
        </div>

        <p id="countdown" class="text-orange-500 font-semibold mt-2">
            <?php echo e(__('teacher.qr_expires_in')); ?> <?php echo e($session->qr_refresh_rate); ?>s
        </p>

        <p id="otp-label" class="text-gray-500 text-sm">
            <?php echo e(__('teacher.verification_code')); ?>

        </p>

        <p id="otp-code" class="text-3xl font-bold tracking-widest text-blue-600">
            <?php echo e($otp); ?>

        </p>

    </div>

    <script>
        setTimeout(function () {


            document.getElementById('qr-container').innerHTML =
                '<div class="flex flex-col items-center justify-center text-red-600">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">' +
                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z" />' +
                '</svg>' +
                '<p class="text-xl font-bold"><?php echo e(__("teacher.qr_expired")); ?></p>' +
                '</div>';

            document.getElementById('otp-label').style.display = 'none';
            document.getElementById('otp-code').style.display = 'none';
            document.getElementById('countdown').style.display = 'none';

        }, <?php echo e($session->qr_refresh_rate * 1000); ?>);
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem1\resources\views/teacher/lecture-session-qr.blade.php ENDPATH**/ ?>