<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'accounts_read',
            'account_create',
            'account_update',
            'account_delete',

            'events_read',
            'event_create',
            'event_update',
            'event_delete',

            'genders_read',
            'gender_create',
            'gender_update',
            'gender_delete',

            'memberaccounts_read',
            'memberaccount_create',
            'memberaccount_update',
            'memberaccount_delete',

            'members_read',
            'member_create',
            'member_update',
            'member_delete',

            'noks_read',
            'nok_create',
            'nok_update',
            'nok_delete',

            'permissions_read',
            'permission_create',
            'permission_update',
            'permission_delete',

            'roles_read',
            'role_create',
            'role_update',
            'role_delete',

            'transactions_read',
            'transaction_create',
            'transaction_update',
            'transaction_delete',

            'users_read',
            'user_create',
            'user_update',
            'user_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
