<?php

namespace Modules\RolePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\RolePermission\Entities\Role;
use Modules\RolePermission\Entities\Permission;

class RolePermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
        ]);

        
        // $rolePermission = Product::factory(50)->make();
        $users = User::get();
        $roles = Role::get();
        $permissions = Permission::get()->pluck('id');
        // dd(array_values($roles->random(2)->pluck('id')->toarray()));
        foreach ($users as $user) {
            $user->roles()->attach();
        }
    }
}
