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

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['create poll', 'edit poll', 'delete poll']);

    }
}

