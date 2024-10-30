<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'view_users', 'description' => 'Pode visualizar usuários']);
        Permission::create(['name' => 'create_users', 'description' => 'Pode criar usuários']);
        Permission::create(['name' => 'modify_users', 'description' => 'Pode modificar usuários']);
        Permission::create(['name' => 'delete_users', 'description' => 'Pode excluir usuários']);
        Permission::create(['name' => 'view_roles', 'description' => 'Pode visualizar tipos de acesso']);
        Permission::create(['name' => 'create_roles', 'description' => 'Pode criar tipos de acesso']);
        Permission::create(['name' => 'modify_roles', 'description' => 'Pode modificar tipos de acesso']);
        Permission::create(['name' => 'delete_roles', 'description' => 'Pode excluir tipos de acesso']);
    }
}
