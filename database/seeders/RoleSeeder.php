<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = Role::create(['name' => 'admin']);
        $premium = Role::create(['name' => 'premium']);
        $user = Role::create(['name' => 'user']);

        $create = Permission::create(['name' => 'create']);
        $read = Permission::create(['name' => 'read']);
        $update = Permission::create(['name' => 'update']);
        $delete = Permission::create(['name' => 'delete']);


        $admin->givePermissionTo([
            $create,
            $read,
            $update,
            $delete,
        ]);

        $premium->givePermissionTo([
            $create,
            $read,
            $update,
        ]);

        $user->givePermissionTo([
            $read,
        ]);
    }
}
