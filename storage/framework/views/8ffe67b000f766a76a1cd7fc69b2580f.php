<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Student Number</th>
            <th>Attendance Time</th>
        </tr>
    </thead>
    <tbody>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($attendance->student->name); ?></td>
        <td><?php echo e($attendance->student->student_number); ?></td>
        <td><?php echo e($attendance->attendance_time); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
    </table>
<?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/exports/attendance.blade.php ENDPATH**/ ?>