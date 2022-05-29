<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create admin user']);
        Permission::create(['name' => 'edit admin user']);
        Permission::create(['name' => 'delete admin user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'dashboard']);

        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create admin user');
        $role1->givePermissionTo('edit admin user');
        $role1->givePermissionTo('delete admin user');
        $role1->givePermissionTo('create user');
        $role1->givePermissionTo('view user');
        $role1->givePermissionTo('edit user');
        $role1->givePermissionTo('delete user');
        $role1->givePermissionTo('dashboard');

        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('create user');
        $role2->givePermissionTo('view user');
        $role2->givePermissionTo('edit user');
        $role2->givePermissionTo('delete user');
        $role2->givePermissionTo('dashboard');

        $role3 = Role::create(['name' => 'employee']);
        $role3->givePermissionTo('view user');
        $role3->givePermissionTo('edit user');
    }
}
