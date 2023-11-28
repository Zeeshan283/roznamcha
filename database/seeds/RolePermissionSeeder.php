<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Enable these options if you need same role and other permission for User Model
         * Else, please follow the below steps for admin guard
         */

        // Create Roles and Permissions
        // $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleEditor = Role::create(['name' => 'editor']);
        // $roleUser = Role::create(['name' => 'user']);


        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'roznamchas',
                'permissions' => [
                    // Roznamchas Permissions
                    'roznamchas.create',
                    'roznamchas.view',
                    'roznamchas.edit',
                    'roznamchas.delete',
                ]
            ],
            [
                'group_name' => 'listings',
                'permissions' => [
                    // Listings Permissions
                    'khatas.create',
                    'khatas.view',
                    'khatas.edit',
                    'khatas.delete',
                ]
            ],
            [
                'group_name' => 'personal',
                'permissions' => [
                    // Personal Khata Permissions
                    'khata.view',
                ]
            ],
            [
                'group_name' => 'orders',
                'permissions' => [
                    // Orders Permissions
                    'orders.kharlachi.create',
                    'orders.kharlachi.view',
                    'orders.kharlachi.edit',
                    'orders.kharlachi.delete',
                    
                    'orders.ghulamkhan.create',
                    'orders.ghulamkhan.view',
                    'orders.ghulamkhan.edit',
                    'orders.ghulamkhan.delete',

                    'orders.thorkham.create',
                    'orders.thorkham.view',
                    'orders.thorkham.edit',
                    'orders.thorkham.delete',

                    'orders.wana.create',
                    'orders.wana.view',
                    'orders.wana.edit',
                    'orders.wana.delete',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    // profile Permissions
                    'profile.view',
                    'profile.edit',
                ]
            ],
        ];


        $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        $roleEmployee = Role::create(['name' => 'employee', 'guard_name' => 'admin']);

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'admin']);
                if($permissions[$i]['group_name']=="roznamchas" || $permissions[$i]['group_name']=="listings" || $permissions[$i]['group_name']=="personal"){
                    $roleEmployee->givePermissionTo($permission);
                    $permission->assignRole($roleEmployee);
                }
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // Assign super admin role permission to superadmin user
        $admin = Admin::where('username', 'admin')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }

    }
}
