<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        
        Permission::create(['name' => 'create poll']);
        Permission::create(['name' => 'edit poll']);
        Permission::create(['name' => 'delete poll']);

        Permission::create(['name' =>'all permission']);

        $owner = Role::create(['name' =>'owner']);
        $owner->givePermissionTo(['all permission','create poll', 'edit poll', 'delete poll']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['create poll', 'edit poll', 'delete poll']);

        $userRole = Role::create(['name' => 'user']);

    }
}

