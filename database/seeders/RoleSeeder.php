<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKey;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    use DisableForeignKey, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Admin', 'Merchant', 'Customer'];

        $this->disableForeignKeys();
        $this->truncate('roles');
        $this->truncate('permissions');

        foreach ($roles as $role) {
            $role = Role::create([
                'name' => $role,
                'guard_name' => 'api'
            ]);
            if (isset($access[$role->id])) {

                $permissionToRole = [];

                foreach ($access[$role->id] as $keys => $perm) {
                    foreach ($perm as $accessPermission) {
                        $permissionToRole[] = strtolower($keys) . '.' . $accessPermission;
                    }
                }
                $perms = Permission::whereIn('name', $permissionToRole)->pluck('name');
                $role->syncPermissions($perms);
            }
        }

        $users = User::all();
        foreach ($users as $user) {
            if ($user->role_id == 1) {
                $user->assignRole(Role::where('id', 1)->first());
            }
            if ($user->role_id == 2) {
                $user->assignRole(Role::where('id', 2)->first());
            }
            if ($user->role_id == 3) {
                $user->assignRole(Role::where('id', 3)->first());
            }
        }

        $this->enableForeignKeys();
    }
}
