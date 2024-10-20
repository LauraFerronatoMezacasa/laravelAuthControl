<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'Administrador')->first();
        
        $viewUsersPermission = Permission::where('name', 'view_users')->first();
        $createUsersPermission = Permission::where('name', 'create_users')->first();
        $modifyUsersPermission = Permission::where('name', 'modify_users')->first();
        $deleteUsersPermission = Permission::where('name', 'delete_users')->first();
        $viewRolesPermission = Permission::where('name', 'view_roles')->first();
        $createRolesPermission = Permission::where('name', 'create_roles')->first();
        $modifyRolesPermission = Permission::where('name', 'modify_roles')->first();
        $deleteRolesPermission = Permission::where('name', 'delete_roles')->first();

        $adminRole->permissions()->attach([$viewUsersPermission->id, $createUsersPermission->id, $modifyUsersPermission->id, $deleteUsersPermission->id, $viewRolesPermission->id, $createRolesPermission->id, $modifyRolesPermission->id, $deleteRolesPermission->id]);

        $userRole = Role::where('name', 'Usuário')->first();
    }
}
