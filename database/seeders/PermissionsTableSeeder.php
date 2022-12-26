<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'participant_create',
            ],
            [
                'id'    => 18,
                'title' => 'participant_edit',
            ],
            [
                'id'    => 19,
                'title' => 'participant_show',
            ],
            [
                'id'    => 20,
                'title' => 'participant_delete',
            ],
            [
                'id'    => 21,
                'title' => 'participant_access',
            ],
            [
                'id'    => 22,
                'title' => 'voice_record_create',
            ],
            [
                'id'    => 23,
                'title' => 'voice_record_edit',
            ],
            [
                'id'    => 24,
                'title' => 'voice_record_show',
            ],
            [
                'id'    => 25,
                'title' => 'voice_record_delete',
            ],
            [
                'id'    => 26,
                'title' => 'voice_record_access',
            ],
            [
                'id'    => 27,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 28,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 29,
                'title' => 'competition_create',
            ],
            [
                'id'    => 30,
                'title' => 'competition_edit',
            ],
            [
                'id'    => 31,
                'title' => 'competition_show',
            ],
            [
                'id'    => 32,
                'title' => 'competition_delete',
            ],
            [
                'id'    => 33,
                'title' => 'competition_access',
            ],
            [
                'id'    => 34,
                'title' => 'referee_create',
            ],
            [
                'id'    => 35,
                'title' => 'referee_edit',
            ],
            [
                'id'    => 36,
                'title' => 'referee_show',
            ],
            [
                'id'    => 37,
                'title' => 'referee_delete',
            ],
            [
                'id'    => 38,
                'title' => 'referee_access',
            ],
            [
                'id'    => 39,
                'title' => 'country_create',
            ],
            [
                'id'    => 40,
                'title' => 'country_edit',
            ],
            [
                'id'    => 41,
                'title' => 'country_show',
            ],
            [
                'id'    => 42,
                'title' => 'country_delete',
            ],
            [
                'id'    => 43,
                'title' => 'country_access',
            ],
            [
                'id'    => 44,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
