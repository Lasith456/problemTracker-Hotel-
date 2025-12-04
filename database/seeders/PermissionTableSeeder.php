<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'problemtype-list',
            'problemtype-create',
            'problemtype-edit',
            'problemtype-delete',
            'problemarea-list',
            'problemarea-create',
            'problemarea-edit',
            'problemarea-delete',
            'notificationsource-list',
            'notificationsource-create',
            'notificationsource-edit',
            'notificationsource-delete',
            'hotel-list',
            'hotel-create',
            'hotel-edit',
            'hotel-delete',
            'ticket-list',
            'ticket-create',
            'ticket-edit',  
            'ticket-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete'
        ];

        foreach ($permissions as $permission) {
             Permission::firstOrCreate(['name' => $permission]);
        }
    }
}

//php artisan db:seed --class=PermissionTableSeeder