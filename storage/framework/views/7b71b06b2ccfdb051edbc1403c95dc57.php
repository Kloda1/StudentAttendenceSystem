<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(__('student.absent_students')); ?></title>
    <!-- <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style> -->

    <style>
        body {
            font-family: 'DejaVu Sans', 'Tahoma', 'Arial', sans-serif;
            direction: <?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>;
            text-align: <?php echo e(app()->getLocale() == 'ar' ? 'right' : 'left'); ?>;
        }
        h2 {
            text-align: <?php echo e(app()->getLocale() == 'ar' ? 'right' : 'left'); ?>;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: <?php echo e(app()->getLocale() == 'ar' ? 'right' : 'left'); ?>;
            vertical-align: middle;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        .arabic-number {
            unicode-bidi: embed;
        }
    </style>
</head>
<body>
<h2><?php echo e(__('student.absent_students')); ?></h2>

    <table>
        <thead>
            <tr>
            <th><?php echo e(__('student.serial')); ?></th>
                <th><?php echo e(__('student.name')); ?></th>
                <th><?php echo e(__('student.student_number')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                <td class="arabic-number"><?php echo e($index + 1); ?></td>
                    <td><?php echo e($student->name); ?></td>
                    <td dir="ltr" style="text-align: left;"><?php echo e($student->student_number); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\Users\DELL\Desktop\LARAVEL\StudentAttendenceSystem\resources\views/exports/absent_students_pdf.blade.php ENDPATH**/ ?>