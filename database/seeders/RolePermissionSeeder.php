<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Admin','Admin','Employee','HR Admin'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);

            Permission::create([ "name" =>"read {$role}"]);
            Permission::create([ "name" =>"write {$role}"]);
            Permission::create([ "name" =>"delete {$role}"]);

        }
    }
}
