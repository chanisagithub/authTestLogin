<?php

namespace Database\Seeders;

use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $allPermissionGroups = Permission::all();
        $allPermissions = "";

        foreach ($allPermissionGroups as $permissionRow) {
            $allPermissions .="|".$permissionRow['permissions'];
        }

        $allPermissions = substr($allPermissions, 1);


        DB::table('roles')->truncate();


        DB::table('roles')->updateOrInsert([
            'id'         => 1,
        ],[
            'user_type'     => env('USER_TYPE_BACKEND'),
            'user_level'    => 100,
            'role_name'     => 'Super Admin',
            'permissions'   => 'super-permission',
            'locked'        => true,
            'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        ]);


        DB::table('roles')->updateOrInsert([
            'id'         => 2,
        ],[
            'user_type'     => env('USER_TYPE_BACKEND'),
            'user_level'    => 99,
            'role_name'     => 'System Admin',
            //'permissions'   => $allPermissions,
            'permissions'   => 'user-list'.'|user-create'.'|user-edit'.'|user-delete'.'|user-approve'.'|password-reset'.'|attempts-reset'.'|role-list'.'|role-create'.'|role-edit'.'|role-delete'.'|role-approve'.
            '|branch-list'.'|branch-create'.'|branch-edit'.'|branch-delete'.'|branch-approve',
            'locked'        => true,
            'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        ]);

        // DB::table('roles')->updateOrInsert([
        //     'id'         => 3,
        // ],[
        //     'user_type'     => env('USER_TYPE_BACKEND'),
        //     'user_level'    => 99,
        //     'role_name'     => 'Bank Assistant',
        //     'permissions'   => 'get-video-call'.'|view-new-applications'.'|schedule-video-call'. '|add-attachments'
        //     .'|view scheduled-calls'.'|reschedule-video-call'. '|save-drp-status'. '|check-drp'.'|AML-screening'.'|send-reminder-for-video-call'. '|view-incomplete-calls'.'|resend-video-call-link'
        //     .'|view-completed-calls'.'|view-higher-Approval-Pending-Applications'.'|view-higher-approval-approved-application'.'|view-rejected-applications-by-the-second-officer'
        //     .'|view-rejected-applications-by-the-bank-manager'.'|view-incomplete-applications'.'|view-refer-to-branch-applications-by-second-officer'.'|view-refer-to-branch-applications-by-bank-manager'
        //     .'|application-list'.'|application-approve'.'|application-reject'.'|application-schedule'.'|application-incomplete'.'|approved-application-list'.'|cancelled-call-list',
        //     'locked'        => false,
        //     'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //     'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        // ]);

        // DB::table('roles')->updateOrInsert([
        //     'id'         => 4,
        // ],[
        //     'user_type'     => env('USER_TYPE_BACKEND'),
        //     'user_level'    => 99,
        //     'role_name'     => 'Second Officer',
        //     'permissions'   => 'view-completed-calls'.'|view-higher-Approval-Pending-Applications'.'|view-higher-approval-approved-application'.'|view-rejected-applications-by-the-second-officer'
        //     .'|view-rejected-applications-by-the-bank-manager'.'|view-refer-to-branch-applications-by-second-officer'.'|view-refer-to-branch-applications-by-bank-manager'
        //     .'|refer-to-branch'.'|reject-application'.'|submit-for-approval'.'|application-reject'.'|application-incomplete'.'|approved-application-list',
        //     'locked'        => false,
        //     'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //     'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        // ]);

        // DB::table('roles')->updateOrInsert([
        //     'id'         => 5,
        // ],[
        //     'user_type'     => env('USER_TYPE_BACKEND'),
        //     'user_level'    => 99,
        //     'role_name'     => 'Branch Manager',
        //     'permissions'   => 'view-higher-Approval-Pending-Applications'.'|view-higher-approval-approved-application'.'|view-rejected-applications-by-the-second-officer'
        //     .'|view-rejected-applications-by-the-bank-manager'.'|refer-to-branch'.'|reject-application'.'|approve-application'.'|application-approve'.'|application-reject'.'|application-incomplete'.'|approved-application-list',
        //     'locked'        => false,
        //     'created_at'    => DB::raw('CURRENT_TIMESTAMP'),
        //     'updated_at'    => DB::raw('CURRENT_TIMESTAMP')
        // ]);
    }
}
