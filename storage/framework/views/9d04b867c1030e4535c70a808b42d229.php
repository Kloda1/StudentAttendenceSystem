<?php $__env->startSection('title','تأكيد الحضور'); ?>

<?php $__env->startSection('content'); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
    <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4">
        <ul class="list-disc pl-5 space-y-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<form method="POST"
      action="<?php echo e(route('student.attendance.store', ['session' => session('verify_session')])); ?>"
      class="space-y-6 max-w-md">

    <?php echo csrf_field(); ?>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            الرقم الجامعي
        </label>

        <input
            type="text"
            name="student_number"
            value="<?php echo e(old('student_number')); ?>"
            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            رمز التحقق
        </label>

        <input
            type="text"
            name="otp"
            value="<?php echo e(old('otp')); ?>"
            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">

        تحقق
    </button>

</form>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('student.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/student/attendance/verify-otp.blade.php ENDPATH**/ ?>