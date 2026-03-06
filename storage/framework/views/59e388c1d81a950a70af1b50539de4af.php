<?php $__env->startSection('title', __('teacher.profile_title')); ?>

<?php $__env->startSection('content'); ?>

    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow p-8">

        <h2 class="text-2xl font-bold mb-8 text-gray-800">
            <?php echo e(__('teacher.profile_title')); ?>

        </h2>

        <form method="POST" action="<?php echo e(route('teacher.profile.update')); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="space-y-6">

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        <?php echo e(__('teacher.full_name')); ?>

                    </label>

                    <input type="text"
                           name="name"
                           value="<?php echo e(old('name', auth()->user()->name)); ?>"
                           class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none transition">

                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        <?php echo e(__('teacher.email')); ?>

                    </label>

                    <input type="email"
                           name="email"
                           value="<?php echo e(old('email', auth()->user()->email)); ?>"
                           class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none transition">

                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        <?php echo e(__('teacher.phone')); ?>

                    </label>

                    <input type="text"
                           name="phone"
                           value="<?php echo e(old('phone', auth()->user()->phone)); ?>"
                           class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-600 outline-none transition">

                </div>

            </div>

            <button class="mt-8 bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl font-semibold transition">
                <?php echo e(__('teacher.save_changes')); ?>

            </button>

        </form>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('teacher.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/teacher/profile.blade.php ENDPATH**/ ?>