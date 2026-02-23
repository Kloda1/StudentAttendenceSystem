<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
   
    public function run(): void
    {
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

  
        $permissions = [
             'view_dashboard',

             'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'import_users',
            'export_users',
            'activate_users',
            'block_users',

             'view_lecturers',
            'create_lecturers',
            'edit_lecturers',
            'delete_lecturers',
            'activate_lecturers',

             'view_subjects',
            'create_subjects',
            'edit_subjects',
            'delete_subjects',
            'assign_lecturer_to_subject',

             'view_halls',
            'create_halls',
            'edit_halls',
            'delete_halls',

             'view_departments',
            'create_departments',
            'edit_departments',
            'delete_departments',

             'view_lecture_sessions',
            'create_lecture_sessions',
            'edit_lecture_sessions',
            'delete_lecture_sessions',
            'start_lecture_session', 
            'end_lecture_session',
            'cancel_lecture_session',

             'record_attendance',  
            'view_attendances',
            'edit_attendances',  
            'export_attendances',

             'view_reports',
            'generate_reports',
            'export_reports',

             'view_system_users',
            'create_system_users',
            'edit_system_users',
            'delete_system_users',

             'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',
            'view_permissions',
            'assign_permissions',

             'view_student_devices',
            'block_student_devices',

             'view_audit_logs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        
        $superAdminRole = Role::create(['name' => 'super_admin', 'guard_name' => 'web']);
        $attendanceMonitorRole = Role::create(['name' => 'attendance_monitor', 'guard_name' => 'web']);
        $lecturerRole = Role::create(['name' => 'course_lecturer', 'guard_name' => 'web']);
        $studentRole = Role::create(['name' => 'student', 'guard_name' => 'web']); 


        $superAdminRole->givePermissionTo(Permission::all());  

    
        $attendanceMonitorRole = Role::firstOrCreate(['name' => 'attendance_monitor', 'guard_name' => 'web']);
        $attendanceMonitorRole->givePermissionTo([
            'view_dashboard',
            'view_lecture_sessions',
            'view_attendances',
            'edit_attendances',
            'view_reports',
            'generate_reports',
            'export_reports',
            'view_student_devices',
            'block_student_devices',
            'view_audit_logs',
        ]);

     
        $lecturerRole = Role::firstOrCreate(['name' => 'course_lecturer', 'guard_name' => 'web']);
        $lecturerRole->givePermissionTo([
            'view_dashboard',
            'view_subjects',  
            'view_lecture_sessions',  
            'create_lecture_sessions',  
            'edit_lecture_sessions', 
            'start_lecture_session', 
            'end_lecture_session',
            'view_attendances', 
            'export_attendances', 
            'view_reports',
            'generate_reports',
        ]);

 
        
        $this->command->info('Roles and Permissions seeded successfully!');
    
    }
}
