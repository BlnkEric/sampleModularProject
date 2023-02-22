<?php

namespace Modules\RolePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\RolePermission\Entities\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $names = [
            'create-tasks',
            'edit-tasks',
            'delete-tasks',
            'browse_admin',
            'browse_database',
            'browse_media',
            'read_settings',
            'edit_settings',
        ];

        $permissions = Permission::factory(count($names))->make();
        $i = 0;
        foreach($permissions as $permission) {
            $permission->slug = $names[$i++];
            $permission->save();
        }
    }
}
